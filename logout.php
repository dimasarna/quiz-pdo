<?php

session_start();
session_unset();
session_destroy();

$msg_title = urlencode("Berhasil!");
$msg_text = urlencode("Logout berhasil!");
$msg_icon = "success";
$msg = "msg_title=" . $msg_title . "&msg_text=" . $msg_text . "&msg_icon=" . $msg_icon;

header("Location: index.php?" . $msg);

?>