<?php
require_once ROOT."/model/produitModel.php";
require_once ROOT."/config/validator.php";
auth();

$liste = function(){
    $produits = listerProduit();
    $total_produits = countTable("produit");
    loadView("produit/liste", [
        "produits" => $produits,
        "total_produits" => $total_produits
    ]);
};

$new = function(){
    $errors = [];
    $old = [];
    
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-produit'])){
        $errors = validDataProduit($_POST);
        
        if(validate($errors)){
            ajoutProduit(
                trim($_POST['reference']),
                trim($_POST['libelle']),
                trim($_POST['description']),
                (float)$_POST['prix'],
                (int)$_POST['stock']
            );
            redirectTo("produit", "liste");
        }
        $old = $_POST;
    }
    
    loadView("produit/ajout", [
        "errors" => $errors,
        "produit" => null,
        "old" => $old
    ]);
};

$modifier = function(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $errors = [];
    
    if($id <= 0){
        redirectTo("produit", "liste");
        return;
    }
    
    $produit = getProduitById($id);
    if(!$produit){
        redirectTo("produit", "liste");
        return;
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-produit'])){
        $errors = validDataProduit($_POST);
        
        if(validate($errors)){
            updateProduit(
                $id,
                trim($_POST['reference']),
                trim($_POST['libelle']),
                trim($_POST['description']),
                (float)$_POST['prix'],
                (int)$_POST['stock']
            );
            redirectTo("produit", "liste");
        }
        
        // En cas d'erreur, on garde les données POST
        $produit = $_POST;
    }
    
    loadView("produit/ajout", [
        "errors" => $errors,
        "produit" => $produit
    ]);
};

$supprimer = function(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if($id > 0){
        deleteProduit($id);
    }
    redirectTo("produit", "liste");
};

$actions = [
    "liste" => $liste,
    "new" => $new,
    "modifier"  => $modifier,
    "supprimer" => $supprimer
];

$action = $_REQUEST["action"] ?? "liste";

if(array_key_exists($action, $actions)){
    $actions[$action]();
} else {
    echo "Page introuvable produit";
    exit();
}
?>