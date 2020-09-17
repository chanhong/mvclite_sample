<?php
class Books extends BaseController {

    public function __construct() {
        
        parent::__construct();
        $this->layout = "bootstrap";   
        $this->meTable = "books";         

        $this->model = new BookModel($this->meTable);  
        $this->_view_data['profile'] = MvcCore::$_userInfo;            
        $this->_view_data['submenu'] = $this->h->getLiMenu(MvcCore::$_cfg['menu']['submenu']['front']);
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }

    public function index($args = false) {
        
        if (isset($this->post['q'])) {
            $q = $this->post['q'];
            $_q = $this->db->escapeQuote($q);
            $search_sql = " AND (title LIKE '%$_q%') ";
        } else {
            $q = '';
            $search_sql = '';
        }
        
        $this->_view_data['arr'] = $this->model->_dbt("select",['where'=>"1 = 1 $search_sql ORDER BY title"]);
        $this->_view_data['header_title'] = 'Books List';       
        echo $this->doView($this, $args['a']);        
    }

    public function edit($args = false) {
        
        if (!empty($this->get['p1'])) {
            $r = $this->db->findRow("SELECT * FROM books where id =".$this->get['p1']);
        }
        if (isset($this->post['btnEditAccount']) and !empty($r)) {
            $this->_view_data['arr'] = $this->post;
            $this->_view_data['arr']['id'] = $r->id;
            $this->Error->blank($this->post['author_id'], 'Author ID');
            $this->Error->blank($this->post['title'], 'Title');
            $this->Error->blank($this->post['isbn'], 'ISBN');
            if ($this->Error->ok()) {
                $this->model->edit($this->_view_data['arr']);
                $_SESSION["feedback"] = $this->post['title'] . " has been save!";
                $this->redirect2Url($this->home);
            }
        } elseif (!empty($r)) {
            $this->_view_data['arr'] = (array) $r;
            $this->_view_data['arr']['p1'] = $r->id;
            $this->_view_data['header_title'] = 'Book Edit';
            echo $this->doView($this, $args['a']);        
        } else {
            $this->redirect2Url();
        }
    } 

    public function delete($args = false) {
        
        $this->model->delete($this->get['p1']);
        $this->redirect2Url($this->home);
    }       

}
