<?php
require 'auth.php';

if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on") {

	$newUrl = "https";

} else $newUrl = "http";

$newUrl .= "://";
$newUrl .= $_SERVER["HTTP_HOST"];
$newUrl .= "/a_clear.php";

?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Insan Penjaga Al-Qur'an</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  	<nav class="navbar navbar-inverse">
	  <div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="a_main.php">Insan Penjaga Al-Qur'an</a>
	    </div>
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="a_main.php">Dashboard <span class="sr-only">(current)</span></a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Soal <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="a_add.php">Add</a></li>
	            <li><a href="a_view.php">View</a></li>
	          </ul>
	        </li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hasil <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="a_result.php">View</a></li>
	            <li><a href="a_clear.php" id="confAnchor" onclick="confirm();">Clear</a></li>
	          </ul>
	        </li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="logout.php">Logout</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<div class="jumbotron text-center">
      <div class="container">
        <h1>Insan Penjaga Al-Qur'an</h1>
        <p>Barangsiapa yang mempelajari al-Qur'an, maka menjadi agunglah kedudukannya. (Nuzhatul Fudhala, II/734)</p>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
		document.getElementById("confAnchor").addEventListener("click", function(event){
		  event.preventDefault()
		});
		function confirm() {
			swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this data!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	window.location.href = "<?php Print($newUrl); ?>";
			  } else {
			    swal("Your data is safe!");
			  }
			});
		}
    </script>
  </body>
</html>