<?php
use MvcLite\Util;
use MvcLite\MvcCore;

class BookModel extends BaseModel {

    public function __construct($tname, $id = null) {
        
        parent::__construct($tname, $id = null); 
    }

    public function delete($id) {
        
        if (ctype_digit($id)) {
            $where = "id ='$id'";
            $_SESSION['feedback'] = "delete " . $id ;
            $this->_dbt("delete",['where'=>$where]);
        }
    }

    public function edit($rInfo) {
        
        Util::debug($rInfo,'rInfo in model');
        extract($rInfo); // extract array into respective variables

        $sqlUpdList = ['title'=>$title, 'isbn'=>$isbn, 'author_id'=>$author_id];
        $this->_dbt("update",['fl'=>$sqlUpdList, 'where'=>"id='$id'"]);
    }    
}