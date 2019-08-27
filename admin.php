<?php

require 'config.php';

if (isset($_POST['submit'])) {

  $uname = $_POST['uname'];
  $pw    = $_POST['pw'];

  try {
    
    if ($uname === 'admin' && $pw === 'lppqinpal') {

      session_start();

      $_SESSION['admin'] = 1;

      header('Location: a_main.php');

    } else {

      throw new Exception();
      
    }

  } catch (Exception $e) {
    
    $msg_title = urlencode("Error!");
    $msg_text  = urlencode("Username atau password salah!");
    $msg_icon  = "error";
    $msg       = "msg_title=" . $msg_title . "&msg_text=" . $msg_text . "&msg_icon=" . $msg_icon;

    header("Location: admin.php?" . $msg);

  }
  
}

?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Insan Penjaga Al-Qur'an</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container" style="margin-top: 30px;">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Login</h3>
        </div>
        <div class="panel-body">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">@</span>
              <input type="text" class="form-control" name="uname" placeholder="Username" aria-describedby="basic-addon1">
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
              <input type="password" class="form-control" name="pw" placeholder="Password" aria-describedby="basic-addon1">
            </div>
            <br>
            <button type="submit" class="btn btn-default" name="submit">Submit</button>
          </form>
        </div>
        <div class="panel-footer text-center">Insan Penjaga Al-Qur'an &copy; 2019</div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php

    if (isset($_GET["msg_title"]) && isset($_GET["msg_text"]) && isset($_GET["msg_icon"])) {
      echo "<script>swal('" . $_GET["msg_title"] . "', '" . $_GET["msg_text"] . "', '" . $_GET["msg_icon"] . "');</script>";
    }

    ?>
  </body>
</html>