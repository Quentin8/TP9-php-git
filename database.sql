CREATE TABLE notes(
	id int PRIMARY KEY, 
	semestre text, 
	etudiant text, 
	note int
);

INSERT INTO notes (id, semestre, etudiant, note) VALUES
(1, 'S1', 'E1', 18),
(2, 'S1', 'E2', 7),
(3, 'S2', 'E1', 17),
(4, 'S2', 'E2', 8),
(5, 'S3', 'E1', 16),
(6, 'S3', 'E2', 9),
(7, 'S4', 'E1', 13),
(8, 'S4', 'E2', 4),
(9, 'S5', 'E1', 12),
(10, 'S5', 'E2', 5),
(11, 'S6', 'E1', 14),
(12, 'S6', 'E2', 6),
(13, 'S7', 'E1', 12),
(14, 'S7', 'E2', 5),
(15, 'S8', 'E1', 10),
(16, 'S8', 'E2', 4),
(17, 'S9', 'E1', 13),
(18, 'S9', 'E2', 7),
(19, 'S10', 'E1', 15),
(20, 'S10', 'E2', 3);