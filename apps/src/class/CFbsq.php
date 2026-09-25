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
        // We avoid selecting * and specifically exclude 'DiffYrs' because that calculation 
        // inside the view is what's causing the Conversion failed error.
return CDbPdo::oleGetRows("select distinct * from vPCGt5Yrs order by [UserID]", $dbenv);        
//        return CDbPdo::oleGetRows("SELECT [ComputerName], [Subnet], [Description], [Model], [UserID], [OS_Arch], [ImageType], CAST(DeployedDate AS VARCHAR) as DeployedDate, [Location], [OS] FROM vPCGt5Yrs ORDER BY [UserID]", $dbenv);
    }
}
