<?php
$this->_view_data['header_title'] = 'Front';
$this->db->pln(BaseCore::$_userInfo,'_userinfo @front');
//echo $this->redirect2Url($this->h->tap("/books/index"));

