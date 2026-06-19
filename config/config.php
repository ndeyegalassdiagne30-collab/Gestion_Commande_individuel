<?php

function getPDO(){
    try{
        return new PDO(
            "pgsql:host=".DB_HOST.";port=".PORT.";dbname=".DB_NAME."",
            UTILISATEUR,
            MOT_DE_PASSE,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }catch(PDOException $e){
        die("Erreur de connexion PostgreSQL : " . $e->getMessage());
    }
}

function executeSelect(string $sql, array $data = [], $one = false){
    $conn = getPDO();
    $statement = $conn->prepare($sql);
    count($data) == 0 ? $statement->execute() : $statement->execute($data);
    return $one ? $statement->fetch() : $statement->fetchAll();
}

function executeUpdate(string $sql, array $data){
    $conn = getPDO();
    $statement = $conn->prepare($sql);
    $statement->execute($data);
}

// Pour les INSERT qui ont besoin de récupérer l'id généré (PostgreSQL = lastval())
function executeInsert(string $sql, array $data): int {
    $conn  = getPDO();
    $statement = $conn->prepare($sql);
    $statement->execute($data);
    return (int) $conn->query("SELECT lastval()")->fetchColumn();
}
