CREATE TABLE USERS
(
  iduser INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  identifiantUser VARCHAR(50),
  passwordUser VARCHAR(50),
  droitUser VARCHAR(20)
)engine=innoDB default CHARSET=UTF8;
INSERT INTO USERS VALUES (null, "user", "user", "user");
INSERT INTO USERS VALUES (null, "admin", "admin", "admin");