DROP DATABASE if exists TPSQL;
CREATE DATABASE TPSQL;
USE TPSQL;

CREATE TABLE ADHERENT
(
	idAdherent INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nomAdherent VARCHAR(20),
  adresseAdherent VARCHAR(50),
  datePaiementAdherent DATE
)engine=innoDB default CHARSET=UTF8;

CREATE TABLE AUTEUR
(
  idAuteur INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nomAuteur VARCHAR(20),
  prenomAuteur VARCHAR(20)
)engine=innoDB default CHARSET=UTF8;

CREATE TABLE OEUVRE
(
  idOeuvre INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  titreOeuvre VARCHAR(50),
  dateParutionOeuvre DATE,
  idAuteur INT,
  CONSTRAINT fk_oeuvre_auteur FOREIGN KEY (idAuteur) REFERENCES AUTEUR(idAuteur)
)engine=innoDB default CHARSET=UTF8;


CREATE TABLE EXEMPLAIRE
(
  idExemplaire INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  etatExemplaire VARCHAR(20),
  dateAchatExemplaire DATE,
  prixExemplaire FLOAT(6,2),
  idOeuvre INT,
  CONSTRAINT fk_exemplaire_adherent FOREIGN KEY (idOeuvre) REFERENCES OEUVRE(idOeuvre)
)engine=innoDB default CHARSET=UTF8;

CREATE TABLE EMPRUNT
(
  idAdherent INT,
  idExemplaire INT,
  dateEmprunt DATE,
  PRIMARY KEY (idAdherent, idExemplaire, dateEmprunt),
  dateRendu DATE,
  CONSTRAINT fk_emprunt_adherent FOREIGN KEY (idAdherent) REFERENCES ADHERENT(idAdherent),
  CONSTRAINT fk_emprunt_exemplaire FOREIGN KEY (idExemplaire) REFERENCES EXEMPLAIRE(idExemplaire)
)engine=innoDB default CHARSET=UTF8;