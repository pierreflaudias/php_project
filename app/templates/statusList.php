<h1>Hello, World!</h1>
<?php
foreach ($statuses as $status) {
	echo $status->message . "<br/>";
}
?>
<form action="/statuses" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username">

    <label for="message">Message:</label>
    <textarea name="message"></textarea>
	<input type="hidden" name="_method" value="POST">
    <input type="submit" value="Tweet!">
</form>