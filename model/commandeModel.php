<?php
require_once(ROOT."/config/config.php");

function getAllCommandes(){
    $sql = "SELECT c.*, cl.nom, cl.prenom 
            FROM commande c
            JOIN client cl ON c.id_client = cl.id_client
            ORDER BY c.date_commande DESC";
    return executeSelect($sql);
}

function getCommandeById($id){
    $sql = "SELECT c.*, cl.nom, cl.prenom, cl.telephone, cl.email, cl.adresse
            FROM commande c
            JOIN client cl ON c.id_client = cl.id_client
            WHERE c.id_commande = :id";
    return executeSelect($sql, ["id"=>$id], true);
}

function getLignesCommande($id_commande){
    $sql = "SELECT pc.*, p.reference, p.libelle
            FROM produit_commande pc
            JOIN produit p ON pc.id_produit = p.id_produit
            WHERE pc.id_commande = :id_commande";
    return executeSelect($sql, ["id_commande" => $id_commande]);
}

function getClientByTelephone($telephone){
    $sql = "SELECT * FROM client WHERE telephone = :telephone";
    return executeSelect($sql, ["telephone"=>$telephone], true);
}

function getProduitByReference($reference){
    $sql = "SELECT * FROM produit WHERE reference = :reference";
    return executeSelect($sql, ["reference"=>$reference], true);
}

//function getProduitByReference($reference){
//    $sql = "SELECT * FROM produit WHERE reference = :reference";
//    return executeSelect($sql, ["reference" => $reference], true);
//}

function addCommande($id_client, $montant_total, $description, array $panier){

    // 1. Ajouter la commande
    $sqlCommande = "INSERT INTO commande
                    (id_client, date_commande, montant_total, statut, description)
                    VALUES
                    (:id_client, CURRENT_DATE, :montant_total, 'NON SOLDEE', :description)";

    $id_commande = executeInsert($sqlCommande, [
        "id_client"     => $id_client,
        "montant_total" => $montant_total,
        "description"   => $description
    ]);

    // 3. Ajouter les produits de la commande
    foreach($panier as $item){

        $sqlLigne = "INSERT INTO produit_commande 
                    (id_commande, id_produit, quantite, prix_vente) 
                    VALUES 
                    (:id_commande, :id_produit, :quantite, :prix_vente)";

        executeUpdate($sqlLigne, [
            "id_commande" => $id_commande,
            "id_produit"  => $item["id_produit"],
            "quantite"    => $item["quantite"],
            "prix_vente"  => $item["prix"]
        ]);

        // 4. Mettre à jour le stock
        $sqlStock = "UPDATE produit 
                    SET stock = stock - :quantite 
                    WHERE id_produit = :id_produit";

        executeUpdate($sqlStock, [
            "quantite"   => $item["quantite"],
            "id_produit" => $item["id_produit"]
        ]);
    }
}