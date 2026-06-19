<?php

function isEmpty(string $key, $value, array &$errors, string $msg = "Ce champ est obligatoire"): void {
    if(empty(trim($value))){
        $errors[$key] = $msg;
    }
}

function isNumeric($value): bool {
    return is_numeric($value);
}

function isString($value): bool {
    return is_string($value);
}

function isMail($value): bool {
    return (bool) filter_var($value, FILTER_VALIDATE_EMAIL);
}

function validate(array $errors): bool {
    return count($errors) === 0;
}

// ---- Validation produit ----
function validDataProduit(array $data): array {
    $errors = [];
    if(empty(trim($data["reference"] ?? ''))) $errors["referenceVide"]   = "La reference est obligatoire";
    if(empty(trim($data["libelle"]    ?? ''))) $errors["libelleVide"]     = "Le libelle est obligatoire";
    if(empty(trim($data["description"]?? ''))) $errors["descriptionVide"] = "La description est obligatoire";
    if(!isset($data["prix"])  || !is_numeric($data["prix"])  || $data["prix"]  < 0) $errors["prixVide"]  = "Le prix doit etre un nombre positif";
    if(!isset($data["stock"]) || !is_numeric($data["stock"]) || $data["stock"] < 0) $errors["stockVide"] = "Le stock doit etre un nombre positif";
    return $errors;
}

// ---- Validation client ----
function emailExiste(string $email, int $excludeId = 0): bool {
    $sql  = "SELECT COUNT(*) as total FROM client WHERE email = :email AND id_client != :id";
    $row  = executeSelect($sql, ['email' => $email, 'id' => $excludeId], true);
    return (int)$row['total'] > 0;
}

function telephoneExiste(string $telephone, int $excludeId = 0): bool {
    $sql = "SELECT COUNT(*) as total FROM client WHERE telephone = :telephone AND id_client != :id";
    $row = executeSelect($sql, ['telephone' => $telephone, 'id' => $excludeId], true);
    return (int)$row['total'] > 0;
}

function validDataClient(array $data, int $excludeId = 0): array {
    $errors = [];
    if(empty(trim($data["nom"]    ?? ''))) $errors["nomVide"]    = "Le nom est obligatoire";
    if(empty(trim($data["prenom"] ?? ''))) $errors["prenomVide"] = "Le prenom est obligatoire";

    if(empty(trim($data["telephone"] ?? ''))){
        $errors["telephoneVide"] = "Le telephone est obligatoire";
    } elseif(telephoneExiste($data["telephone"], $excludeId)){
        $errors["telephoneDuplique"] = "Ce numero de telephone est deja utilise";
    }

    if(empty(trim($data["email"] ?? ''))){
        $errors["emailVide"] = "L'email est obligatoire";
    } elseif(!isMail($data["email"])){
        $errors["emailInvalide"] = "L'adresse email n'est pas valide";
    } elseif(emailExiste($data["email"], $excludeId)){
        $errors["emailDuplique"] = "Cet email est deja utilise";
    }

    if(empty(trim($data["adresse"] ?? ''))) $errors["adresseVide"] = "L'adresse est obligatoire";
    return $errors;
}

// ---- Validation image ----
function validDataImage(array $file): array {
    $errors = [];
    if($file['error'] === UPLOAD_ERR_NO_FILE) return $errors;
    if($file['error'] !== UPLOAD_ERR_OK){
        $errors['photo'] = "Erreur lors du telechargement (code " . $file['error'] . ")";
        return $errors;
    }
    if($file['size'] > 2 * 1024 * 1024){
        $errors['photo'] = "L'image ne doit pas depasser 2 Mo";
        return $errors;
    }
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if(!in_array($mimeType, $allowed)){
        $errors['photo'] = "Format non supporte. Utilisez JPG, PNG, GIF ou WEBP";
    }
    return $errors;
}

// ---- Upload image ----
function uploadPhoto(array $file): ?string {
    if($file['error'] === UPLOAD_ERR_NO_FILE) return null;
    $uploadDir = ROOT . "/public/uploads/clients/";
    if(!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $filename = uniqid('client_', true) . '.' . $ext;
    if(move_uploaded_file($file['tmp_name'], $uploadDir . $filename)){
        return $filename;
    }
    return null;
}
