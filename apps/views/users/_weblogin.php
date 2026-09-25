<?php
use mvclite\CSetting;
$this->_view_data['header_title'] = 'Web Login';
(!empty($this->post['username'])) ? $username = $this->post['username'] : $username = "";
        $vfdr = "users". "/" . CSetting::get("_rp") ??'_r_';

?>
<div>
    <form action="<?php echo $this->h->tap("/users/_weblogin"); ?>" method="post">
        <?php
        ?>        
        <p><label for="username">Username:</label> <input type="text" name="username" value="<?PHP echo $username; ?>" id="username" /></p>
        <p><label for="password">Password:</label> <input type="password" name="password" value="" id="password" /></p>
        <p><input type="submit" name="webbtnlogin" value="Submit" id="webbtnlogin" />
            <!-- input Type="button" VALUE="Go Back" onClick="history.go(-1); return true;" --></p>        
        <input type="hidden" name="r" value="<?PHP echo htmlspecialchars(@$_REQUEST['r'] ?? '') ?>" id="r">
    </form>
</div>