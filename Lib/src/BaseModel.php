<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace MvcSample;

use MvcLite\MvcModel;
use MvcLite\Util;

class BaseModel extends MvcModel {
    
    public function __construct($tname, $id = null) {
        
        parent::__construct($tname, $id = null);    
    }
}
