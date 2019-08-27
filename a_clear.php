<?php

require 'auth.php';
require 'config.php';

try {

	$stmt = $pdo->query("DELETE FROM ppl");

	if ($stmt === false) {

		throw new PDOException('Error Processing Request.');

	} else {

		$msg_title = urlencode("Berhasil!");
		$msg_text  = urlencode("Scoreboard berhasil dibersihkan!");
		$msg_icon  = "success";
		$msg       = "msg_title=" . $msg_title . "&msg_text=" . $msg_text . "&msg_icon=" . $msg_icon;

		header("Location: a_result.php?" . $msg);
	}
	
} catch (PDOException $e) {

	echo $e->getMessage();
	
}

?>