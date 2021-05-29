-- Il caso/casi che hanno il maggior numero di materiali in assoluto.

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
)
