<?php
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("BASE", "seduc_db");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new MySQLi(HOST, USER, PASS, BASE);
$conn->set_charset("utf8");
