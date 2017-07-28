<?php
//namespace MvcSample;

class Authors extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "default_nofooter";  
        $this->meTable = "authors"; 
        $this->model = new AuthorModel($this->meTable);   
        $this->add2Array4Layout("meta", "utf-8");
        $this->_view_data['profile'] = BaseCore::$_userInfo;            
        $this->setViewData($this->_class_path);
        $this->home = $this->h->tap('/authors/index');
        $this->_view_data['menu'] = $this->h->getLiMenu(BaseCore::$_cfg['menu']['front']);        
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
        echo self::doView($this, $args['a']);        
    }

    public function edit($args = false) {
        
        $r = $this->db->findRow("SELECT * FROM authors where id =".$this->get['p1']);
//        print_r($r);
        if (isset($this->post['btnEditAccount']) and !empty($r)) {
            $this->_view_data['arr'] = $this->post;
            $this->_view_data['arr']['id'] = $r->id;
            $this->Error->blank($this->post['name'], 'Name');
            $this->Error->blank($this->post['biography'], 'Biography');
            if ($this->Error->ok()) {
                $this->model->edit($this->_view_data['arr']);
                $_SESSION["feedback"] = $this->post['name'] . " has been save!";
                $this->redirect2Url($this->home);
            } 
        } 
        if (!empty($r)) {
            $this->_view_data['arr'] = (array) $r;
            $this->_view_data['arr']['p1'] = $r->id;
            echo self::doView($this, $args['a']);        
        }
    } 

    public function delete($args = false) {
        
        $this->model->delete($this->get['p1']);
        $this->redirect2Url($this->home);
    }       

}
