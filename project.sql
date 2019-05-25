DROP TABLE IF EXISTS account;
DROP TABLE IF EXISTS property_offer;
DROP TABLE IF EXISTS realtor;

CREATE TABLE realtor  (
  realtor_id INTEGER PRIMARY KEY NOT NULL,
  company_name VARCHAR(50) NOT NULL,
  tel_number VARCHAR(25) NOT NULL
) ENGINE = InnoDB ;

CREATE TABLE property_offer (
  offer_id INTEGER PRIMARY KEY NOT NULL,
  realtor_id INTEGER NOT NULL,
  offer_name VARCHAR(50) NOT NULL,
  is_apartment BOOLEAN NOT NULL,
  is_for_rent BOOLEAN NOT NULL,
  number_of_rooms INTEGER NOT NULL,
  price INTEGER NOT NULL,
  qm INTEGER NOT NULL,
  construction_year INTEGER NOT NULL,
  has_garden BOOLEAN NOT NULL,
  has_basement BOOLEAN NOT NULL,
  has_bathtub BOOLEAN NOT NULL,
  has_elevator BOOLEAN NOT NULL,
  has_balcony BOOLEAN NOT NULL,
  street VARCHAR(50) NOT NULL,
  house_number VARCHAR(10) NOT NULL,
  zip VARCHAR(10) NOT NULL,
  city VARCHAR(50) NOT NULL,
  country VARCHAR(50) NOT NULL,
  image_name VARCHAR(255) NOT NULL,
  image_mime VARCHAR(255) NOT NULL,
  image_data LONGBLOB NOT NULL,
  creation_date DATETIME DEFAULT now() NOT NULL,
  FOREIGN KEY(realtor_id) REFERENCES realtor(realtor_id),
  FULLTEXT (offer_name, street, zip, city, country)
) ENGINE=InnoDB ;

CREATE TABLE account (
  acc_id INTEGER PRIMARY KEY NOT NULL,
  acc_email VARCHAR(50) NOT NULL,
  acc_password VARCHAR(255) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  realtor_id INTEGER,
  creation_date DATETIME DEFAULT now() NOT NULL,
  FOREIGN KEY(realtor_id) REFERENCES realtor(realtor_id)
) ENGINE = InnoDB ;

INSERT INTO realtor (realtor_id, company_name, tel_number) VALUES
(1, 'Brookfield Asset Management', '01(54)807-34-24'),
(2, 'American Tower Corporation', '01(54)807-34-24'),
(3, 'Simon Property Group', '01(54)807-34-24'),
(4, 'Weyerhaeuser', '01(54)807-34-24'),
(5, 'Westfield', '01(54)807-34-24'),
(6, 'AvalonBay Communities', '01(54)807-34-24'),
(7, 'Jake Simmons Lake View Houses', '01(54)807-34-24');

INSERT INTO account (acc_id, acc_email, acc_password, first_name, last_name, realtor_id, creation_date) VALUES
('1', 'Franson@gmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Franson', 'Timothy', '1', now()),
('2', 'americantower@corporation.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Hamm', 'Jose', '2', now()),
('3', 'simon@propertygroup.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Jackson', 'Connie', '3', now()),
('4', 'sapp.weyerhaeuser@gmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Sapp', 'Vanessa', '4', now()),
('5', 'hunt.westfield@gmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Hunt', 'William', '5', now()),
('6', 'riordan@avalonbay.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Riordan', 'Linda', '6', now()),
('7', 'isaac@lakeview.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS','Isaac', 'Ruben', '7', now()),
('8', 'flemming@hotmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Flemming', 'Frank', '1', now()),
('9', 'hommes@myhsba.de', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Hommes', 'Megan', NULL, now()),
('10', 'long@gmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Long', 'Katherine', NULL, now()),
('11', 'hill@hillert.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Hill', 'Becky', NULL, now()),
('12', 'pinard@peanuts.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Pinard', 'Kevin', NULL, now()),
('13', 'grady@slimshady.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Grady', 'Matthew', NULL, now()),
('14', 'soto@sushikyoto.tk', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Soto', 'Benjamin', NULL, now());
