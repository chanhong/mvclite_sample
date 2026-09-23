<?php
namespace MvcLite;
class CFbsQ extends CCore
{
    public static function getADQUsersList($dbenv): array
    {
        $result = [];
        foreach (CDbPdo::oleGetRows("select distinct name from tblUsers order by name", $dbenv) as $row)
            $result[] = trim((string) ($row["name"] ?? ""));
        return $result;
    }
    public static function getADQUsersRows($name, $dbenv): array
    {
        $name = CCore::cleanStr((string) $name, "enc4db");
        return CDbPdo::oleGetRows("select distinct CN, description from tblUsers where 1=1 and name = '" . $name . "' order by CN", $dbenv);
    }
    public static function getPCGt5YrsRows($dbenv): array
    {
        return CDbPdo::oleGetRows("select distinct * from vPCGt5Yrs order by [UserID]", $dbenv);
    }
}
