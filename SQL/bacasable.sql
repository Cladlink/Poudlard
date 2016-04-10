SELECT ADHERENT.nomAdherent
FROM EMPRUNT
JOIN ADHERENT
ON EMPRUNT.idAdherent = ADHERENT.idAdherent
WHERE EMPRUNT.dateRendu IS NULL
  AND adherent.nomAdherent like "millet"
ORDER BY ADHERENT.nomAdherent;
