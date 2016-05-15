CREATE TABLE artists (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  founded_date date DEFAULT NULL,
  bio_link varchar(100) DEFAULT NULL,
  website varchar(100) DEFAULT NULL,
  PRIMARY KEY (id)
);