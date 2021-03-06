<?php

class Authors extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "bootstrap";     
        $this->meTable = "authors";         
        $this->model = new AuthorModel($this->meTable);   
        $this->_view_data['profile'] = MvcCore::$_usrInfo;            
        $this->_view_data['submenu'] = $this->h->getLiMenu(MvcCore::$_cfg['menu']['submenu']['front']);
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }

    public function index($args = false) {
        
        if (isset($this->post['q'])) {
            $q = $this->post['q'];
            $_q = $this->db->escapeQuote($q);
            $search_sql = " AND (name LIKE '%$_q%') ";
        } else {
            $q = '';
            $search_sql = '';
        }
        $this->_view_data['arr'] = $this->model->_dbt("select",['where'=>"1 = 1 $search_sql ORDER BY name"]);
        $this->_view_data['header_title'] = 'Authors List';       
        echo $this->doView($this, $args['a']);        
    }

    public function edit($args = false) {
        
        if (!empty($this->get['p1'])) {
            $r = $this->db->findRow("SELECT * FROM authors where id =".$this->get['p1']);
        }
        if (isset($this->post['btnEditAccount']) and !empty($r)) {
            $this->_view_data['arr'] = $this->post;
            $this->_view_data['arr']['id'] = $r->id;
            $this->Error->blank($this->post['name'], 'Name');
            if ($this->Error->ok()) {
                $this->model->edit($this->_view_data['arr']);
                self::Add2SessVar("feedback", $this->post['name'] . " has been saved!");
                $this->redirect2Url($this->home);
            } 
        } 
        if (!empty($r)) {
            $this->_view_data['arr'] = (array) $r;
            $this->_view_data['arr']['p1'] = $r->id;
            $this->_view_data['header_title'] = 'Author Edit';
            echo $this->doView($this, $args['a']);        
        } else {
            $this->redirect2Url($this->home);
        }
    } 

    public function delete($args = false) {
        
        $this->model->delete($this->get['p1']);
        $this->redirect2Url($this->home);
    }       

}
