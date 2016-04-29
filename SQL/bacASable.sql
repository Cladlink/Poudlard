INSERT INTO EXEMPLAIRE VALUES (NULL, "NEUF", "2001-12-12", "15.0", "1");

UPDATE EXEMPLAIRE SET etatExemplaire = "BON", dateAchatExemplaire = "2015-02-23", prixExemplaire = "13.00" WHERE idExemplaire = "28";

SELECT OEUVRE.idOeuvre,OEUVRE.titreOeuvre,AUTEUR.nomAuteur,OEUVRE.dateParutionOeuvre
FROM OEUVRE JOIN AUTEUR ON OEUVRE.idAuteur = AUTEUR.idAuteur;