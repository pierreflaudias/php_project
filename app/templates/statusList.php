<h1>Hello, World!</h1>
<?php
foreach ($statuses as $status) {
    echo $status->message . "<br/>";
}
?>
<form action="/statuses" method="POST">
    <label for="username">Username:
        <input type="text" name="username">
    </label>

    <label for="message">Message:
        <textarea name="message"></textarea>
    </label>
    <input type="hidden" name="_method" value="POST">
    <input type="submit" value="Tweet!">
</form>