CREATE SCHEMA `examen` ;
-- CREATE USER 'examen'@'127.0.0.1' IDENTIFIED BY 'mayela';
CREATE USER 'examen'@' 127.0.0.1' IDENTIFIED WITH mysql_native_password BY 'mayela';
GRANT ALL ON examen.* TO 'examen'@'127.0.0.1';
