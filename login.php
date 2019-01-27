<?php
//ob_start();
//session_start();
require_once ("Head.php");
require_once ("database/LoginAccess.php");
require_once ("database/DataAccess.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_access = new LoginAccess();
    $data_access = new DataAccess();
    $indx = $_POST['index'];
    $password = $_POST['password'];
    $row = null;
    try {
        $row = $login_access->login("infor", $indx, $password);
    } catch (PDOException $e) {
        $row = false;
    }
    if ($row) {
        $data_access->redirect('admin.php');
    } else {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("OOPs! ...","Invalid Index or Password!","warning");';
        echo '}, 1000);</script>';
    }
}
?>
<body id="login" style="background: linear-gradient(to right, #f0f2f0 0%, #303939 100%);">
    <div class="container"><br/><br/><br/><br/><br/>

        <form class="form-login" action="<?php $_PHP_SELF ?>" method="POST">
            <h2 class="form-signin-heading">Please Login in</h2>
            <input type="text" class="input-block-level" name="index" placeholder="Index">
            <input type="password" class="input-block-level" name="password" placeholder="Password">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <button class="btn btn-large btn-success" type="submit">Login</button><a> Not Registered ? Please Registry</a>
        </form>

    </div>
</body>
</html>