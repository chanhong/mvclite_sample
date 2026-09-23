<?php
namespace MvcLite;
class JvModel extends CModel
{
    public static $TxtHtmlCode = '', $TxtBaseUrl = '', $DdlPageSize = '', $DdlPageOrientation = '', $TxtWidth = '', $TxtHeight = '';
    public static function DbSetJVNum($nextjvnum = '', $dbinfo = '')
    {
        $n = $nextjvnum !== '' ? (int) $nextjvnum : (int) CJv::GetJvNum($dbinfo) + 1;
        if ($n > 9999)
            $n = 1;
        $v = ['jvnum' => str_pad((string) $n, 4, '0', STR_PAD_LEFT)];
        $u = CCore::$_uprf ?? CUtil::getSessNv('uinfo');
        $r = CDbPdo::Update(['dbinfo' => $dbinfo, 'table' => 'jvapprover', 'where' => "apventity='" . ($u['apventity'] ?? '') . "'"], $v);
        return $r !== -1 ? CJv::GetApvEntityPrefix() . $v['jvnum'] : '';
    }
    public static function DbSetAcctMonth($acctmo, $dbinfo = '')
    {
        if (CJv::JvValidate('acctmo', $acctmo)) {
            $u = CCore::$_uprf ?? CUtil::getSessNv('uinfo');
            CDbPdo::Update(['dbinfo' => $dbinfo, 'table' => 'jvapprover', 'where' => "apventity='" . ($u['apventity'] ?? '') . "'"], ['bieniummonth' => $acctmo]);
        } else
            CUtil::Add2SessVar('alert', 'Invalid Bienium Month ' . $acctmo);
    }
    public static function NewJvt($dbinfo = '')
    {
        $u = CUtil::getSessNv('uinfo');
        $maker = CJv::GetMakerInfoFromJV($u['usrname'] ?? '', $dbinfo);
        return ['jvid' => '', 'title' => 'NEW', 'maker' => $u['name'] ?? '', 'explanation' => '', 'debit_sum' => '0.00', 'credit_sum' => '0.00', 'acctmo' => CJv::GetAcctMo($dbinfo), 'prep_date' => date('m/d/y'), 'phone' => $maker['phone'] ?? ''];
    }
    public static function AddRowBySid($tname, $nvValue, $subidfld, $dbinfo = '')
    {
        $last = CDbPdo::oleGetScalar("select $subidfld from $tname where jvid='" . ($nvValue['jvid'] ?? '') . "' order by $subidfld desc", $dbinfo);
        $sub = $last !== '' ? (string) ((int) $last + 1) : '1';
        $nvValue['sub_id'] = $sub;
        CDbPdo::InsNextId(['dbinfo' => $dbinfo, 'table' => $tname, 'id' => 'id'], $nvValue);
        return $sub;
    }
    public static function GetMakerInfo($goodPost)
    {
        $g = CUtil::CleanNv($goodPost, 'enc4db');
        $u = CCore::$_uprf ?? CUtil::getSessNv('uinfo');
        return ['maker' => empty($g['maker']) ? ($u['name'] ?? '') : $g['maker'], 'explanation' => CString::SubStr(CString::FixAmp($g['explanation'] ?? ''), 0, 30), 'phone' => $g['phone'] ?? '', 'title' => CString::SubStr($g['title'] ?? '', 0, 30), 'prep_date' => date('m/d/y'), 'acctmo' => empty($g['acctmo']) ? ($u['bieniummonth'] ?? '') : $g['acctmo']];
    }
    public static function GetMailto($p, $subid = '')
    {
        $x = [];
        foreach (['person', 'full_email', 'box_num', 'attach', 'copies'] as $k)
            $x[$k] = $p[$k . $subid] ?? '';
        $x['full_email'] = strtolower($x['full_email']);
        if ($x['attach'] === '')
            $x['attach'] = '0';
        if ($x['copies'] === '')
            $x['copies'] = '1';
        return $x;
    }
    public static function GetDetail($p, $subid = '')
    {
        $x = [];
        foreach (['ordering', 'descript', 'budget', 'acctcode', 'task', 'optn', 'proj', 'debit', 'credit'] as $k)
            $x[$k] = $p[$k . $subid] ?? '';
        $x['debit'] = $x['debit'] === '' ? '0.00' : $x['debit'];
        $x['credit'] = $x['credit'] === '' ? '0.00' : $x['credit'];
        $x['descript'] = CString::SubStr(CString::FixAmp($x['descript']), 0, 22);
        return $x;
    }
    public static function GetMaker($p)
    {
        return ['name' => CString::ProperCase(CCore::cleanStr($p['name'] ?? '', 'raw')), 'email' => CCore::cleanStr($p['email'] ?? '', 'raw'), 'email_login' => CCore::cleanStr($p['email_login'] ?? '', 'raw'), 'login_status' => '', 'password' => CSecs::GetMd5Hash($p['password'] ?? ''), 'confirm_hash' => CJv::jvHash($p['email_login'] ?? '', $p['email'] ?? ''), 'is_confirmed' => $p['is_confirmed'] ?? '', 'winuser' => $p['winuser'] ?? '', 'jvgroup' => $p['jvgroup'] ?? '', 'phone' => $p['phone'] ?? '', 'jventity' => strtoupper($p['jventity'] ?? ''), 'jventities' => strtoupper($p['jventities'] ?? '')];
    }
    public static function DownLoad($fspec)
    {
        if (!is_file($fspec))
            return;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($fspec));
        header('Content-Length: ' . filesize($fspec));
        readfile($fspec);
        exit;
    }
    public static function _FB($param)
    {
        $msg = (!empty($param['p1']) && !empty($param['c'])) ? 'c= ' . strtolower($param['c']) . ' ' . $param['p1'] . '!' : 'P= ' . CMsg::_msg($param) . '!';
        CUtil::Add2SessVar('feedback', $msg);
    }
}
?>