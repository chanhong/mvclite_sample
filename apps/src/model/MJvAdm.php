<?php
namespace MvcLite;
class MJvAdm extends JvModel
{
    public static function GetMakerUser($where, $dbinfo = '')
    {
        return $where !== '' ? CDbPdo::oleGetRowNv("select * from maker where $where", $dbinfo) : null;
    }
    public static function GetUserBy($iVar, $nvVar, $dbinfo = '')
    {
        return $iVar !== null && isset($nvVar[$iVar]) ? self::GetMakerUser("$iVar='" . $nvVar[$iVar] . "'", $dbinfo) : null;
    }
    public static function Old_GetUser($usrid, $dbinfo = '')
    {
        return $usrid !== '' ? (self::GetMakerUser("user_id='$usrid'", $dbinfo) ?? []) : [];
    }
    public static function UserSearch($_qisconfirmed, $_q = '', $dbinfo = '')
    {
        $confirmed = $_qisconfirmed !== ''
            ? (strtolower((string)$_qisconfirmed) === 'active' ? '1' : '0')
            : '1';

        // Keep the three values aligned with the three positional placeholders.
        // Passing values to Select without placeholders makes PDO bind them anyway,
        // which causes SQL Server's 2,100-parameter limit error.
        $filters = \CDbHelper::nv2NvLike([
            'name' => (string)$_q,
            'email' => (string)$_q,
            'jventity' => (string)$_q,
        ]);
        $like = \CDbHelper::nv2sLike($filters, '?');
        $where = "(is_confirmed = '$confirmed')";
        if ($like !== '') {
            $where .= \CDbHelper::andOrNot($like, 'AND');
        }
        $where .= ' order by user_id desc';

        return CDbPdo::Select(
            ['dbinfo' => $dbinfo, 'table' => 'maker', 'fl' => '*', 'where' => $where],
            $filters
        );
    }
    public static function GetAIList($dbinfo = '')
    {
        $r = [];
        foreach (CDbPdo::oleGetRows('select distinct is_confirmed from maker order by is_confirmed', $dbinfo) as $x)
            if (($x['is_confirmed'] ?? '') !== '')
                $r[] = $x['is_confirmed'] == '1' ? 'Active' : 'Inactive';
        return $r;
    }
    public static function UpdateUser($p, $dbinfo = '')
    {
        if (!empty($p['user_id']) && CJv::JvValidate('email', $p['email'] ?? '') && CJv::JvValidate('loginname', $p['email_login'] ?? '') && CUtil::Validate('password', $p['password'] ?? '')) {
            CDbPdo::Update(['dbinfo' => $dbinfo, 'table' => 'maker', 'where' => "user_id='" . $p['user_id'] . "'"], self::GetMaker($p));
            $m = 'User ID ' . $p['user_id'] . ' have been saved!';
        } else
            $m = ' ERROR - failed validation!';
        CUtil::Add2SessVar('feedback', $m);
    }
    public static function CreateUser($p, $dbinfo = '')
    {
        if (CJv::JvValidate('email', $p['email'] ?? '') && CJv::JvValidate('loginname', $p['email_login'] ?? '') && CUtil::Validate('password', $p['password'] ?? '')) {
            if (!self::GetUserBy('email_login', $p, $dbinfo)) {
                $id = CDbPdo::InsNextId(['dbinfo' => $dbinfo, 'table' => 'maker', 'id' => 'user_id'], self::GetMaker($p));
                CUtil::Add2SessVar('feedback', 'User ID ' . $id . ' have been created!');
                return;
            }
            $m = ' ERROR - that user name has already been taken!';
        } else
            $m = ' ERROR - failed validation!';
        CUtil::Add2SessVar('feedback', $m);
    }
    public static function DeleteUser($p, $dbinfo = '')
    {
        if (isset($p['p1'])) {
            CDbPdo::Delete(['dbinfo' => $dbinfo, 'table' => 'maker', 'where' => "user_id='" . $p['p1'] . "'"]);
            CUtil::Add2SessVar('feedback', 'User ID ' . $p['p1'] . ' have been deleted!');
        }
    }
    public static function CloneUser($p, $dbinfo = '')
    {
        if (isset($p['p1']) && ($one = self::GetMakerUser("user_id='" . $p['p1'] . "'", $dbinfo))) {
            $d = date('YmdHis');
            $one['is_confirmed'] = '0';
            $one['email_login'] .= '_' . $d . '_C';
            $one['name'] = CString::ProperCase($one['name']) . '_' . $d . '_C';
            $id = CDbPdo::InsNextId(['dbinfo' => $dbinfo, 'table' => 'maker', 'id' => 'user_id'], $one);
            CUtil::Add2SessVar('feedback', 'User ID ' . $p['p1'] . ' have been cloned to [' . $id . ']!');
        }
    }
    public static function SendConfirmEmail($p, $dbinfo = '')
    {
        return null;
    }
    public static function SendNewPW($email, $user_name, $dbinfo = '')
    {
        $new = strtolower(substr(CJv::jvHash($user_name, date('YmdHis')), 0, 14));
        CDbPdo::Update(['dbinfo' => $dbinfo, 'table' => 'maker', 'where' => "email_login='$user_name'"], ['password' => CSecs::GetMd5Hash($new)]);
        if (method_exists('CUtil', 'SendMail'))
            CUtil::SendMail($email, CCore::getAppTxt('subjprf') . ' Account activation!', 'For your reference only, here is your eJV temporay password : ' . $new, CCore::getAppTxt('emailfrom'));
    }
    public static function ConfirmUser($qs, $dbinfo = '')
    {
        $u = strtolower(CUtil::getSafeVar($qs, 'username'));
        $h = strtolower(CUtil::getSafeVar($qs, 'hash'));
        $e = strtolower(CUtil::getSafeVar($qs, 'email'));
        if ($u === '' || $h === '' || $e === '')
            return 'Confirm FAILED!';
        $old = CDbPdo::oleGetScalar("select is_confirmed from maker where email_login='$u'", $dbinfo);
        if ($old === '1')
            return 'You already confirmed!';
        if (CJv::jvHash($u, $e) === $h) {
            CDbPdo::Update(['dbinfo' => $dbinfo, 'table' => 'maker', 'where' => "confirm_hash='$h' and email='$e' and email_login='$u'"], ['email' => $e, 'is_confirmed' => '1']);
            self::SendNewPW($e, $u, $dbinfo);
            return 'Your account is confirmed and new password has been sent!';
        }
        return 'Confirm FAILED!';
    }
}
?>