<?php
namespace MvcLite;

class CJv extends CCore
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function DbEnv($dbCfgName = "dbejv")
    {
        return $dbCfgName;
    }

    public static function JvOfflineMsg()
    {
        if (CCore::getAppTxt("JVUserOffline") !== "" || CCore::getAppTxt("JVApproverOffline") !== "")
            return CCore::getAppTxt("OfflineMsg");
        return "";
    }

    public static function IsOffline()
    {
        return self::IsOffline4JVUser() || self::IsOffline4JVApprover();
    }

    public static function test_IsOffline4JVUser()
    {
        return self::IsNormalUser() && self::JvOfflineMsg() !== "";
    }

    public static function IsOffline4JVUser()
    {
        return self::IsNormalUser() && self::JvOfflineMsg() !== "";
    }

    public static function IsOffline4JVApprover()
    {
        return CSecs::IsUsrLevel("approver", "==") && CCore::getAppTxt("JVApproverOffline") !== "";
    }

    public static function IsNormalUser()
    {
        return CSecs::IsUsrLevel("user", "<=");
    }

    public static function setUsersInfo($dbinfo = "")
    {
    }

    public static function JvIsAuthorized($iusrname, $dbinfo = "")
    {
        return false;
    }

    public static function JVIsNotAuthorized($iusrname, $dbinfo = "")
    {
        return false;
    }

    public static function getUsers()
    {
        return [];
    }

    public static function getPasswords()
    {
        return [];
    }

    public static function md5hash($hash, $user_name, $email = "")
    {
        return CSecs::GetMd5Hash(strtolower($user_name) . $hash . strtolower($email));
    }

    public static function jvHash($user_name, $moreparm = "")
    {
        return self::md5hash(CCore::getAppTxt("hash"), $user_name, $moreparm);
    }

    public static function getEntitiesDropdownList($aList, $defEntity = "UWMC")
    {
        return $aList === null ? "" : "Select Entity: " . CHtml::dropDnList("uentity", $aList, $defEntity);
    }

    public static function getUserEntities4DropdownList($dbinfo = "")
    {
        return "";
    }

    public static function getJVListMakers($dbinfo = "")
    {
        $result = [];
        foreach (CDbPdo::oleGetRows("select distinct maker from jvlist order by maker", $dbinfo) as $row) {
            $maker = CCore::cleanStr(trim((string) ($row["maker"] ?? "")), "dec4vw");
            $result[] = $maker === "" ? "Unknown" : $maker;
        }
        return $result;
    }

    public static function getUserProfile($username, $jventity = "", $dbinfo = "")
    {
        if ($username === "")
            return [];
        $where = "where is_confirmed=1 and email_login='" . CCore::cleanStr($username, "enc4db") . "'";
        if ($jventity !== "")
            $where .= " AND jvapprover.apventity='" . CCore::cleanStr($jventity, "enc4db") . "'";
        return CDbPdo::oleGet1stRow("select * from jvapprover, maker " . $where, $dbinfo);
    }

    public static function IsJvUserForcedLogoff($dbinfo = "")
    {
    }

    public static function _NOT_good_force_winuser_IsJvUserForcedLogoff($dbinfo = "")
    {
    }

    public static function UpdUserLoginInfo($email_login, $status = "", $dbinfo = "")
    {
    }

    public static function getJvUsrWebOrWin($iusrname = "")
    {
        $usr = CCore::GetUsrName();
        return $usr !== "" ? $usr : ($iusrname !== "" ? $iusrname : CSecs::winUser());
    }

    public static function getJvUsrname($iusrname = "", $dbinfo = "")
    {
        $u = self::getJvUsrWebOrWin($iusrname);
        return CDbPdo::oleGetScalar("select email_login from maker where email_login='" . CCore::cleanStr($u, "enc4db") . "'", $dbinfo);
    }

    public static function getMakerName($iusrname, $dbinfo = "")
    {
        if ($iusrname === "")
            return "";
        return CDbPdo::oleGetScalar("select name from maker where email_login='" . CCore::cleanStr($iusrname, "enc4db") . "'", $dbinfo);
    }

    public static function GetMakerInfo_not_use($username, $dbinfo = "")
    {
        return [];
    }

    public static function JvForceLogoff($username, $dbinfo = "")
    {
    }

    public static function setUserProfile($dbinfo = "")
    {
    }

    public static function getEntityPrefix($iEntity)
    {
        $entity = strtoupper(trim((string) $iEntity));
        return $entity === "" ? "" : substr($entity, 0, 1);
    }

    public static function GetApvEntityPrefix()
    {
        $profile = CCore::$_uprf ?? [];
        return self::getEntityPrefix($profile["apventity"] ?? "");
    }

    public static function getJvLogTable()
    {
        return CCore::getAppTxt("jvlog", "");
    }

    public static function myJvLog()
    {
        $table = self::getJvLogTable();
        return $table !== "" ? $table : "jvlog";
    }

    public static function getJVYYMMFolder($iDate = "")
    {
        $d = CDate::GetDate($iDate);
        return self::GetApvEntityPrefix() . $d->format("Y") . "/" . $d->format("Ym");
    }

    public static function MakeArchiveDateSubfolder($iDate, $folderPath = "")
    {
        return "";
    }

    public static function GetArchiveFolder($iDate = "")
    {
        $base = CCore::getAppTxt("archive");
        return $iDate !== "" ? rtrim($base, "/\\") . "/" . self::getJVYYMMFolder($iDate) : $base;
    }

    public static function GetOldArchiveFolder($iDate = "")
    {
        $base = CCore::getAppTxt("oldarchive");
        return $iDate !== "" ? rtrim($base, "/\\") . "/" . self::getJVYYMMFolder($iDate) : $base;
    }

    public static function RealFolder2VirtualFolder($dirname, $realFolder2Hide)
    {
        return "";
    }

    public static function JvRealFolder2VirtualFolder($dirname)
    {
        return "";
    }

    public static function JvRealFile2Virtual($file)
    {
        return "";
    }

    public static function GetArchiveURL($fspec)
    {
        if ($fspec === "")
            return "";
        $virtual = self::JvRealFile2Virtual($fspec);
        $filename = basename($fspec);
        $href = CUtil::tap("/jvinq/index/") . "&p1=" . rawurlencode($virtual) . "&c=" . (is_dir($fspec) ? "flist" : "dnld");
        if (is_dir($fspec) || is_file($fspec)) {
            return CHtml::Alink(['text' => $filename, 'title' => $filename, 'href' => $href, 'target' => is_file($fspec) ? 'download' : null]);
        }
        return '<span title="' . htmlspecialchars($virtual, ENT_QUOTES, 'UTF-8') . '">Not Found!</span>';
    }

    public static function Row2ArchiveHref($row, $fldName = "htmlfile")
    {
        $file = (string) ($row[$fldName] ?? "");
        if ($file === "")
            return "&nbsp;";
        $name = $fldName === "textfile" ? "textfiles/" . $file : $file;
        return self::GetArchiveURL(self::GetArchiveFolder((string) ($row["jvdate"] ?? "")) . "/" . $name);
    }

    public static function Url($task, $action = "", $parm = null)
    {
        $action = $action !== "" ? "/" . $action : "/index";
        $query = is_array($parm) && $parm ? "&" . http_build_query($parm) : "";
        return CUtil::tap("/" . $task . $action) . $query;
    }

    public static function JsAuto4Email($ajax = "", $path = "", $sub_id = "", $minLen = "")
    {
        $qs = "?" . CUtil::path2qs($path, $ajax);
        return "$(\"#full_email" . $sub_id . "\").autocomplete({ source: \"$qs\", minLength: " . $minLen . " });";
    }

    public static function JsAuto4Name($ajax = "", $path = "", $sub_id = "", $minLen = "")
    {
        $qs = "?" . CUtil::path2qs($path, $ajax);
        return "$(\"#person" . $sub_id . "\").autocomplete({ source: \"$qs\", minLength: " . $minLen . " });";
    }

    public static function Js4AutoComplete($ajax, $path = "", $sub_id = "", $minLen = "")
    {
        $qs = "?" . CUtil::path2qs($path, $ajax);
        return "$(\"#" . $ajax . $sub_id . "\").autocomplete({ source: \"$qs\", minLength: " . $minLen . " });";
    }

    public static function IsGoodRecipientEmail($full_email, $dbinfo = "")
    {
        return false;
    }

    public static function JvValidate($iType, $iStr)
    {
        $v = (string) $iStr;
        if (in_array($iType, ["empty", "nodetail"]))
            return trim($v) !== "";
        if (in_array($iType, ["email", "full_email"]))
            return filter_var($v, FILTER_VALIDATE_EMAIL) !== false;
        if (in_array($iType, ["debit", "credit", "amount"]))
            return is_numeric($v);
        return trim($v) !== "";
    }

    public static function GetList4Ajax($iType, $term, $dbinfo)
    {
        return [];
    }

    public static function GetJVnumInfo($jvid, $title, $logid, $dbinfo = "")
    {
        return [];
    }

    public static function GetMakerInfoFromJV($username, $dbinfo = "")
    {
        return [];
    }

    public static function BgColorRed()
    {
        return " bgcolor=\"red\"";
    }

    public static function IsNoFlag()
    {
        foreach ((array) (CCore::$_eflag ?? []) as $value)
            if ($value !== "")
                return false;
        return true;
    }

    public static function Last7Days()
    {
        $end = new \DateTime();
        $beg = (clone $end)->modify("-7 days");
        return ["datebeg" => $beg->format("n/j/Y"), "dateend" => $end->format("n/j/Y")];
    }

    public static function GetConvertedDate($fieldName, $strDate, $opr = "<=")
    {
        if ($fieldName === "" || $strDate === "")
            return "";
        
        $date = \DateTime::createFromFormat('n/j/Y', $strDate);
        $formattedDate = $date ? $date->format('Y-m-d') : $strDate;
        
        return "CONVERT(DATETIME, $fieldName) $opr CONVERT(DATETIME, '$formattedDate')";
    }

    public static function GetJvlogInfo($logid, $dbinfo = "")
    {
        return $logid === "" ? [] : CDbPdo::oleGetRowNv("select * from " . self::myJvLog() . " where log_id='" . $logid . "'", $dbinfo);
    }

    public static function JvPrepDate()
    {
        return date("m/d/y");
    }

    public static function DelFileInArchive($file)
    {
        return "";
    }

    public static function DelJvFiles($archiveFolder, $htmlfile, $textfile)
    {
    }

    public static function GetJvNum($dbinfo = "")
    {
        return "";
    }

    public static function GetAcctMo($dbinfo = "")
    {
        return "";
    }

}
