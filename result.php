<?php

session_start();

require 'config.php';

try {

	if (!isset($_SESSION['info']['has_session'])) {

		throw new Exception();
	}
	
} catch (Exception $e) {

	$msg_title = urlencode("Error!");
	$msg_text  = urlencode("Masukkan data terlebih dahulu!");
	$msg_icon  = "error";
	$msg       = "msg_title=" . $msg_title . "&msg_text=" . $msg_text . "&msg_icon=" . $msg_icon;

	header("Location: index.php?" . $msg);
	die();
	
}

if ($_SESSION["jumlah_dikerjakan"] == $_SESSION["jumlah_soal"]) {

	$jumlah_benar = 0;
	$benar        = array();

	for ($counter = 0; $counter < $_SESSION["jumlah_soal"]; ++$counter) {

		if ($_SESSION["soal"][$counter]["jawaban_user"] == $_SESSION["soal"][$counter]["kunci_jawaban"]) {

			$_SESSION["info"]["score"] += 1;
			$benar[$counter]				 = 1;
			$jumlah_benar					+= 1;

		} else $benar[$counter] = 0;
	}

	$id    = $_SESSION["info"]["id"];
	$score = $_SESSION["info"]["score"];

	try {

		$stmt = $pdo->query("UPDATE ppl SET score=$score WHERE id=$id");

		if ($stmt === false) {

			throw new PDOException('Error Processing Request');
			
		}
		
	} catch (PDOException $e) {

		echo $e->getMessage();
		
	}

} else {

	header("Location: q.php?n=1");
	die();

}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Result - Insan Penjaga Al-Qur'an</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body style="margin-top: 30px;">
		<?php

		$template = "<div class='container'><div class='well text-center'>%d. %s</div>
					<div class='radio'><label><input type='radio' name='id%d' value='a' %s><span style='color: %s;'> %s</span></label></div>
					<div class='radio'><label><input type='radio' name='id%d' value='b' %s><span style='color: %s;'> %s</span></label></div>
					<div class='radio'><label><input type='radio' name='id%d' value='c' %s><span style='color: %s;'> %s</span></label></div>
					<div class='radio'><label><input type='radio' name='id%d' value='d' %s><span style='color: %s;'> %s</span></label></div>
					</div>";

		for ($counter = 0; $counter < $_SESSION["jumlah_soal"]; ++$counter) {

			if ($benar[$counter]) {

				printf(
					$template, $counter+1, $_SESSION["soal"][$counter]["pertanyaan"],
					$_SESSION["soal"][$counter]['id'], ($_SESSION["soal"][$counter]["jawaban_user"] == 'a' ? "checked" : ""), "green", $_SESSION["soal"][$counter]["pilihan_1"],
					$_SESSION["soal"][$counter]['id'], ($_SESSION["soal"][$counter]["jawaban_user"] == 'b' ? "checked" : ""), "green", $_SESSION["soal"][$counter]["pilihan_2"],
					$_SESSION["soal"][$counter]['id'], ($_SESSION["soal"][$counter]["jawaban_user"] == 'c' ? "checked" : ""), "green", $_SESSION["soal"][$counter]["pilihan_3"],
					$_SESSION["soal"][$counter]['id'], ($_SESSION["soal"][$counter]["jawaban_user"] == 'd' ? "checked" : ""), "green", $_SESSION["soal"][$counter]["pilihan_4"]
					);

			} else {

				printf(
					$template, $counter+1, $_SESSION["soal"][$counter]["pertanyaan"],
					$_SESSION["soal"][$counter]['id'], ($_SESSION["soal"][$counter]["jawaban_user"] == 'a' ? "checked" : ""), "red", $_SESSION["soal"][$counter]["pilihan_1"],
					$_SESSION["soal"][$counter]['id'], ($_SESSION["soal"][$counter]["jawaban_user"] == 'b' ? "checked" : ""), "red", $_SESSION["soal"][$counter]["pilihan_2"],
					$_SESSION["soal"][$counter]['id'], ($_SESSION["soal"][$counter]["jawaban_user"] == 'c' ? "checked" : ""), "red", $_SESSION["soal"][$counter]["pilihan_3"],
					$_SESSION["soal"][$counter]['id'], ($_SESSION["soal"][$counter]["jawaban_user"] == 'd' ? "checked" : ""), "red", $_SESSION["soal"][$counter]["pilihan_4"]
					);

			}
		}

		echo "<div class='container text-center'><span>" . $jumlah_benar . " out of " . $_SESSION["jumlah_soal"] . "</span></div>";

		?>
		<div class="container" style="height: 30px;"></div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
<?php

session_destroy();

?>