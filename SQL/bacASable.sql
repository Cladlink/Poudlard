INSERT INTO EXEMPLAIRE VALUES (NULL, "NEUF", "2001-12-12", "15.0", "1");

UPDATE EXEMPLAIRE SET etatExemplaire = "BON", dateAchatExemplaire = "2015-02-23", prixExemplaire = "13.00" WHERE idExemplaire = "28";

SELECT OEUVRE.idOeuvre,OEUVRE.titreOeuvre,AUTEUR.nomAuteur,OEUVRE.dateParutionOeuvre
FROM OEUVRE JOIN AUTEUR ON OEUVRE.idAuteur = AUTEUR.idAuteur;

SELECT ADHERENT.nomAdherent, OEUVRE.titreOeuvre, EMPRUNT.dateEmprunt FROM EMPRUNT
JOIN ADHERENT ON EMPRUNT.idAdherent = ADHERENT.idAdherent
JOIN EXEMPLAIRE ON EMPRUNT.idExemplaire = EXEMPLAIRE.idExemplaire
JOIN OEUVRE ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
WHERE EMPRUNT.dateRendu IS NULL
AND adherent.idAdherent = 1
ORDER BY ADHERENT.nomAdherent;


INSERT INTO EMPRUNT VALUES (45, 60, '2015-05-05', null);