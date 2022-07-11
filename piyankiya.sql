use piyankiya;
CREATE TABLE clothes(C_ID int NOT NULL AUTO_INCREMENT,
					 NAME varchar(50) NOT NULL,
					 GFOR varchar(50) NOT NULL,
					 AFOR varchar(50) NOT NULL,
					 PHOTOS varchar(300) NOT NULL,
					 PRICE varchar(50) NOT NULL,
					 TYPES varchar(50) NOT NULL,
					 DESCRIPTION varchar(300) NOT NULL,
					 PRIMARY KEY(C_ID));
CREATE TABLE booking(B_ID int NOT NULL AUTO_INCREMENT,
					 C_ID INT NOT NULL,
					 EMAIL varchar(50) NOT NULL,
					 CLIENT_NAME varchar(50) NOT NULL,
					 CLIENT_PHONE varchar(50) NOT NULL,
					 PRIMARY KEY(B_ID),
					 FOREIGN KEY(C_ID) REFERENCES clothes (C_ID));