<?php
require_once ROOT."/model/clientModel.php";
require_once ROOT."/config/validator.php";
auth();

$liste = function(){
    $clients = listerClient();
    $total_clients = countClients();
    loadView("client/liste", [
        "clients" => $clients,
        "total_clients" => $total_clients
    ]);
};

$ajout = function(){
    $errors = [];
    $old    = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-client'])){
        $errors = validDataClient($_POST);

        // Validation photo (facultative)
        if(!empty($_FILES['photo']['name'])){
            $errors = array_merge($errors, validDataImage($_FILES['photo']));
        }

        if(validate($errors)){
            $photo = uploadPhoto($_FILES['photo'] ?? ['error' => UPLOAD_ERR_NO_FILE]);
            ajoutClient(
                $_POST['nom'], $_POST['prenom'],
                $_POST['telephone'], $_POST['email'],
                $_POST['adresse'], $photo
            );
            redirectTo("client", "liste");
        }
        $old = $_POST;
    }

    loadView("client/ajout", ["errors" => $errors, "client" => null, "old" => $old]);
};

$modifier = function(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $errors = [];
    
    if($id <= 0){
        redirectTo("client", "liste");
        return;
    }
    
    $client = getClientById($id);
    if(!$client){
        redirectTo("client", "liste");
        return;
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-client'])){
        $errors = validDataClient($_POST, $id);

        if(!empty($_FILES['photo']['name'])){
            $errors = array_merge($errors, validDataImage($_FILES['photo']));
        }

        if(validate($errors)){
            $photo = uploadPhoto($_FILES['photo'] ?? ['error' => UPLOAD_ERR_NO_FILE]);
            updateClient(
                $id,
                $_POST['nom'], $_POST['prenom'],
                $_POST['telephone'], $_POST['email'],
                $_POST['adresse'], $photo
            );
            redirectTo("client", "liste");
        }

        $client = array_merge($client, $_POST);
    }
    
    loadView("client/ajout", [
        "errors" => $errors,
        "client" => $client
    ]);
};

$supprimer = function(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if($id > 0){
        if(clientHasCommandes($id)){
            // Stocker l'erreur dans une variable flash simple
            $_SESSION["error_message"] = "Impossible de supprimer ce client car il a des commandes associées.";
        } else {
            deleteClient($id);
        }
    }
    redirectTo("client", "liste");
};

$detail = function(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if($id > 0){
        $client = getClientById($id);
        if($client){
            loadView("client/detail", ["client" => $client]);
            return;
        }
    }
    redirectTo("client", "liste");
};

$actions = [
    "liste"     => $liste,
    "ajout"     => $ajout,
    "modifier"  => $modifier,
    "supprimer" => $supprimer,
    "detail"    => $detail
];

$action = $_REQUEST["action"] ?? "liste";

if(array_key_exists($action, $actions)){
    $actions[$action]();
} else {
    echo "Page introuvable client";
    exit();
}
?>