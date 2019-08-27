<?php

require 'auth.php';
require 'config.php';

try {

	try {

		if (!isset($_GET['id'])) {

			throw new Exception('Process Can\'t Be Executed');
		}
		
	} catch (Exception $e) {

		echo $e->getMessage();
		
	}

	$id   = $_GET['id'];
	$stmt = $pdo->query("DELETE FROM soal WHERE id=$id");

	if ($stmt === false) {

		throw new PDOException('Error Processing Request.');

	} else {

		$msg_title = urlencode("Berhasil!");
		$msg_text  = urlencode("Soal berhasil dihapus!");
		$msg_icon  = "success";
		$msg       = "msg_title=" . $msg_title . "&msg_text=" . $msg_text . "&msg_icon=" . $msg_icon;

		header("Location: a_view.php?" . $msg);

	}
	
} catch (PDOException $e) {

	echo $e->getMessage();
	
}

?>