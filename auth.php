<?php

session_start();

try {

	if (!isset($_SESSION['admin'])) {

		throw new Exception();

	}
	
} catch (Exception $e) {
	
	$msg_title = urlencode("Peringatan!");
	$msg_text  = urlencode("Anda harus login terlebih dahulu!");
	$msg_icon  = "warning";
	$msg       = "msg_title=" . $msg_title . "&msg_text=" . $msg_text . "&msg_icon=" . $msg_icon;
	
	header('Location: admin.php?' . $msg);

}

?>