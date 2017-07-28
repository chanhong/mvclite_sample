<?php
//namespace MvcSample;

use MvcLite\Util;

class Users extends BaseController {

    public $home;

    public function __construct() {
        
        parent::__construct();
        $this->meTable = "users";         
        $this->layout = "default";        
        $this->model = new UserModel($this->meTable);
        $this->_view_data['meta'] = $this->h->meta("utf-8"); // in view $data['meta']
        $this->add2Array4Layout("css", "css/menu.css");
        $this->add2Array4Layout("css", "css/menu-original.css");
//        $this->add2Header("css", "public/css/yuiapp.css");
        $this->home = $this->h->tap('/users/index');
        $this->_view_data['menu'] = $this->h->getLiMenu(BaseCore::$_cfg['menu']['front']);            
        $this->_view_data['menu'] .= $this->h->getLiMenu(BaseCore::$_cfg['menu']['user']);            
    }

    public function start($args = false) {

        $this->_view_data['menu'] = $this->h->getLiMenu(BaseCore::$_cfg['menu']['user']);                
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
        echo self::doView($this, "index");        
    }

    public function login($args = false) {

        $this->_view_data['winuser'] = $this->Auth->winUser();
        if (!empty($this->_view_data['winuser'])) {
            $this->_view_data['winlogin'] = $this->renderAppView("_winlogin");
        }
        $this->_view_data['weblogin'] = $this->renderAppView("_weblogin");
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
                
                $_SESSION['debug'] = "Windows user: [$winUser] $msg";
                $where = "winuser='$winUser' and is_confirmed = '1' $entity";
                if (BaseCore::$_userInfo = $this->isAuthorized($winUser, $where, $this->meTable)) {
                    $this->redirect2Url($this->retUrl); // good login                           
                } 
            }
        }
        echo $this->doView($this,"winlogin");
    }

    public function _weblogin($args = false) {

        if (!empty($this->post['username'])) {
            $username = $this->post['username'];
            $r = $this->model->_dbt("dbrow",['where'=>"username='$username'"]); 
        }

        if (!empty($r) and !empty($this->post['password'])) {
            $password = $this->post['password'];
            $hashed_password = $this->Auth->md5Hash($password, $r['nid']);
            $_SESSION['debug'] = "User: [$username]";
            $where = "username='$username' and password='".$hashed_password."' and is_confirmed = '1'"; 
            if (BaseCore::$_userInfo =  $this->isAuthorized($password, $where, $this->meTable)) {
                $this->redirect2Url($this->retUrl); // good login                           
            } else {
                $this->Error->add('username', "We're sorry, login failed. Please try again.");
            }
        } else {
            $this->Error->add('username', "We're sorry, wrong login. Please try again.");
        }

        echo $this->doView($this,"_weblogin");
    }

    public function logout($args = false) {
        
        $this->Auth->logout();
        $this->redirect2Url($this->retUrl);
    }
    
    public function register($args = false) {
        
        if (!empty($this->post['username']) and ! empty($this->post['password']) ) {
            if ($ret = $this->model->create($this->post)) {
                $_SESSION["feedback"] = $this->post['username'] . " has been created!";
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
////        $this->db->delete($this->meTable, $this->get['p1']);
        $this->redirect2Url($this->home);
    }

    public function edit($args = false) {
        
        $u = $this->db->findRow("SELECT * FROM users where id =".$this->get['p1']);
        if (isset($this->post['btnEditAccount']) and !empty($u)) {
            $this->_view_data['arr'] = $this->post;
            $this->_view_data['arr']['id'] = $u->id;
            $this->_view_data['arr']['nid'] = $u->nid;
            $this->_view_data['arr']['confirm_hash'] = $u->confirm_hash;

            $this->Error->blank($this->post['username'], 'Username');
            $this->Error->blank($this->post['level'], 'Level');
            if ($this->Error->ok()) {
                $this->model->edit($this->_view_data['arr']);
                $_SESSION["feedback"] = $this->post['username'] . " has been save!";
                $this->redirect2Url($this->home);
            }
        } elseif (!empty($u)) {
            $this->_view_data['arr'] = (array) $u;
            $this->_view_data['arr']['p1'] = $u->id;
            echo self::doView($this, "edit");        
        }
    }

    public function create($args = false) {
        
        if (isset($this->post['btnCreateAccount'])) {
            $this->Error->blank($this->post['username'], 'Username');
            $this->Error->blank($this->post['password'], 'Password');
            $this->Error->blank($this->post['level'], 'Level');

            if ($this->Error->ok()) {
                $this->model->create($this->post);
                $_SESSION["feedback"] = $this->post['username'] . " has been created!";
                $this->redirect2Url($this->home);
            } else {
                $_SESSION["feedback"] = "Failed to create ".$this->post['username'] . "!";
                $this->_view_data['arr'] = $this->post;
            }
        } else {
            $this->_view_data['arr'] = array('username' => '', 'level' => 'user');
        }
        echo self::doView($this, "create");        
    }
}
