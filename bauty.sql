CREATE TABLE customer(
	customerId INT NOT NULL AUTO_INCREMENT,
	customerName VARCHAR(50),
	customerEmail VARCHAR(50),
	customerPassword varchar(255),
	customerDate DATETIME,
	PRIMARY KEY (customerId)
);

SELECT * FROM customer

CREATE TABLE images (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(200) NOT NULL,
  customerId int(11),
  PRIMARY KEY (id),
	FOREIGN KEY (customerId)
    REFERENCES customer(customerId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SELECT * FROM images
DELETE FROM images WHERE id = 1

DROP TABLE images;

CREATE TABLE votes (
		rating INT NULL,
		id int(11),
        FOREIGN KEY (id)
    REFERENCES images(id)
);

SELECT * from votes


DELETE FROM votes WHERE id = 1

SELECT * from images

