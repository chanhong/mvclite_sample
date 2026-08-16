<?php
use mvcLite\CUtil;
use mvcLite\CModel;
use mvcLite\CMsg;

  $msg = "";

try {
        $this->meTable = "sample_data";
        $this->model = new CModel($this->meTable); // create a mini model class in model folder
        $where = "1 = 1";
        $rows= $this->model->_dbt("select", ['where' => $where]);        
            \CUtil::outJson(json_encode($rows)); // Assuming static method call                  
} catch (Exception $e) {
    // -----------------------------------------------------------------
    // 5️⃣ Error handling – print the exception (mirrors Response.Write)
    // -----------------------------------------------------------------
    header('Content-Type: text/plain');
    echo $e->getMessage();
}
