<?php

require 'config.php';

if (isset($_POST['submit'])) {

  $ip   = $_SERVER['REMOTE_ADDR'];
  $name = $_POST['name'];
  $num  = $_POST['num'];

  try {

    $row = $pdo->query("SELECT COUNT(*) FROM ppl WHERE ip='$ip'")->fetchColumn();

    if ($row > 0) {

      throw new PDOException('1');

    }

    $row = $pdo->query("SELECT COUNT(*) FROM ppl WHERE name='$name' OR num=$num")->fetchColumn();

    if ($row > 0) {

      throw new PDOException('2');

    }

    $stmt = $pdo->query("INSERT INTO ppl (name, num, ip) VALUES ('$name', $num, '$ip')");

    if ($stmt === false) {

      throw new PDOException('3');

    }

    session_start();

    $_SESSION['info']['id']          = $pdo->lastInsertId();
    $_SESSION['info']['name']        = $name;
    $_SESSION['info']['num']         = $num;
    $_SESSION['info']['score']       = 0;
    $_SESSION['info']['has_session'] = true;
    $_SESSION['soal']                = array();

    $stmt = $pdo->query("SELECT * FROM soal");

    $i = 0;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      $_SESSION['soal'][$i]                     = $row;
      $_SESSION['soal'][$i]['sudah_dikerjakan'] = 0;
      $_SESSION['soal'][$i]['sudah_dilihat']    = 0;

      ++$i;

    }

    $_SESSION['jumlah_soal']       = $i;
    $_SESSION['jumlah_dikerjakan'] = 0;

    header('Location: q.php?n=1');

  } catch (PDOException $e) {
    
    if ($e->getMessage() === '1' || $e->getMessage() === '2') {

      $msg_title = urlencode("Peringatan!");
      $msg_text  = urlencode("Anda sudah pernah melakukan kuis sebelumnya!");
      $msg_icon  = "warning";
      $msg       = "msg_title=" . $msg_title . "&msg_text=" . $msg_text . "&msg_icon=" . $msg_icon;
      
      header('Location: index.php?' . $msg);

    } else {

      echo $e->getMessage();

    }

  }

}

?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Insan Penjaga Al-Qur'an</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container" style="margin-top: 30px;">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Forms</h3>
        </div>
        <div class="panel-body">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">@</span>
              <input type="text" class="form-control" name="name" placeholder="Nama" aria-describedby="basic-addon1">
            </div>
            <br>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">62</span>
              <input type="number" class="form-control" name="num" placeholder="Nomor HP" aria-describedby="basic-addon1">
            </div>
            <br>
            <button type="submit" class="btn btn-default" name="submit">Submit</button>
          </form>
        </div>
        <div class="panel-footer text-center">Insan Penjaga Al-Qur'an &copy; 2019</div>
      </div>
    </div>
    <div class="container text-center" style="margin-bottom: 30px;">
      <u><a href="admin.php">Admin</a></u>?
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