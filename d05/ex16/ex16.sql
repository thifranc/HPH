SELECT COUNT(date) AS 'films'
FROM historique_membre
WHERE DATE(date) >= 2006-10-30 AND DATE(date) <= 2007-07-27
OR MONTH(date) = 12 AND DAY(date) = 24;
