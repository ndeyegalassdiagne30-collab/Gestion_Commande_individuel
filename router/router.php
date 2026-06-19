<?php

$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);
$request = trim($request, '/');


if (!empty($request) && strpos($request, '?') === false) {
    $parts = explode('/', $request);
    
    if (count($parts) >= 2) {

        $_GET['controller'] = $parts[0];
        $_GET['action'] = $parts[1];
        $_REQUEST['controller'] = $parts[0];
        $_REQUEST['action'] = $parts[1];
    }
}


$controllers = [
    "client" => "client",
    "commande" => "commande",
    "produit" => "produit",
    "dashboard" => "dashboard",
    "auth" => "auth",
    "profil" => "profil"
];

$controller = $_REQUEST["controller"] ?? "auth";

if(array_key_exists($controller, $controllers)){
    $path = ROOT."/controller/".$controllers[$controller]."Controller.php";
} else {
    echo "Controller introuvable";
    exit();
}

require_once($path);