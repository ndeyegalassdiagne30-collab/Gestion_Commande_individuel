
<?php
$_scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$_host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
define("WEBROOT", $_scheme . "://" . $_host . "/");
define("ROOT", dirname(__FILE__, 2) . "/");

require_once ROOT. "env.php";
require_once ROOT."/config/config.php";
require_once ROOT."/config/helper.php";
require_once ROOT."/config/validator.php";

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once ROOT."/router/router.php";

 