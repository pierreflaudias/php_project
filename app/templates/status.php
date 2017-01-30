<!DOCTYPE html>
<html>
	<head>
		<title>Twitter</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<h1>Tweets</h1>
			<p><?= $status->message; ?></p>
			<form class="form-horizontal" action="/statuses/<?= $status->id ?>" method="POST">
			    <input type="hidden" name="_method" value="DELETE">
			    <button type="submit" class="btn btn-danger">Delete</button>
			</form>
		</div>
	</body>
</html>
