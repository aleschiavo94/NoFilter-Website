SET FOREIGN_KEY_CHECKS = 0;
SET SQL_SAFE_UPDATES = 0;

BEGIN;
CREATE SCHEMA IF NOT EXISTS nofilterDB;
COMMIT;

USE nofilterDB;

DROP TABLE IF EXISTS utenti;
CREATE TABLE utenti (
	email varchar(100) NOT NULL,
    nome varchar(100) NOT NULL,
    cognome varchar(100) NOT NULL,
    password varchar(100) NOT NULL,
    PRIMARY KEY(email)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;