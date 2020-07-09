<?PHP
$rUrl = $this->h->tap('/books/edit');
//$this->requireAdmin($rUrl); // if not admin redirect to login and return here
$rec = $pageData['arr'];
?>

<div>
    <form action="<?php echo $this->h->tap('/books/edit/' . $rec['p1']); ?>" method="post">
        <p><label for="author_id">Author ID</label> <input type="text" name="author_id" id="author_id" value="<?PHP echo $rec['author_id']; ?>" class="text"></p>
        <p><label for="title">Title</label> <input type="text" name="title" id="title" value="<?PHP echo $rec['title']; ?>" class="text"></p>
        <p><label for="isbn">ISBN</label> <input type="text" name="isbn" id="isbn" value="<?PHP echo $rec['isbn']; ?>" class="text"></p>
        <p><input type="submit" name="btnEditAccount" value="Save" id="btnEditAccount"></p>
    </form>
</div>

