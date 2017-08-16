<?php
use MvcLite\MvcAuth;
$this->_view_data['header_title'] = 'Front';
$this->db->pln(BaseCore::$_userInfo,'_userinfo @front');

//$this->redirect2Url($this->h->tap("/books/index"));
?>
This is front

