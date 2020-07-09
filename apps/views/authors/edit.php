<?PHP
$rUrl = $this->h->tap('/authors/edit');
//$this->requireAdmin($rUrl); // if not admin redirect to login and return here
$rec = $pageData['arr'];
?>

<div>
    <form action="<?php echo $this->h->tap('/authors/edit/' . $rec['p1']); ?>" method="post">
        <p><label for="name">Name</label> <input type="text" name="name" id="name" value="<?PHP echo $rec['name']; ?>" class="text"></p>
        <p><label for="biography">Biography</label> <input type="text" name="biography" id="biography" value="<?PHP echo $rec['biography']; ?>" class="text"></p>
        <p><input type="submit" name="btnEditAccount" value="Save" id="btnEditAccount"></p>
    </form>
</div>

