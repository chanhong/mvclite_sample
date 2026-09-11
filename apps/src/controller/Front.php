<?php
#namespace MvcSample;
namespace MvcLite;
class Front extends BaseController
{

        public function __construct()
        {

                parent::__construct();
                $this->layout = "bootstrap";
                $this->_view_data['profile'] = CSetting::$_usrInfo;
        }

        public function start($args = false)
        {
                //        pln($this->cfg->get('mnutop'));

                //        var_dump(spl_object_id($this->db)); //int(16)
//    pln($_SESSION['lastUrl'] ?? 'NOT SET', 'lastUrl-check');             
                $ret = $this->doAction($args, self::class);
        }

}
