/*OK*/
SELECT AUTEUR.nomAuteur
FROM AUTEUR
WHERE AUTEUR.nomAuteur LIKE "p%";

/*OK*/
SELECT count(*) as nbrLocation
FROM EMPRUNT
WHERE EMPRUNT.dateRendu IS NULL;

/*Pas nécessaire je pense*/
SELECT EXEMPLAIRE.idExemplaire, OEUVRE.titreOeuvre
FROM EXEMPLAIRE
JOIN OEUVRE
ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
WHERE OEUVRE.titreOeuvre like "%la%"
ORDER BY OEUVRE.titreOeuvre DESC;

/*OK*/
SELECT OEUVRE.titreOeuvre, EXEMPLAIRE.idExemplaire, AUTEUR.nomAuteur
FROM EXEMPLAIRE
JOIN OEUVRE
ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
JOIN AUTEUR
ON AUTEUR.idAuteur = OEUVRE.idAuteur
WHERE EXEMPLAIRE.etatExemplaire like "mauvais"
ORDER BY OEUVRE.titreOeuvre;

/*OK*/
SELECT OEUVRE.titreOeuvre, count(EXEMPLAIRE.idOeuvre)
FROM EXEMPLAIRE
JOIN OEUVRE
ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
JOIN AUTEUR
ON AUTEUR.idAuteur = OEUVRE.idAuteur
WHERE AUTEUR.nomAuteur like "christie"
GROUP BY OEUVRE.titreOeuvre
ORDER BY OEUVRE.titreOeuvre;

/*OK*/
SELECT count(*) as nbreExemplaire, AUTEUR.nomAuteur
FROM OEUVRE
JOIN AUTEUR
ON AUTEUR.idAuteur = OEUVRE.idAuteur
GROUP BY OEUVRE.idAuteur
ORDER BY AUTEUR.nomAuteur;

/*OK*/
SELECT ADHERENT.nomAdherent, EMPRUNT.dateEmprunt, ADDDATE(EMPRUNT.dateEmprunt, INTERVAL 45 DAY) as dateRenduMax
FROM EMPRUNT
JOIN ADHERENT
ON EMPRUNT.idAdherent = ADHERENT.idAdherent
WHERE EMPRUNT.dateRendu IS NULL
ORDER BY ADHERENT.nomAdherent;

/*OK (dans la recherche, les dates ne sont comparées qu'avec l'année*/
SELECT OEUVRE.titreOeuvre
FROM OEUVRE
WHERE YEAR(OEUVRE.dateParutionOeuvre) IN
(
  SELECT YEAR(OEUVRE.dateParutionOeuvre)
  FROM OEUVRE
  WHERE OEUVRE.titreOeuvre like "le retour de poirot"
)
AND OEUVRE.titreOeuvre NOT like "le retour de poirot";

/*OK mais ca me parait bizarre les 2.5*/
SELECT ADHERENT.nomAdherent,
EMPRUNT.dateEmprunt,
DATEDIFF(CURRENT_DATE, EMPRUNT.dateEmprunt) as DATEDIFF_curdate,
DATEDIFF(CURRENT_DATE, EMPRUNT.dateEmprunt) * 0.5 as dette_max,
IF( ((DATEDIFF(curdate(), dateEmprunt) *0.5)<90), DATEDIFF(curdate(), dateEmprunt)* 0.5, 90) as dette
FROM ADHERENT
JOIN EMPRUNT
ON ADHERENT.idAdherent = EMPRUNT.idAdherent
WHERE EMPRUNT.dateRendu IS NULL;