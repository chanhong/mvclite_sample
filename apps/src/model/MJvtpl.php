<?php
namespace MvcLite;
class MJvtpl extends JvModel
{
    public static function CreateJv($dbinfo = '')
    {
        $id = self::InsInfo(self::NewJvt($dbinfo), $dbinfo);
        CUtil::Add2SessVar('feedback', 'Created JV ' . $id . '!');
        return $id;
    }
    public static function AddMailto2Jv($p, $dbinfo = '')
    {
        $v = ['jvid' => $p['p1'] ?? '', 'box_num' => '359415', 'attach' => '0', 'copies' => '1'];
        return self::AddRowBySid('mailto', $v, 'sub_id', $dbinfo);
    }
    public static function AddDetail2Jv($p, $dbinfo = '')
    {
        return self::AddRowBySid('jvdetail', ['jvid' => $p['p1'] ?? '', 'task' => '*', 'optn' => '*', 'proj' => '*'], 'sub_id', $dbinfo);
    }
    public static function Delete($p, $dbinfo = '')
    {
        if (!isset($p['p1']))
            return;
        foreach (['jvlist', 'jvdetail', 'mailto'] as $t)
            CDbPdo::Delete(['dbinfo' => $dbinfo, 'table' => $t, 'where' => "jvid='" . $p['p1'] . "'"]);
        CUtil::Add2SessVar('feedback', 'JV ID ' . $p['p1'] . ' have been deleted!');
    }
    public static function Clone($p, $dbinfo = '')
    {
        if (!isset($p['p1']))
            return '';
        $one = CDbPdo::oleGetRowNv("select * from jvlist where jvid='" . $p['p1'] . "'", $dbinfo) ?? [];
        if (!$one)
            return '';
        $one['title'] = CString::SubStr($one['title'] ?? '', 0, 20) . '_C' . date('dmHis');
        $id = self::InsInfo($one, $dbinfo);
        foreach (['mailto', 'jvdetail'] as $t)
            foreach (CDbPdo::oleGetRows("select * from $t where jvid='" . $p['p1'] . "'", $dbinfo) as $r) {
                $r['jvid'] = $id;
                unset($r['id']);
                CDbPdo::InsNextId(['dbinfo' => $dbinfo, 'table' => $t, 'id' => 'id'], $r);
            }
        CUtil::Add2SessVar('feedback', 'JV ID ' . $p['p1'] . ' have been cloned to [' . $id . ']!');
        return $id;
    }
    public static function UpdInfo($jvid, $post, $dbinfo = '')
    {
        return CDbPdo::Update(['dbinfo' => $dbinfo, 'table' => 'jvlist', 'where' => "jvid='$jvid'"], self::GetMakerInfo($post));
    }
    public static function InsInfo($post, $dbinfo = '')
    {
        return CDbPdo::InsNextId(['dbinfo' => $dbinfo, 'table' => 'jvlist', 'id' => 'jvid'], self::GetMakerInfo($post));
    }
    public static function UpdJv($jvid, $r, $dbinfo = '')
    {
        if ($jvid === '' || !$r)
            return false;
        self::UpdInfo($jvid, $r, $dbinfo);
        self::UpdMailto($jvid, $r, $dbinfo);
        self::UpdDetail($jvid, $r, $dbinfo);
        return true;
    }
    public static function UpdMailto($jvid, $post, $dbinfo = '')
    {
        foreach (CDbPdo::oleGetRows("select sub_id from mailto where jvid='$jvid' order by sub_id", $dbinfo) as $r) {
            $s = $r['sub_id'];
            $w = ['dbinfo' => $dbinfo, 'table' => 'mailto', 'where' => "jvid='$jvid' and sub_id='$s'"];
            if (!empty($post['delmailto' . $s]))
                CDbPdo::Delete($w);
            CDbPdo::Update($w, self::GetMailto($post, $s));
        }
    }
    public static function UpdDetail($jvid, $post, $dbinfo = '')
    {
        foreach (CDbPdo::oleGetRows("select sub_id from jvdetail where jvid='$jvid' order by ordering,sub_id", $dbinfo) as $r) {
            $s = $r['sub_id'];
            $w = ['dbinfo' => $dbinfo, 'table' => 'jvdetail', 'where' => "jvid='$jvid' and sub_id='$s'"];
            if (!empty($post['deldet' . $s]))
                CDbPdo::Delete($w);
            $v = self::GetDetail($post, $s);
            self::InsBudget($v, $dbinfo);
            self::InsAcctcode($v, $dbinfo);
            CDbPdo::Update($w, $v);
        }
    }
    public static function AddOrUpdRecipient($v, $dbinfo = '')
    {
        $w = "full_email='" . ($v['full_email'] ?? '') . "'";
        $old = CDbPdo::oleGetRowNv("select * from recipient where $w", $dbinfo) ?? [];
        $x = ['status' => $old ? 'U' : 'N', 'full_email' => $v['full_email'] ?? '', 'person' => $v['person'] ?? '', 'box_num' => $v['box_num'] ?? ''];
        if ($old) {
            CDbPdo::Update(['dbinfo' => $dbinfo, 'table' => 'recipient', 'where' => $w], $x);
            return $old['id'] ?? '';
        }
        return CDbPdo::InsNextId(['dbinfo' => $dbinfo, 'table' => 'recipient', 'id' => 'id'], $x);
    }
    public static function InsBudget($v, $dbinfo = '')
    {
        if (strlen($v['budget'] ?? '') !== 7)
            return '';
        if (CDbPdo::oleGetRowNv("select id from budget where budget='" . $v['budget'] . "'", $dbinfo))
            return '';
        return CDbPdo::InsNextId(['dbinfo' => $dbinfo, 'table' => 'budget', 'id' => 'id'], ['status' => 'N', 'budget' => $v['budget']]);
    }
    public static function InsAcctcode($v, $dbinfo = '')
    {
        if (strlen($v['acctcode'] ?? '') !== 8)
            return '';
        if (CDbPdo::oleGetRowNv("select id from acctcode where acctcode='" . $v['acctcode'] . "'", $dbinfo))
            return '';
        return CDbPdo::InsNextId(['dbinfo' => $dbinfo, 'table' => 'acctcode', 'id' => 'id'], ['status' => 'N', 'acctcode' => $v['acctcode']]);
    }
}
