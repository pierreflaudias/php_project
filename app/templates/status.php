<?php include_once 'header.php'; ?>
    <h1>Tweet <?= $status->getId() ?></h1>
    <p><?= $status->getContent() ?></p>
    <form class="form-horizontal" action="/statuses/<?= $status->getId() ?>" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
</body>
</html>
