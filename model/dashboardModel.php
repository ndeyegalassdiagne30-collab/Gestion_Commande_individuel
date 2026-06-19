<?php

function get3LastCommandes(){
    $sql = "SELECT c.*, cl.prenom || ' ' || cl.nom as nom_complet
            FROM commande c
            JOIN client cl ON c.id_client = cl.id_client
            ORDER BY c.date_commande DESC
            LIMIT 3";
    return executeSelect($sql);
}
