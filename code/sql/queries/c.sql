-- Elenco dei materiali che non hanno mai lasciato il tribunale X.

-- Questa query è impossibile da fare su tutti i tipo di materiale contemporaneamente, ma può essere fatta con
-- 4 interrogazioni diverse. Ad esempio, la seguente è quella necessaria per ottenere l'elenco dei documenti
-- che non hanno mai lasciato il tribunale X
SELECT DocumentId, Document.Box, Type, Description, AcquisitionDate FROM Document
JOIN Box ON Box.BoxId = Document.Box
LEFT JOIN Transition ON Box.BoxId = Transition.Box
WHERE Transition.FromL IS NULL AND Box.Location = 'X'