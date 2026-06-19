<?php

function login(string $email){
    $sql = "SELECT * FROM utilisateur WHERE email = :email";
    return executeSelect($sql, ["email" => $email], true);
}
