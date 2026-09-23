<?php
namespace MvcLite;
class CJvTpl extends CJv
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
    public static function PbFrm($rNv, $rUrl, $dbinfo = "")
    {
        if (strtolower((string) ($rNv['cmd'] ?? '')) === 'updjvt')
            self::UpdateJvt($rNv, $rUrl, $dbinfo);
        elseif (strtolower((string) ($rNv['cmd'] ?? '')) === 'uploaddocs')
            self::UploadDocs($rNv, $rUrl, $dbinfo);
    }
    public static function PbQs($rNv, $rUrl, $dbinfo = "")
    {
        $c = strtolower((string) ($rNv['c'] ?? ''));
        if ($c === 'deldoc')
            self::DelUploadDocs($rNv, $dbinfo);
        elseif ($c === 'toapprover')
            self::Jv2Approver($rNv, $dbinfo);
        elseif (in_array($c, ['createjv', 'addmailto', 'adddetail', 'clone', 'delete']) && class_exists('MJvtpl')) {
            $map = ['createjv' => 'CreateJv', 'addmailto' => 'AddMailto2Jv', 'adddetail' => 'AddDetail2Jv', 'clone' => 'Clone', 'delete' => 'Delete'];
            MJvtpl::{$map[$c]}($rNv, $dbinfo);
        }
    }
    public static function GetJVListOfMakerByNameWithStatus($name, $dbinfo = "")
    {
        if ($name === '')
            return [];
        $name = CCore::cleanStr($name, 'enc4db');
        $rows = CDbPdo::oleGetRows("select distinct jvid,maker,title,'' as approved,'' as log_id,'' as super,'' as mailed2depts from jvlist where maker='$name' order by maker,title", $dbinfo);
        foreach ($rows as &$row) {
            $title = CCore::cleanStr((string) ($row['title'] ?? ''), 'enc4db');
            $logs = CDbPdo::oleGetRows("select top 1 jvid,maker,jvdate,title,log_id,approved,super,mailed2depts from " . self::myJvLog() . " where jvid='" . $row['jvid'] . "' and title='$title' order by jvdate desc,log_id desc", $dbinfo);
            if ($logs) {
                foreach (['approved', 'log_id', 'super', 'mailed2depts'] as $k)
                    $row[$k] = $logs[0][$k] ?? '';
            }
        }
        return $rows;
    }
    public static function FlagRed($iStr, $fieldName, $iType = "")
    {
        $type = $iType !== '' ? $iType : $fieldName;
        if (!self::JvValidate($type, $iStr)) {
            CCore::$_eflag[$type] = self::BgColorRed();
            return CCore::$_eflag[$type];
        }
        return '';
    }
    public static function EmptyRecord($iStr, $flagField)
    {
        return self::FlagRed($iStr, $flagField, 'empty');
    }
    public static function FlagDebitCredit($debitstr, $creditstr)
    {
        $d = (float) $debitstr;
        $c = (float) $creditstr;
        if ($d === $c || $d >= 10000000 || $c >= 10000000 || ($d > $c && $c != 0) || ($c > $d && $d != 0)) {
            CCore::$_eflag['dbcr'] = self::BgColorRed();
            return CCore::$_eflag['dbcr'];
        }
        return '';
    }
    public static function FlagSumAmt($debitsum, $creditsum)
    {
        if ((float) $debitsum == 0 || (float) $creditsum == 0 || (float) $debitsum != (float) $creditsum || !self::IsNoFlag()) {
            CCore::$_eflag['sumamt'] = self::BgColorRed();
            return CCore::$_eflag['sumamt'];
        }
        return '';
    }
    public static function GetOneJvInfo($jvid, $dbinfo = "")
    {
        if ($jvid === '')
            return [];
        return CDbPdo::oleGet1stRow("select * from jvlist where jvid='" . CCore::cleanStr($jvid, 'enc4db') . "'", $dbinfo);
    }
    public static function UpdateJvt($from_post, $rUrl, $dbinfo = "")
    {
        if (class_exists('MJvtpl') && method_exists('MJvtpl', 'Update'))
            return MJvtpl::Update($from_post, $dbinfo);
        return false;
    }
    public static function Show2ApproverButton($oneJv)
    {
        if (!is_array($oneJv))
            return '';
        return CHtml::Alink(['text' => 'Submit to Approver', 'href' => CUtil::tap('/jvtpl/index/' . ($oneJv['jvid'] ?? '') . '&c=toapprover')]);
    }
    public static function Jv2Approver($rNv, $dbinfo = "")
    {
        if (class_exists('MJvtpl') && method_exists('MJvtpl', 'ToApprover'))
            return MJvtpl::ToApprover($rNv, $dbinfo);
        return false;
    }
    public static function Email2Approver($nv, $dbinfo = "")
    {
        return self::Jv2Approver($nv, $dbinfo);
    }
    public static function UpldFilesInfo($meqs, $dbinfo = "")
    {
        return self::GetUploadedFiles($meqs, $dbinfo);
    }
    public static function GetUploadedFiles($meqs, $dbinfo = "")
    {
        return '';
    }
    public static function UploadBox($maxUpload)
    {
        return '<input type="file" name="upload" />';
    }
    public static function UploadDocs($rNv, $meqs, $dbinfo = "")
    {
        return false;
    }
    public static function DelUploadDocs($rNv, $dbinfo = "")
    {
        return false;
    }
}
