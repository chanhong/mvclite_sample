<?php
namespace MvcLite;

class CJvAdm extends CJv
{
    public function __construct()
    {
        parent::__construct();
    }
    public static function PbOrRr($meqs, $dbinfo = "")
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST')
            self::PbFrm($_POST, $meqs, $dbinfo);
        else {
            $q = CUtil::qs2nv($meqs);
            if (!empty($q['c']))
                self::PbQs($q, $meqs, $dbinfo);
        }
    }
    public static function PbQs($rNv, $rUrl, $dbinfo = "")
    {
        $cmd = strtolower((string) ($rNv['c'] ?? ''));
        if ($cmd === 'delete' && class_exists('MJvAdm'))
            MJvAdm::DeleteUser($rNv, $dbinfo);
        elseif ($cmd === 'clone' && class_exists('MJvAdm'))
            MJvAdm::CloneUser($rNv, $dbinfo);
        elseif ($cmd === 'sendconfirm' && class_exists('MJvAdm'))
            MJvAdm::SendConfirmEmail($rNv, $dbinfo);
    }
    public static function PbFrm($rNv, $rUrl, $dbinfo = "")
    {
        $cmd = strtolower((string) ($rNv['cmd'] ?? ''));
        if ($cmd === 'purge') {
            self::PurgeJVLogInDateRange($rNv, $dbinfo);
            CUtil::Redirect($rUrl);
        } elseif ($cmd === 'list')
            CCore::$_Nv = self::AdjPastRetention($rNv, $dbinfo);
        elseif ($cmd === 'saveedit' && class_exists('MJvAdm'))
            MJvAdm::UpdateUser($rNv, $dbinfo);
        elseif ($cmd === 'savenew' && class_exists('MJvAdm'))
            MJvAdm::CreateUser($rNv, $dbinfo);
    }
    public static function AdjPastRetention($nv, $dbinfo = "")
    {
        $years = (int) ($nv['retention'] ?? 6);
        if ($years <= 0)
            $years = 6;
        $p = self::PastRetention($years, $dbinfo);
        $beg = CDate::GetDate($nv['datebeg'] ?? '');
        $pb = CDate::GetDate($p['datebeg'] ?? '');
        $end = CDate::GetDate($nv['dateend'] ?? '');
        $pe = CDate::GetDate($p['dateend'] ?? '');
        return ['datebeg' => ($beg > $pb ? $beg : $pb)->format('n/j/Y'), 'dateend' => ($end < $pe ? $end : $pe)->format('n/j/Y')];
    }
    public static function PastRetention($retentionYrs = 6, $dbinfo = "")
    {
        return ['datebeg' => self::OldestJvfromLog($retentionYrs, $dbinfo), 'dateend' => CDate::DateAfterRetention($retentionYrs)->format('n/j/Y')];
    }
    public static function OldestJvfromLog($retentionYrs = 6, $dbinfo = "")
    {
        $d = CDate::DateAfterRetention($retentionYrs);
        $sql = 'select top 1 jvdate from ' . self::myJvLog() . ' where ' . self::GetConvertedDate('jvdate', $d->format('m/d/Y'), '<=') . ' order by CONVERT(DATETIME, jvdate) asc';
        $row = CDbPdo::oleGetRowNv($sql, $dbinfo);
        return $row['jvdate'] ?? null;
    }
    public static function OldestMonthFromLog($retention, $dbinfo = "")
    {
        $beg = self::OldestJvfromLog($retention, $dbinfo);
        if (!$beg)
            return ['datebeg' => '', 'dateend' => ''];
        $d = CDate::GetDate($beg);
        return ['datebeg' => $d->format('n/j/Y'), 'dateend' => CDate::EndOfMonth($d)->format('n/j/Y')];
    }
    public static function jvLogByRange($frm, $dbinfo = "")
    {
        $beg = CUtil::getSafeVar($frm, 'datebeg', 'raw');
        $end = CUtil::getSafeVar($frm, 'dateend', 'raw');
        if ($beg === '' || $end === '') {
            $x = self::OldestMonthFromLog((int) CCore::getAppTxt('retentionyrs'), $dbinfo);
            $beg = $x['datebeg'];
            $end = $x['dateend'];
        }
        $w = self::GetConvertedDate('jvdate', $beg, '>=') . ' and ' . self::GetConvertedDate('jvdate', $end, '<=');
        return CDbPdo::oleGetRows('select * from ' . self::myJvLog() . ' where ' . $w . ' order by log_id desc', $dbinfo);
    }
    public static function jvLogPastRetention($dateBeg, $dateEnd, $dbinfo = "")
    {
        $w = self::GetConvertedDate('jvdate', $dateBeg, '>=') . ' and ' . self::GetConvertedDate('jvdate', $dateEnd, '<=');
        return CDbPdo::oleGetRows('select year(jvdate) as jvyear, month(jvdate) as jvmonth, count(*) as jvcnt from ' . self::myJvLog() . ' where ' . $w . ' group by year(jvdate), month(jvdate) order by year(jvdate), month(jvdate)', $dbinfo);
    }
    public static function PurgeJVLogInDateRange($frm, $dbinfo = "")
    {
        $beg = CUtil::getSafeVar($frm, 'datebeg', 'raw');
        $end = CUtil::getSafeVar($frm, 'dateend', 'raw');
        $w = self::GetConvertedDate('jvdate', $beg, '>=') . ' and ' . self::GetConvertedDate('jvdate', $end, '<=');
        $rows = self::jvLogPastRetention($beg, $end, $dbinfo);
        CUtil::Add2SessVar('feedback', 'Start purging...');
        foreach ($rows as $r)
            CDbPdo::Delete(['dbinfo' => $dbinfo, 'table' => self::myJvLog(), 'where' => $w]);
        CUtil::Add2SessVar('feedback', $rows ? 'Purged JV logs between ' . $beg . ' and ' . $end . '.' : 'Nothing to be purged.');
    }
    public static function SendPw($frm, $dbinfo = "")
    {
        CCore::_Logout();
        $u = CUtil::getSafeVar($frm, 'user_name', 'txt');
        if ($u !== '' && class_exists('MJvAdm')) {
            $one = MJvAdm::GetMakerUser("email_login='$u'", $dbinfo);
            if (!empty($one)) {
                CUtil::Add2SessVar('feedback', 'Your new password has been sent!');
                MJvAdm::SendNewPW($one['email'] ?? '', $u, $dbinfo);
            }
        }
    }
    public static function ChgPw($frm, $dbinfo = "")
    {
        $u = CUtil::getSafeVar($frm, 'change_user_name', 'txt');
        if ($u === '')
            return;
        $old = CUtil::getSafeVar($frm, 'old_password', 'txt');
        $n1 = CUtil::getSafeVar($frm, 'new_password1', 'txt');
        $n2 = CUtil::getSafeVar($frm, 'new_password2', 'txt');
        if ($n1 !== '' && $n1 === $n2)
            CDbPdo::Update(['dbinfo' => $dbinfo, 'table' => 'maker', 'where' => "email_login='$u' and password='" . md5($old) . "'"], ['password' => md5($n1)]);
    }
}
