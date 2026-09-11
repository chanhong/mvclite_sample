<?php
namespace MvcLite;
use MvcLite\CUtil;
use MvcLite\Ccore;

class BookModel extends BaseModel {

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
        $title = $rInfo['title'];
        $isbn = $rInfo['isbn'];
        $author_id = $rInfo['author_id'];
        $id = $rInfo['id'];
        $sqlUpdList = ['title'=>$title, 'isbn'=>$isbn, 'author_id'=>$author_id];
        $this->_dbt("update",['fl'=>$sqlUpdList, 'where'=>"id='$id'"]);
    }    
}