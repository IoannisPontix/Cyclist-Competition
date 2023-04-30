SET storage_engine=InnoDB;
SET FOREIGN_KEY_CHECKS=1;
CREATE DATABASE IF NOT EXISTS exercise2;
USE exercise2;

DROP TABLE IF EXISTS Cyclist;
DROP TABLE IF EXISTS Team;
DROP TABLE IF EXISTS Stage;
DROP TABLE IF EXISTS Individual_classification;

SET AUTOCOMMIT=0;

START TRANSACTION;

CREATE TABLE Cyclist (
	CodC integer PRIMARY KEY,
	Name varchar(30) NOT NULL,
	Surname varchar(30) NOT NULL,
	Nationality varchar(30) NOT NULL,
	CodT integer NOT NULL,
	BirthYear integer NOT NULL
);

CREATE TABLE Team (
	CodT integer PRIMARY KEY,
	NameT varchar(30) NOT NULL,
	FoundationYear integer NOT NULL,
	LegalAddress varchar(40) NOT NULL
);

CREATE TABLE Stage (
	Edition integer PRIMARY KEY,
	CodS integer NOT NULL,
	StartingCity varchar(30) NOT NULL,
	ArrivalCity varchar(30) NOT NULL,
	LengthM integer NOT NULL,
	HeightDifference integer NOT NULL,
	DifficultyLevel integer NOT NULL
);

CREATE TABLE Individual_classification(
	CodC integer PRIMARY KEY,
	CodS integer NOT NULL,
	Edition integer NOT NULL,
	Ranking integer NOT NULL
);

COMMIT;

START TRANSACTION;



/*2ND PART*/

/*QUERY*/





INSERT INTO Cyclist (CodC, Name, Surname, Nationality, CodT, BirthYear)
VALUES ('15122','Ioannis','Pontikopoulos','Greek','123','1999');

INSERT INTO Team (CodT,NameT,FoundationYear,LegalAddress)
VALUES('123','pao','1908','Athens');

INSERT INTO Individual_classification (CodC, CodS, Edition, Ranking)
VALUES ('15122','1','1','2');



INSERT INTO Cyclist (CodC, Name, Surname, Nationality, CodT, BirthYear)
VALUES ('7456','nikos','pontikopoulos','greek','444','2000');

INSERT INTO Team (CodT,NameT,FoundationYear,LegalAddress)
VALUES('444','marousi','2005','amarousion');


INSERT INTO Individual_classification (CodC, CodS, Edition, Ranking)
VALUES ('7456','2','2','1');


COMMIT;

