<?php


class AuthorModel extends BaseModel {

    public function __construct($tname, $id = null) {
        
        parent::__construct($tname, $id = null); 
    }

    public function delete($id) {
        
        if (ctype_digit($id)) {
            $where = "id ='$id'";
            self::Add2SessVar("feedback", "Deleted " . $id);
            $this->_dbt("delete",['where'=>$where]);
        }
    }

    public function edit($rInfo) {
        
        permDbg($rInfo,'rInfo in model');
        extract($rInfo); // extract array into respective variables
        $sqlUpdList = ['name'=>$name, 'biography'=>$biography];
        $this->_dbt("update",['fl'=>$sqlUpdList, 'where'=>"id='$id'"]);
    }   
   
    
}