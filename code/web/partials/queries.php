<link rel="stylesheet" href="../css/queries.css">

<div class="queries">
    <div class="query">
        <div class="title">Per ogni tribunale il numero di scatole presenti, quelle trasferite e quelle distrutte l'anno precedente l'attuale.</div>
        <pre>
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
) c ON a.Location = c.Location</pre>
        <table>
            <tr>
                <th>Location</th>
                <th>BoxesIn</th>
                <th>BoxesMoved</th>
                <th>BoxesDeletedLastYear</th>
            </tr>
            <tr>
                <td>AL</td>
                <td>9</td>
                <td>4</td>
                <td>2</td>
            </tr>
            <tr>
                <td>CN</td>
                <td>3</td>
                <td>3</td>
                <td>2</td>
            </tr>
        </table>
    </div>
    <div class="query">
        <div class="title">Il caso/casi che hanno il maggior numero di materiali in assoluto.</div>
<pre>
SELECT * FROM
(
    SELECT
        CaseT.CaseId,
        COALESCE(Documents, 0) + COALESCE(Evidences, 0) + COALESCE(Papers, 0) + COALESCE(Reports, 0) AS ItemsCount
    FROM CaseT

    LEFT JOIN (
        SELECT CaseT, COUNT(*) AS Documents FROM Document
        JOIN Box ON Document.Box = Box.BoxId
        GROUP BY CaseT
    ) Documents ON CaseT.CaseId = Documents.CaseT

    LEFT JOIN (
        SELECT CaseT, COUNT(*) AS Evidences FROM Evidence
        JOIN Box ON Evidence.Box = Box.BoxId
        GROUP BY CaseT
    ) Evidences ON CaseT.CaseId = Evidences.CaseT

    LEFT JOIN (
        SELECT CaseT, COUNT(*) AS Papers FROM Paper
        JOIN Box ON Paper.Box = Box.BoxId
        GROUP BY CaseT
    ) Papers ON CaseT.CaseId = Papers.CaseT

    LEFT JOIN (
        SELECT CaseT, COUNT(*) AS Reports FROM Report
        JOIN Box ON Report.Box = Box.BoxId
        GROUP BY CaseT
    ) Reports ON CaseT.CaseId = Reports.CaseT
) A

WHERE ItemsCount = (
    SELECT MAX(ItemsCount) FROM (
        SELECT
            CaseT.CaseId,
            COALESCE(Documents, 0) + COALESCE(Evidences, 0) + COALESCE(Papers, 0) + COALESCE(Reports, 0) AS ItemsCount
        FROM CaseT

        LEFT JOIN (
            SELECT CaseT, COUNT(*) AS Documents FROM Document
            JOIN Box ON Document.Box = Box.BoxId
            GROUP BY CaseT
        ) Documents ON CaseT.CaseId = Documents.CaseT

        LEFT JOIN (
            SELECT CaseT, COUNT(*) AS Evidences FROM Evidence
            JOIN Box ON Evidence.Box = Box.BoxId
            GROUP BY CaseT
        ) Evidences ON CaseT.CaseId = Evidences.CaseT

        LEFT JOIN (
            SELECT CaseT, COUNT(*) AS Papers FROM Paper
            JOIN Box ON Paper.Box = Box.BoxId
            GROUP BY CaseT
        ) Papers ON CaseT.CaseId = Papers.CaseT

        LEFT JOIN (
            SELECT CaseT, COUNT(*) AS Reports FROM Report
            JOIN Box ON Report.Box = Box.BoxId
            GROUP BY CaseT
        ) Reports ON CaseT.CaseId = Reports.CaseT
    ) A
)</pre>
        <table>
            <tr>
                <th>CaseId</th>
                <th>ItemsCount</th>
            </tr>
            <tr>
                <td>9</td>
                <td>13</td>
            </tr>
            <tr>
                <td>13</td>
                <td>13</td>
            </tr>
        </table>
    </div>
</div>