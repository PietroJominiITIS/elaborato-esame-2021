-- Per ogni tribunale il numero di scatole presenti, quelle trasferite e quelle distrutte l'anno precedente l'attuale.

SELECT
    a.Location,
    BoxesIn,
    BoxesMoved,
    BoxesDeletedLastYear

FROM (
    SELECT Location, COUNT(*) AS BoxesIn FROM Box
    GROUP BY Location
) a 

LEFT JOIN (
    -- Solo in uscita 
    -- Se una scatola rientra e riesce, conta due volte
    SELECT FromL, COUNT(*) AS BoxesMoved FROM Transition
    JOIN Box ON Box.BoxId = Transition.Box
    GROUP BY FromL
) b ON a.Location = b.FromL

LEFT JOIN(
    SELECT Location, COUNT(*) AS BoxesDeletedLastYear
    FROM Box
    WHERE DeletionDate IS NOT NULL AND YEAR(DeletionDate) = YEAR(CURDATE()) - 1
    GROUP BY Location
) c ON a.Location = c.Location
