<?php
?>
<div>
    <form action="<?php echo $this->h->tap("/users/_winlogin"); ?>" method="post">
        <?php
        ?>  
        <fieldset>
            <legend>Login Form</legend>
            <p>Your Windows login [<?php echo $data['winuser'];?>] is pre-authorized to have direct access without using username and password.
            <p /><font size="-1"><i>(Click button below to login with your Windows credential)</i></font>
            </p>
            <p><input type="submit" name="winbtnlogin" value="Login with your Windows credential" id="winbtnlogin" />
                <!-- input Type="button" VALUE="Go Back" onClick="history.go(-1); return true;" --></p>        
            <input type="hidden" name="r" value="<?PHP echo htmlspecialchars(@$_REQUEST['r']) ?>" id="r">
        </fieldset>
    </form>
</div>