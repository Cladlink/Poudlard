SELECT ADHERENT.nomAdherent, OEUVRE.titreOeuvre, EMPRUNT.dateEmprunt, ADDDATE(EMPRUNT.dateEmprunt, INTERVAL 45 DAY) as dateRenduMax
FROM EMPRUNT
  JOIN ADHERENT
    ON EMPRUNT.idAdherent = ADHERENT.idAdherent
  JOIN EXEMPLAIRE
    ON EXEMPLAIRE.idExemplaire = emprunt.idExemplaire
  JOIN OEUVRE
    ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
WHERE EMPRUNT.dateRendu IS NULL
ORDER BY ADHERENT.nomAdherent;

UPDATE EMPRUNT
SET EMPRUNT.dateRendu = now()
WHERE EMPRUNT.idExemplaire = 2
AND EMPRUNT.idAdherent = 6
AND EMPRUNT.dateRendu like '2015-09-28';

Select * FROM emprunt;

SELECT nomAdherent, count(*) as compte
FROM emprunt
  JOIN adherent
  ON adherent.idAdherent = emprunt.idAdherent
WHERE emprunt.idAdherent = 14
  AND emprunt.dateRendu IS NULL
GROUP BY emprunt.idAdherent
HAVING compte > 1;

SELECT ADHERENT.nomAdherent, EMPRUNT.dateEmprunt, ADDDATE(EMPRUNT.dateEmprunt, INTERVAL 45 DAY) as dateRenduMax
FROM EMPRUNT
  JOIN ADHERENT
    ON EMPRUNT.idAdherent = ADHERENT.idAdherent
WHERE EMPRUNT.dateRendu IS NULL
  AND adherent.idAdherent = 1
HAVING dateRenduMax > dateEmprunt + 45
ORDER BY ADHERENT.nomAdherent;

SELECT OEUVRE.titreOEUVRE
FROM oeuvre
JOIN exemplaire
ON oeuvre.idOeuvre = exemplaire.idOeuvre
WHERE idExemplaire;

  SELECT OEUVRE.titreOeuvre,
    COUNT(exemplaire.idExemplaire) as exemplaire_Restant
  FROM EXEMPLAIRE
    JOIN OEUVRE ON exemplaire.idOeuvre = oeuvre.idOeuvre
  WHERE exemplaire.idExemplaire NOT IN
        (
          SELECT exemplaire.idExemplaire
          FROM emprunt
            JOIN exemplaire ON emprunt.idExemplaire = exemplaire.idExemplaire
          WHERE dateRendu IS NULL
        )
  GROUP BY Oeuvre.titreOeuvre;

SELECT * FROM adherent;
SELECT nomAdherent, count(*) as compte
FROM emprunt
  JOIN adherent
    ON adherent.idAdherent = emprunt.idAdherent
WHERE emprunt.idAdherent = 38
      AND emprunt.dateRendu IS NULL
GROUP BY emprunt.idAdherent
HAVING compte > 2;

SELECT  AUTEUR.idAdherent,
  AUTEUR.nomAdherent,
  AUTEUR.adresseAdherent
FROM    AUTEUR;

SELECT titreOeuvre
FROM oeuvre
WHERE idAuteur = 1;