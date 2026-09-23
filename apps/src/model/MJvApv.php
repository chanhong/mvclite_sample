<?php
namespace MvcLite;
class MJvApv extends JvModel
{
    public static function Toggle($param, $dbinfo = '')
    {
        $field = (string) ($param['c'] ?? '');
        $log = (string) ($param['p1'] ?? '');
        $row = CJv::GetJvlogInfo($log, $dbinfo);
        $value = ($field === 'approved' && !empty($row['htmlfile']) && strtoupper($row['mailed2depts'] ?? '') === 'N') ? 'P' : CUtil::YN($param['p2'] ?? '');
        if ($value === 'P')
            self::DelJVArchiveFiles($row);
        $q = CDb::nv2sUpdate(CJv::myJvLog(), [$field => $value], ['param' => 'yes', 'where' => "log_id='$log'"]);
        return CDbPdo::oleExecParm($q, [$field => $value], $dbinfo);
    }
    public static function Void($param, $dbinfo = '')
    {
        $q = CDb::nv2sUpdate(CJv::myJvLog(), ['voided' => 'Y', 'approved' => 'N'], ['param' => 'yes', 'where' => "log_id='" . ($param['p1'] ?? '') . "'"]);
        CUtil::Add2SessVar('feedback', 'JV log_id=' . ($param['p1'] ?? '') . ' has been voided!');
        CDbPdo::oleExecParm($q, ['voided' => 'Y', 'approved' => 'N'], $dbinfo);
        self::doVoidJVArchiveFiles($param, $dbinfo);
    }
    public static function DelJVArchiveFiles($r)
    {
        if (empty($r))
            return;
        self::MoveJV2Folder($r['jvdate'] ?? '', $r['htmlfile'] ?? '', CJv::GetArchiveFolder($r['jvdate'] ?? ''), 'voided');
        self::MoveJV2Folder($r['jvdate'] ?? '', $r['textfile'] ?? '', CJv::GetArchiveFolder($r['jvdate'] ?? '') . '/' . CCore::getAppTxt('textfiles'), 'voided');
    }
    public static function doVoidJVArchiveFiles($p, $dbinfo = '')
    {
        $id = $p['p1'] ?? '';
        $r = CJv::GetJvlogInfo($id, $dbinfo);
        if ($r) {
            self::DelJVArchiveFiles($r);
            self::MoveJV2Folder($r['jvdate'] ?? '', $r['jvnum'] ?? '' . CCore::getAppTxt('support_docs'), CJv::GetArchiveFolder($r['jvdate'] ?? ''), 'voided');
        }
    }
    public static function MoveJV2Folder($date, $file, $from, $to)
    {
        if ($file === '')
            return ' Failed to Move [] to ' . $to;
        $dst = CJv::GetArchiveFolder() . '/' . $to . '/' . CJv::getJVYYMMFolder($date);
        CFiles::MakeFolder($dst);
        $src = rtrim($from, '/\\') . DIRECTORY_SEPARATOR . $file;
        $target = rtrim($dst, '/\\') . DIRECTORY_SEPARATOR . basename($file);
        if (is_file($src)) {
            CFiles::MvFile($src, $target);
            return " Move $file to $to";
        }
        if (is_dir($src)) {
            CFiles::MvDir($src, $target);
            return " Move $file to $to";
        }
        return '';
    }
    public static function JvCreateArchiveFile($p, $dbinfo = '')
    {
        return strtolower(CCore::getAppTxt('archivetype')) === 'pdf' ? self::JvCreateArchiveFile_PDF($p, $dbinfo) : self::JvCreateArchiveFile_HTM($p, $dbinfo);
    }
    public static function JvCreateArchiveFile_HTM($p, $dbinfo = '')
    {
        CUtil::Add2SessVar('feedback', 'Create HTM archive file for JV ' . ($p['p2'] ?? '') . '!');
        $f = ($p['arcfolder'] ?? '') . DIRECTORY_SEPARATOR . ($p['arcfile'] ?? '');
        return file_put_contents($f, $p['jvhtml'] ?? '') !== false;
    }
    public static function JvCreateArchiveFile_PDF($p, $dbinfo = '')
    {
        if (!class_exists('\\SelectPdf\\HtmlToPdf'))
            return false;
        $c = new \SelectPdf\HtmlToPdf();
        $c->Options->PdfPageSize = 'Letter';
        $c->Options->PdfPageOrientation = 'Landscape';
        $d = $c->ConvertHtmlString($p['jvhtml'] ?? '', CUtil::BaseUrl());
        $d->Save(($p['arcfolder'] ?? '') . DIRECTORY_SEPARATOR . ($p['arcfile'] ?? ''));
        $d->Close();
        return true;
    }
    public static function UpdJvDetailBefExport($row, $dbinfo = '')
    {
        return true;
    }
    public static function JvExportFile($p, $name, $dbinfo = '')
    {
        if ($name === '' || empty($p['p2']))
            return false;
        self::JvCreateTextFile($p['p1'] ?? '', $name . '.JV', $dbinfo);
        $q = CDb::nv2sUpdate(CJv::myJvLog(), ['approved' => 'Y', 'super' => self::JvAppvrName(), 'textfile' => $name . '.JV'], ['param' => 'yes', 'where' => "log_id='" . $p['p2'] . "'"]);
        CDbPdo::oleExecParm($q, ['approved' => 'Y', 'super' => self::JvAppvrName(), 'textfile' => $name . '.JV'], $dbinfo);
        return true;
    }
    public static function JvCreateTextFile($jvid, $textfile, $dbinfo = '')
    {
        $rows = CDbPdo::Select(['dbinfo' => $dbinfo, 'table' => 'jvdetail', 'fl' => 'tc,jvdate,jvnum,budget,acctcode,amount,refno,task,optn,proj,pos,occup,sp,fte,descript', 'where' => "jvid='$jvid' order by sub_id asc"], ['jvid' => $jvid]);
        if (!$rows)
            return;
        $path = CJv::MakeArchiveDateSubfolder($rows[0]['jvdate'] ?? '', CCore::getAppTxt('textfiles')) . DIRECTORY_SEPARATOR . $textfile;
        $lines = [];
        foreach ($rows as $r)
            $lines[] = trim(implode(' ', array_filter(array_map('strval', $r), fn($v) => $v !== '')));
        file_put_contents($path, implode(PHP_EOL, $lines) . PHP_EOL);
    }
    public static function JvAppvrInfo($u, $dbinfo = '')
    {
        return CDbPdo::oleGetRowNv("select * from jvapprover where apventity='" . ($u['apventity'] ?? '') . "'", $dbinfo) ?? [];
    }
    public static function GetJvTextFileName($acctmo, $dbinfo = '')
    {
        $u = CCore::$_uprf ?? CUtil::getSessNv('uinfo');
        $r = self::JvAppvrInfo($u, $dbinfo);
        $day = date('j');
        $seq = ($r['dayofmonth'] ?? '') === $day ? chr(ord(strtoupper($r['seqnum'] ?? '@')) + 1) : 'A';
        if ($seq === ':')
            return '';
        return 'F' . str_pad($acctmo, 2, '0', STR_PAD_LEFT) . date('md') . $seq;
    }
    public static function JvExport($p, $dbinfo = '')
    {
        return false;
    }
    public static function Mailing($p, $dbinfo = '')
    {
        CUtil::Add2SessVar('feedback', 'Start mailing...');
        return [];
    }
    public static function SendJv2Receipients($row, $dbinfo = '')
    {
        return false;
    }
}
