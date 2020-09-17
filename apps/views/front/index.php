<?php
use MvcLite\MvcAuth;
$this->_view_data['header_title'] = 'Front';
$this->db->pln(MvcCore::$_userInfo,'_userinfo @front');
$this->db->pln(MvcCore::$profile,'profile @front');

//$this->redirect2Url($this->h->tap("/books/index"));
?>
This is front

