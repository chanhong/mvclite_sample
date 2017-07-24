<?PHP
$this->_view_data['title'] = 'User Edit';
$rUrl = $this->h->tap('/users/edit');
//$this->requireAdmin($rUrl); // if not admin redirect to login and return here
$user = $data['arr'];
?>

<div>
    <form action="<?php echo $this->h->tap('/users/edit/' . $user['p1']); ?>" method="post">
        <p><label for="username">Username</label> <input type="text" name="username" id="username" value="<?PHP echo $user['username']; ?>" class="text"></p>
        <p><label for="password">Password</label> <input type="password" name="password" id="password" value="" class="text"><span class="info">Leave the password blank if you do not wish to change it</span></p>
        <p><label for="level">Level</label>
            <select name="level" id="level">
                <option <?PHP if ($user['level'] == 'user') echo 'selected="selected"'; ?> value="user">User</option>
                <option <?PHP if ($user['level'] == 'admin') echo 'selected="selected"'; ?> value="admin">Admin</option>
            </select>
        </p>
        <p><input type="submit" name="btnEditAccount" value="Save" id="btnEditAccount"></p>
    </form>
</div>

