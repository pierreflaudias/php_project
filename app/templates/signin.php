<!DOCTYPE html >
<html>
<head>
    <title> Twitter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Signin</h1>
    <form class="form-horizontal" method="POST">
        <div class="form-group">
            <label for="login"> Login : </label><input type="text" name="login" id="login" class="form-control">
        </div>
        <div class="form-group">
            <label for="password"> Password : </label><input type="password" name="password" id="password"
                                                             class="form-control">
        </div>
        <input type="hidden" name="_method" value="POST">
        <button type="submit" class="btn btn-info">Sign in</button>
    </form>
</div>
</body>
</html>