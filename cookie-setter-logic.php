<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$userEmail = $_SESSION['login']??"Invalid";

$keywordString = $_POST['keywordString'];
$keywords = explode(", ", $keywordString);

$time = $_POST['time'];

$sql = "";
foreach ($keywords as $keyword){
    $conn = mysqli_connect("localhost", "root", "", "tms");
    $sql = "INSERT INTO cookies (userEmail, keyword, time) VALUES ('$userEmail', '$keyword', $time)";
    mysqli_query($conn, $sql);
}
echo $sql;
