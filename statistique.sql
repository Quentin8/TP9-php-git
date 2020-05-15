CREATE TABLE statistique (
  id int PRIMARY KEY,
  mois varchar(50),
  action varchar(50),
  valeur int
);

INSERT INTO statistique (id, mois, action, valeur) VALUES
(1, 'Jan', 'Als', 24),
(2, 'Jan', 'For', 36),
(3, 'Fev', 'Als', 27),
(4, 'Fev', 'For', 56),
(5, 'Mar', 'Als', 32),
(6, 'Mar', 'For', 40),
(7, 'Avr', 'Als', 28),
(8, 'Avr', 'For', 42),
(9, 'Mai', 'Als', 24),
(10, 'Mai', 'For', 44),
(11, 'Jun', 'Als', 35),
(12, 'Jun', 'For', 63),
(13, 'Jui', 'Als', 39),
(14, 'Jui', 'For', 55),
(15, 'Aou', 'Als', 46),
(16, 'Aou', 'For', 58),
(17, 'Sep', 'Als', 50),
(18, 'Sep', 'For', 63),
(19, 'Oct', 'Als', 52),
(20, 'Oct', 'For', 66),
(21, 'Nov', 'Als', 60),
(22, 'Nov', 'For', 69),
(23, 'Dec', 'Als', 59),
(24, 'Dec', 'For', 80);
