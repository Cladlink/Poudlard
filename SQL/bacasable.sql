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