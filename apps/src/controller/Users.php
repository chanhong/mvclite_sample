<?php

use MvcLite\MvcCore;

class Users extends BaseController {

    public $home;

    public function __construct() {
        
        parent::__construct();
        $this->meTable = "users";         
        $this->model = new UserModel($this->meTable);
//        $this->_view_data['cmenu'] = $this->h->getLiMenu(MvcCore::$_cfg['menu']['cmenu']['front']);        
        $this->_view_data['submenu'] = $this->h->getLiMenu(MvcCore::$_cfg['menu']['submenu']['user']);               
        
    }

    public function start($args = false) {

        $ret = self::doAction($args, self::class);
    }

    public function index($args = false) {
        
        if (isset($this->post['q'])) {
            $q = $this->post['q'];
            $_q = $this->db->escapeQuote($q);
            $search_sql = " AND (username LIKE '%$_q%') ";
        } else {
            $q = '';
            $search_sql = '';
        }
        
        $this->_view_data['arr'] = $this->model->_dbt("select",['where'=>"1 = 1 $search_sql ORDER BY username"]);
        $this->_view_data['header_title'] = 'User List';       
        echo $this->doView($this, "index");        
    }

    public function login($args = false) {

        $this->_view_data['winlogin'] = "";
        $this->_view_data['winuser'] = $this->Auth->winUser();
        if (!empty($this->_view_data['winuser'])) {
            $this->_view_data['winlogin'] = $this->renderAppView("_winlogin", $this->_class_path);
        }
        $this->_view_data['weblogin'] = $this->renderAppView("_weblogin", $this->_class_path);
        $this->_view_data['header_title'] = 'User Login';       
        echo $this->doView($this,"login");
    }

    public function _winlogin($args = false) {

        $this->_view_data['winuser'] = $winUser = $this->Auth->winUser();
        if (!empty($this->post['winbtnlogin'])) {
            $entity = $msg = "";
            if (!empty($winUser)) {
                if (!empty($args['wuentity'])) {
                    $entity = "and entities like '%".$args['wuentity']."%'";
                    $msg = " Entity: [".$args['wuentity']."]";
                }
                $where = "winuser='$winUser' and is_confirmed = '1' $entity";
                if (self::isAuthorized($winUser, $where, $this->meTable)) {
                    $_SESSION["loggedin"] = $winUser;                
                    self::Add2SessVar("feedback", "You has been login as [$username] $msg!");
// after redirect, the   MvcAuth::myProfile() are gone, why?
                    self::redirect2Url($this->retUrl); // good login                           
                } 
            }
        } else {
            $this->_view_data['header_title'] = 'Win Login';       
            echo $this->doView($this,"_winlogin");
        }
    }
       
    public function _weblogin($args = false) {

        $userinfo="";
        extract($this->post); // extract array into respective variables  
        $r = $this->model->isUserExist($username);
        if (!empty($username) and !empty($r) and !empty($password)) {
            $hashed_password = $this->Auth->md5Hash($password, $r['nid']);
            $where = "username='$username' and password='".$hashed_password."' and is_confirmed = '1'"; 
            if ($userinfo = self::isAuthorized($password, $where, $this->meTable)) {
                $_SESSION["loggedin"] = $username;                
                self::Add2SessVar("feedback", "You has been login as [$username]!");
                // after redirect, the   MvcAuth::myProfile() are gone, why?
                self::redirect2Url($this->retUrl); // good login                           
            } 
        }

        if (empty($userinfo)) {
            $this->_view_data['header_title'] = 'Web Login';       
            $this->Error->add('username', "We're sorry, wrong login. Please try again.");
            echo $this->doView($this,"_weblogin");
        }
    }


    public function logout($args = false) {
        
        self::Add2SessVar("feedback", "You has been logout!");                
        $this->Auth->logout();
        $this->redirect2Url($this->retUrl);
    }
    
    public function register($args = false) {
        
        if (!empty($this->post['username']) and ! empty($this->post['password']) ) {
            if ($ret = $this->model->create($this->post)) {
                self::Add2SessVar("feedback", $this->post['username'] . " has been created!");
                $this->redirect2Url($this->retUrl);
            } else {
                $this->Error->add('username', "We're sorry, registration failed! Please try again.");
            }
        } elseif (isset($this->post['btnlogin'])) {
            $this->Error->add('username', "We're sorry, required info are missing!");
        }
        echo $this->doView($this,"register");
    }


    public function delete($args = false) {
        
        $this->model->delete($this->get['p1']);
        $this->redirect2Url($this->home);
    }

    public function edit($args = false) {
        $u=null;
        if (!empty($this->get['p1'])) {
            $u = $this->db->findRow("SELECT * FROM " .$this->meTable." where id =".$this->get['p1']);
        }
        
        if (isset($this->post['btnEditAccount']) and !empty($u)) {
            $this->_view_data['arr'] = $this->post;
            $this->_view_data['arr']['id'] = $u->id;
            $this->_view_data['arr']['nid'] = $u->nid;
            $this->_view_data['arr']['confirm_hash'] = $u->confirm_hash;

            $this->Error->blank($this->post['username'], 'Username');
            $this->Error->blank($this->post['level'], 'Level');
            if ($this->Error->ok()) {
                $this->model->edit($this->_view_data['arr']);
                self::Add2SessVar("feedback", $this->post['username'] . " has been saved!");
                $this->redirect2Url($this->home);
            }
        } elseif (!empty($u)) {
            $this->_view_data['arr'] = (array) $u;
            $this->_view_data['arr']['p1'] = $u->id;
            echo $this->doView($this, "edit");        
        } else {
            $this->redirect2Url();
        }
    }

    public function create($args = false) {
        
        if (isset($this->post['btnCreateAccount'])) {
            $this->Error->blank($this->post['username'], 'Username');
            $this->Error->blank($this->post['password'], 'Password');
            $this->Error->blank($this->post['level'], 'Level');

            if ($this->Error->ok()) {
                $this->model->create($this->post);
                self::Add2SessVar("feedback", $this->post['username'] . " has been created!");
                $this->redirect2Url($this->home);
            } else {
                self::Add2SessVar("feedback", "Failed to create ".$this->post['username'] . "!");
                $this->_view_data['arr'] = $this->post;
            }
        } else {
            $this->_view_data['arr'] = array('username' => '', 'level' => 'user');
        }
        $this->_view_data['header_title'] = 'User Create';       
        echo $this->doView($this, "create");        
    }


}
