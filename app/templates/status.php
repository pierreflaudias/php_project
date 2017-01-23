<h1>Hello, World!</h1>
<?php
echo $status->message;
?>
<form action="/statuses/<?= $status->id ?>" method="POST">
    <input type="hidden" name="_method" value="DELETE">
    <input type="submit" value="Delete">
</form>
