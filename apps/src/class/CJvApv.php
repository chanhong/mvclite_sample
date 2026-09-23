<?php
namespace MvcLite;

class CJvApv extends CJv
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
        $c = strtolower((string) ($rNv['c'] ?? ''));
        if (in_array($c, ['ftpd', 'approved', 'ready4mailout']) && class_exists('MJvApv'))
            MJvApv::Toggle($rNv, $dbinfo);
        elseif ($c === 'renarchive')
            self::RenJvFile($rNv['p1'] ?? '', $dbinfo);
        elseif ($c === 'voided' && class_exists('MJvApv'))
            MJvApv::Void($rNv, $dbinfo);
        elseif ($c === 'mailing' && class_exists('MJvApv'))
            MJvApv::Mailing($rNv, $dbinfo);
    }
    public static function PbFrm($rNv, $rUrl, $dbinfo = "")
    {
        $c = strtolower((string) ($rNv['cmd'] ?? ''));
        if ($c === 'updjvnum' && class_exists('JvModel'))
            JvModel::DbSetJVNum($rNv['nextjvnum'] ?? '', $dbinfo);
        elseif ($c === 'updacctmo' && class_exists('JvModel'))
            JvModel::DbSetAcctMonth($rNv['newmonth'] ?? '', $dbinfo);
    }
    public static function JvNumHref($rNv)
    {
        $approved = strtolower((string) ($rNv['approved'] ?? '')) === 'y';
        $url = CUtil::tap($approved ? '/jvtpl/_view2print/' . $rNv['jvid'] . '/' . $rNv['log_id'] : '/jvapv/_view2apv/' . $rNv['jvid'] . '/' . $rNv['log_id']);
        return CHtml::Alink(['text' => $rNv['jvnum'] ?? '', 'title' => $approved ? ' View to Print ' : ' View to Approve ', 'target' => $approved ? '_blank' : null, 'href' => $url]);
    }
    public static function JvWait4ApprvTitle($fName, $tblcls, $dbinfo = "")
    {
        $out = '';
        foreach ((array) $fName as $name => $value) {
            $parts = explode(',', (string) $value, 2);
            $title = $parts[0] !== '' ? $parts[0] : $name;
            if ($name === 'ready4mailout') {
                $url = CUtil::tap('/jvapv/index/') . '&c=mailing';
                $link = CHtml::Alink(['title' => 'Email JVs w/ [Mailout=Y]', 'href' => $url, 'img' => CUtil::imgPath() . '/mail.png']);
                $out .= '<th class="' . htmlspecialchars($tblcls) . '">' . $title . $link . '</th>';
            } else
                $out .= '<th class="' . htmlspecialchars($tblcls) . '">' . $title . '</th>';
        }
        return $out;
    }
    public static function JvWait4ApprvDet($r, $fName, $dbinfo = "")
    {
        $nv = $r;
        $out = '';
        foreach ((array) $fName as $field => $value) {
            $parts = explode(',', (string) $value);
            $align = $parts[1] ?? 'center';
            $cmd = strtolower($field);
            $v = $nv[$field] ?? '';
            if (in_array($cmd, ['htmlfile', 'textfile']))
                $cell = self::Row2ArchiveHref($r, $field);
            elseif ($cmd === 'jvnum')
                $cell = self::JvNumHref($nv);
            elseif (in_array($cmd, ['ftpd', 'approved', 'ready4mailout'])) {
                $toggle = $v !== '' ? $v : 'N';
                $url = CUtil::tap('/jvapv/index/' . ($nv['log_id'] ?? '') . '/' . $toggle) . '&c=' . $cmd;
                $cell = CHtml::Alink(['text' => $toggle, 'href' => $url]);
            } elseif ($cmd === 'voided') {
                $url = CUtil::tap('/jvapv/index/' . ($nv['log_id'] ?? '')) . '&c=voided';
                $cell = CHtml::Alink(['text' => ' VOID ' . ($nv['jvnum'] ?? '') . ' !', 'href' => $url]);
            } else
                $cell = htmlspecialchars((string) $v);
            $out .= '<td style="text-align:' . htmlspecialchars($align) . '">' . $cell . '</td>';
        }
        return $out;
    }
    public static function ShowApprovalButton($param)
    {
        if (!is_array($param))
            return '';
        $url = CUtil::tap('/jvapv/_view2apv/' . ($param['jvid'] ?? '') . '/' . ($param['log_id'] ?? ''));
        return CHtml::Alink(['text' => 'Approve', 'title' => 'View to approve', 'href' => $url]);
    }
    public static function JvAppvrName()
    {
        return CCore::$_uprf['name'] ?? CCore::$_uprf['approver'] ?? '';
    }
    public static function RenJvFile($logid, $dbinfo = "")
    {
        $row = self::GetJvlogInfo($logid, $dbinfo);
        if (empty($row['htmlfile']))
            return false;
        $folder = self::GetArchiveFolder($row['jvdate'] ?? '');
        $old = $folder . '/' . $row['jvnum'] . '_' . $row['htmlfile'];
        $new = $folder . '/' . $row['htmlfile'];
        if (is_file($old))
            return rename($old, $new);
        return false;
    }
}
