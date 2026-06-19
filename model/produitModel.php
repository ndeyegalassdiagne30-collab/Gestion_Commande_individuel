<?php
require_once ROOT."/config/config.php";

function listerProduit(){
    $sql = "SELECT * FROM produit ORDER BY id_produit DESC";
    return executeSelect($sql);
}

function ajoutProduit($reference, $libelle, $description, $prix, $stock){
    $sql = "INSERT INTO produit(reference, libelle, description, prix, stock)
            VALUES (:reference, :libelle, :description, :prix, :stock)";
    $data = [
        'reference' => $reference,
        'libelle' => $libelle,
        'description' => $description,
        'prix' => $prix,
        'stock' => $stock,
    ];
    return executeUpdate($sql, $data);
}

function deleteProduit($id){
    $sql = "DELETE FROM produit WHERE id_produit = :id";
    $data = ['id' => $id];
    return executeUpdate($sql, $data);
}

function updateProduit($id, $reference, $libelle, $description, $prix, $stock){
    $sql = "UPDATE produit 
            SET reference = :reference, 
                libelle = :libelle,
                description = :description,
                prix = :prix,
                stock = :stock
            WHERE id_produit = :id";
    $data = [
        'id' => $id,
        'reference' => $reference,
        'libelle' => $libelle,
        'description' => $description,
        'prix' => $prix,
        'stock' => $stock,
    ];
    return executeUpdate($sql, $data);
}

function getProduitById($id){
    $sql = "SELECT * FROM produit WHERE id_produit = :id";
    $data = ['id' => $id];
    return executeSelect($sql, $data, true);
}
?>