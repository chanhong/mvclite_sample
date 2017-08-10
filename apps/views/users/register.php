<?PHP
$rUrl = $this->h->tap('/users/register');
?>
<div>
    <form action="<?php echo $this->h->tap("/users/register"); ?>" method="post">
        <p><label for="username">Username:</label> <input type="text" name="username" value="<?PHP //echo $username;       ?>" id="username" /></p>
        <p><label for="password">Password:</label> <input type="password" name="password" value="" id="password" /></p>
        <p><input type="submit" name="btnlogin" value="Register" id="btnlogin" />
            <input Type="button" VALUE="Go Back" onClick="history.go(-1);
                    return true;">          
        </p>
        <input type="hidden" name="r" value="<?PHP echo htmlspecialchars(@$_REQUEST['r']); ?>" id="r">
    </form>
</div>