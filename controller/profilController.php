<?php
require_once ROOT."/model/clientModel.php";
auth();

$index = function(){
    $idClient = $_SESSION["user"]["id_client"] ?? null;
    $client   = $idClient ? getClientById($idClient) : null;
    loadView("profil/index", ["client" => $client]);
};

$modifier = function(){
    $idClient = $_SESSION["user"]["id_client"] ?? null;
    if(!$idClient){ redirectTo("profil","index"); return; }

    $client = getClientById($idClient);
    if(!$client){ redirectTo("profil","index"); return; }

    $errors = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-profil'])){
        $errors = validDataClient($_POST, $idClient);

        if(!empty($_FILES['photo']['name'])){
            $errors = array_merge($errors, validDataImage($_FILES['photo']));
        }

        if(validate($errors)){
            $photo = uploadPhoto($_FILES['photo'] ?? ['error' => UPLOAD_ERR_NO_FILE]);
            updateClient(
                $idClient,
                $_POST['nom'], $_POST['prenom'],
                $_POST['telephone'], $_POST['email'],
                $_POST['adresse'], $photo
            );
            redirectTo("profil", "index");
        }
        $client = array_merge($client, $_POST);
    }

    loadView("profil/modifier", ["errors" => $errors, "client" => $client]);
};

$actions = [
    "index"    => $index,
    "modifier" => $modifier,
];

$action = $_REQUEST["action"] ?? "index";
array_key_exists($action, $actions) ? $actions[$action]() : (print("Page introuvable") ?: exit());
