<?php
require_once ROOT."/model/authModel.php";
require_once ROOT."/model/clientModel.php";

$login = function(){
    if(isConnected()){
        redirectTo("client", "liste");
    }

    $errors = [];

    if(isset($_POST["connect"])){
        isEmpty("email",    $_POST["email"],    $errors, "Veuillez renseigner l'email");
        isEmpty("password", $_POST["password"], $errors, "Veuillez renseigner le mot de passe");

        if(validate($errors)){
            $user = login(trim($_POST["email"]));
            if($user && $_POST["password"] === $user["mdp"]){
                // Si CLIENT, on cherche sa fiche client liée par email
                if($user["role"] === "CLIENT"){
                    $clientRecord = getClientByEmail($user["email"]);
                    if($clientRecord){
                        $user["id_client"] = $clientRecord["id_client"];
                    }
                }
                $_SESSION["user"] = $user;
                // Redirection selon le rôle
                if($user["role"] === "ADMIN"){
                    redirectTo("client", "liste");
                } else {
                    redirectTo("commande", "mes_commandes");
                }
            } else {
                $errors["connect"] = "Email ou mot de passe incorrect";
            }
        }
    }

    loadView("auth/login", ["errors" => $errors], "auth");
};

$logout = function(){
    session_unset();
    session_destroy();
    redirectTo("auth", "login");
};

$actions = [
    "login"  => $login,
    "logout" => $logout,
];

$action = $_REQUEST["action"] ?? "login";

if(array_key_exists($action, $actions)){
    $actions[$action]();
} else {
    echo "Page introuvable";
    exit();
}
