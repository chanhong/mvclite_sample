<?php
namespace MvcLite;

class CJvInq extends CJv
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function PbOrRr($meqs, $dbinfo = "")
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST')
            self::PbFrm($_POST, $meqs, $dbinfo);
        elseif (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET') {
            $qs = CUtil::qs2nv($meqs);
            if (!empty($qs['c']))
                self::PbQs($qs, $meqs, $dbinfo);
        }
    }

    public static function PbQs($rNv, $rUrl, $dbinfo = "")
    {
        $cmd = strtolower((string) ($rNv['c'] ?? ''));
        if ($cmd === 'dnld') {
            $file = CCore::getAppTxt('archive') . '/' . ($rNv['p1'] ?? '');
            if (class_exists('JvModel') && method_exists('JvModel', 'DownLoad'))
                JvModel::DownLoad($file);
            elseif (is_file($file)) {
                header('Content-Disposition: attachment; filename="' . basename($file) . '"');
                readfile($file);
                exit;
            }
        } elseif ($cmd === 'flist')
            CUtil::Add2SessVar('feedback', 'flist ' . CCore::getAppTxt('archive') . '/' . ($rNv['p1'] ?? '') . '!');
    }
    public static function PbFrm($rNv, $rUrl, $dbinfo = "")
    {
    }

    public static function JvLogInDateRange($dateBeg, $dateEnd, $showjustmyjv = "", $dbinfo = "")
    {
        if ($dateBeg === '' || $dateEnd === '') {
            $d = self::Last7Days();
            $dateBeg = $d['datebeg'];
            $dateEnd = $d['dateend'];
        }
        $filter = '';
        if ($showjustmyjv === 'yes')
            $filter = " and maker = '" . self::getMakerName(CUtil::getSessTxt('usrname'), $dbinfo) . "'";
        $where = '(' . self::GetConvertedDate('jvdate', $dateBeg, '>=') . ' and ' . self::GetConvertedDate('jvdate', $dateEnd, '<=') . $filter . ')';
        return CDbPdo::oleGetRows('select * from ' . self::myJvLog() . ' where ' . $where . ' order by log_id desc offset 0 rows fetch next 30 rows only', $dbinfo);
    }

    public static function JvSearch($_q, $dbinfo = "")
    {
        if ($_q === '')
            return [];
        $q = CCore::cleanStr($_q, 'enc4db');
        $like = "(jvnum like '%$q%' or title like '%$q%' or maker like '%$q%')";
        return CDbPdo::oleGetRows('select * from ' . self::myJvLog() . ' where ' . $like . ' order by log_id desc offset 0 rows fetch next 30 rows only', $dbinfo);
    }
}
