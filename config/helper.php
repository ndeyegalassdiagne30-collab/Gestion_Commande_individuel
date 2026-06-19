<?php

function dd($test){
    echo "<pre>";
    var_dump($test);
    echo "</pre>";
    die("E221 bakane lay lathie");
}

function loadView(string $view, array $datas = [], string $layout = "base"){
    ob_start();
    extract($datas);
    require_once ROOT."/views/".$view.".php";
    $content = ob_get_clean();
    require_once ROOT."/views/layout/".$layout.".layout.php";
}

// function path(string $controller, string $action): string{
//     return WEBROOT."?controller=$controller&action=$action";
// }  


function path(string $controller, string $action): string{
    return WEBROOT . $controller . "/" . $action;
}

function redirectTo(string $controller, string $action): void{
    header("Location:".WEBROOT.$controller."/".$action);
    exit();
}

function countTable(string $table): int{
    $sql = "SELECT COUNT(*) as total FROM $table";
    return (int) executeSelect($sql, [], true)["total"];
}

function isConnected(): bool{
    return isset($_SESSION["user"]);
}

function auth(): void{
    if(!isConnected()){
        redirectTo("auth", "login");
    }
}

function hasRole(string $role): bool{
    return isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] === $role;
}
