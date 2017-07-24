<?php
use MvcLite\Util;
use MvcLite\MvcCore;

class UserModel extends BaseModel {

    public function __construct($tname, $id = null) {
        
        parent::__construct($tname, $id = null); 
    }

    public function xxlogin($validate, $where) {

        if (BaseCore::$_userInfo = $this->isAuthorized($validate, $where, $this->meTable)) {
            $this->redirect2Url($this->retUrl); // good login                           
        } 
    }

    public function notuse_setPassword($password) {
        
        $this->password = sha1($password . $this->Auth->salt);
    }

    public function delete($id) {
        
        if (ctype_digit($id)) {
            $where = "id ='$id'";
            $_SESSION['feedback'] = "delete " . $id ;
            $this->_dbt("delete",['where'=>$where]);
        }
    }

    public function create($userInfo) {
        
        $this->ut->debug($userInfo);
        extract($userInfo); // extract array into respective variables
//        $user_exists1 = $this->db->findRow("SELECT * FROM ".$this->meTable." where username ='$username'");
//        if ($user_exists > 0)
//        if (!empty($user_exists))
//            return false;

        if (!empty($this->_dbt("dbrow",['where'=>"username='$username'"]))) {
            $_SESSION['feedback'] = "Failed to create " . $userInfo['username'];
            return false;
        }; 

        if (is_null($password))
            $password = $this->Auth->generateStrongPassword();

        srand(time());
        (!empty($level)) ? $nlevel = $level : $nlevel = "user";
        
        $nextjvid = $this->_dbt("getnextid", "id");
        $userInfo["id"] = $nextjvid;
        $userInfo["level"] = $nlevel;
        $userInfo["nid"] = $this->Auth->newNid();
        $userInfo["password"] = $this->Auth->md5Hash($password, $userInfo["nid"]);
        $this->_dbt("insert",['fl'=>$userInfo]);
        $_SESSION['feedback'] = "create " . $userInfo['username'];
        return $nextjvid;
    }

    public function edit($userInfo) {
        
        Util::debug($userInfo,'userInfo in model');
        extract($userInfo); // extract array into respective variables
        // Leave the password alone if it's not set
        if (!empty($password)) {
            // new password with nid as salt
            $password = $this->Auth->md5Hash($password, $nid);
        }

        $sqlUpdList = ['username'=>$username, 'level'=>$level, 'password'=>$password];
        $this->_dbt("update",['fl'=>$sqlUpdList, 'where'=>"id='$id'"]);
    }
    
// custom version of create, need to look further and compare
    public static function createNewUser($username, $password = null) {
        
//        $user_exists = $this->db->dbRow($this->meTable, ['where'=>"username ='$username'"]);
        $user_exists = $this->_dbt("dbrow",['where'=>"username ='$username'"]);
        
        if ($user_exists > 0)
            return false;

        if (is_null($password))
            $password = MVCAuth::generateStrongPassword();

        srand(time());
        $u = new User();
        $u->username = $username;
        $u->nid = self::newNid();
//        $u->password = self::hashedPassword($password);
        $u->password = self::hashedPassword($password, $u->nid);
        $u->insert();
        return $u;
    }


    public function changeCurrentUsername($new_username) {
//        $db = Database::getDatabase();
       
        srand(time());
        $this->user->nid = Auth::newNid();
        $this->nid = $this->user->nid;
        $this->user->username = $new_username;
        $this->username = $this->user->username;
        $this->user->update();
        $this->generateBCCookies();
    }

    public function changeCurrentPassword($new_password) {
        
        srand(time());
        $this->user->nid = self::newNid();
        $this->user->password = $this->Auth->md5Hash($new_password);
        $this->user->update();
        $this->nid = $this->user->nid;
        $this->generateBCCookies();
    }

    public static function changeUsername($id_or_username, $new_username) {
        if (ctype_digit($id_or_username))
            $u = new User($id_or_username);
        else {
            $u = new User();
            $u->select($id_or_username, 'username');
        }

        if ($u->ok()) {
            $u->username = $new_username;
            $u->update();
        }
    }

    public static function changePassword($id_or_username, $new_password) {
        if (ctype_digit($id_or_username))
            $u = new User($id_or_username);
        else {
            $u = new User();
            $u->select($id_or_username, 'username');
        }

        if ($u->ok()) {
            $u->nid = self::newNid();
            $u->password = $this->Auth->md5Hash($new_password);
            $u->update();
        }
    }

}
