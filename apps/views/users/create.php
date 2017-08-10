<?PHP
$rUrl = $this->h->tap('/users/create');
//$this->requireAdmin($rUrl); // if not admin redirect to login and return here
$user = $data['arr'];
?>

<div>
    <form action="<?php echo $this->h->tap('/users/create'); ?>" method="post">
        <p><label for="username">Username</label> <input type="text" name="username" id="username" value="<?PHP echo $user['username']; ?>" class="text"></p>
        <p><label for="password">Password</label> <input type="password" name="password" id="password" value="" class="text"></p>
        <p><label for="level">Level</label>
            <select name="level" id="level">
                <option <?PHP if ($user['level'] == 'user') echo 'selected="selected"'; ?> value="user">User</option>
                <option <?PHP if ($user['level'] == 'admin') echo 'selected="selected"'; ?> value="admin">Admin</option>
            </select>
        </p>
        <p><input type="submit" name="btnCreateAccount" value="Create Account" id="btnCreateAccount"></p>
    </form>
</div>

