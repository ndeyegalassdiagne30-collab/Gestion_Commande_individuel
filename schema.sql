CREATE TABLE utilisateur (
    id_utilisateur SERIAL PRIMARY KEY,
    email          VARCHAR(255) NOT NULL UNIQUE,
    mdp            VARCHAR(255) NOT NULL,
    role           VARCHAR(20)  NOT NULL CHECK (role IN ('ADMIN', 'CLIENT'))
);

CREATE TABLE client (
    id_client  SERIAL       PRIMARY KEY,
    nom        VARCHAR(100) NOT NULL,
    prenom     VARCHAR(100) NOT NULL,
    telephone  VARCHAR(20)  NOT NULL,
    email      VARCHAR(255) NOT NULL UNIQUE,
    adresse    TEXT,
    photo      VARCHAR(255)
);

CREATE TABLE produit (
    id_produit  SERIAL         PRIMARY KEY,
    reference   VARCHAR(100)   NOT NULL UNIQUE,
    libelle     VARCHAR(255)   NOT NULL,
    description TEXT,
    prix        NUMERIC(10, 2) NOT NULL CHECK (prix >= 0),
    stock       INTEGER        NOT NULL DEFAULT 0 CHECK (stock >= 0)
);

CREATE TABLE commande (
    id_commande    SERIAL         PRIMARY KEY,
    id_client      INTEGER        NOT NULL REFERENCES client(id_client) ON DELETE CASCADE,
    date_commande  DATE           NOT NULL DEFAULT CURRENT_DATE,
    montant_total  NUMERIC(10, 2) NOT NULL CHECK (montant_total >= 0),
    statut         VARCHAR(50)    NOT NULL DEFAULT 'NON SOLDEE',
    description    TEXT
);

CREATE TABLE produit_commande (
    id_commande INTEGER        NOT NULL REFERENCES commande(id_commande)  ON DELETE CASCADE,
    id_produit  INTEGER        NOT NULL REFERENCES produit(id_produit)    ON DELETE RESTRICT,
    quantite    INTEGER        NOT NULL CHECK (quantite > 0),
    prix_vente  NUMERIC(10, 2) NOT NULL CHECK (prix_vente >= 0),
    PRIMARY KEY (id_commande, id_produit)
);

INSERT INTO utilisateur (email, mdp, role)
VALUES ('admin@gestion.com', 'admin123', 'ADMIN');

INSERT INTO produit (reference, libelle, description, prix, stock) VALUES
    ('REF-001', 'Produit A', 'Description du produit A', 15000.00, 50),
    ('REF-002', 'Produit B', 'Description du produit B', 25000.00, 30),
    ('REF-003', 'Produit C', 'Description du produit C',  8500.00, 100);
