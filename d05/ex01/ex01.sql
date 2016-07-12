CREATE TABLE ft_table (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
login VARCHAR(8) DEFAULT 'toto' NOT NULL,
groupe ENUM('staff', 'student', 'other') NOT NULL,
date_de_creation DATE NOT NULL
);
