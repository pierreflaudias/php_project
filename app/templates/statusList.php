<!DOCTYPE html>
<html>
	<head>
		<title>Twitter</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<h1>Tweets</h1>
			<table class="table table-bordered table-hover">
				<?php
				foreach ($statuses as $status) {?>
				    <tr><td><a href="/statuses/<?= $status->id ?>">Tweet <?= $status->id ?></a> : <?= $status->message ?></td></tr>
				<?php
				}
				?>
			</table>
			<form action="/statuses" method="POST" class="form-horizontal">
				<div class="form-group">
				    <label for="username">Username:
				        <input type="text" name="username" class="form-control" required>
				    </label>
				 </div>
				 <div class="form-group">
				    <label for="message">Message :</label>
				        <textarea name="message" class="form-control" required></textarea>
				 </div>
				    <input type="hidden" name="_method" value="POST">
				    <button class="btn btn-info" type="submit">Tweet !</button>
			</form>
		</div>
	</body>
</html>
