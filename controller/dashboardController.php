<?php
require_once ROOT."/model/dashboardModel.php";
auth();

$index = function(){
    $total_clients   = countTable("client");
    $total_commandes = countTable("commande");
    $total_produits  = countTable("produit");
    $last3Commandes  = get3LastCommandes();

    loadView("dashboard/dashboard", [
        "total_clients"  => $total_clients,
        "total_commandes" => $total_commandes,
        "total_produits" => $total_produits,
        "last3Commandes" => $last3Commandes
    ]);
};

$actions = [
    "index" => $index,
    "dashboard" => $index,
];

$action = $_REQUEST["action"] ?? "index";

if(array_key_exists($action, $actions)){
    $actions[$action]();
} else {
    echo "Page introuvable dashboard";
    exit();
}
