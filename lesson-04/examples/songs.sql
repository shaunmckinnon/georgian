USE database;
CREATE TABLE songs (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(100) NOT NULL,
  length time DEFAULT NULL,
  artist_id int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (artist_id) REFERENCES artists (id) ON DELETE CASCADE ON UPDATE CASCADE
);