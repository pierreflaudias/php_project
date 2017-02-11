<?php include_once 'header.php'; ?>
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