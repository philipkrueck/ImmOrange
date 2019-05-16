# 
# disable foreign key constraint to load and drop child and parent tables in any order
#

SET default_storage_engine=InnoDB;

DROP TABLE IF EXISTS image;
DROP TABLE IF EXISTS realtor;
DROP TABLE IF EXISTS address;
DROP TABLE IF EXISTS person;
DROP TABLE IF EXISTS account;
DROP TABLE IF EXISTS offer;
DROP TABLE IF EXISTS favorite_offer;

CREATE TABLE favorite_offer (
  offer_id INTEGER NOT NULL,
  account_id INTEGER NOT NULL,
  PRIMARY KEY(offer_id, account_id), 
  FOREIGN KEY(offer_id) REFERENCES offer(offer_id),
  FOREIGN KEY(account_id) REFERENCES account(account_id)
);

CREATE TABLE person (
  person_id INTEGER PRIMARY KEY NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  address_id INTEGER NOT NULL,
  FOREIGN KEY(address_id) REFERENCES address(address_id)
);

CREATE TABLE realtor  (
  realtor_id INTEGER PRIMARY KEY NOT NULL,
  company_name VARCHAR(50) NOT NULL,
  tel_number VARCHAR(25) NOT NULL
);

CREATE TABLE offer (
  offer_id INTEGER PRIMARY KEY NOT NULL,
  offer_name VARCHAR(50) NOT NULL,
  address_id INTEGER NOT NULL,
  realtor_id INTEGER NOT NULL, 
  is_apartment BOOLEAN NOT NULL,
  purchasing_type BOOLEAN NOT NULL,
  rooms INTEGER NOT NULL,
  price DOUBLE(11, 2), 
  qm INTEGER NOT NULL,
  image_id INTEGER,
  has_garden BOOLEAN NOT NULL,
  has_garage BOOLEAN NOT NULL,
  has_bathtub BOOLEAN NOT NULL,
  has_elevator BOOLEAN NOT NULL,
  has_balcony BOOLEAN NOT NULL,
  creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  FOREIGN KEY(address_id) REFERENCES address(address_id),
  FOREIGN KEY(realtor_id) REFERENCES realtor(realtor_id),
  FOREIGN KEY(image_id) REFERENCES image(image_id)
);
# make image_id not null 

CREATE TABLE account (
  account_id INTEGER PRIMARY KEY NOT NULL,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(200) NOT NULL,
  person_id INTEGER NOT NULL,
  realtor_id INTEGER,
  creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  FOREIGN KEY(person_id) REFERENCES person(person_id),
  FOREIGN KEY(realtor_id) REFERENCES realtor(realtor_id)
);

CREATE TABLE image (
  image_id INTEGER PRIMARY KEY NOT NULL,
  image_name VARCHAR(255) NOT NULL,
  mime VARCHAR(255) NOT NULL,
  image_data LONGBLOB NOT NULL
); 

CREATE TABLE address  (
  address_id INTEGER PRIMARY KEY NOT NULL,
  street VARCHAR(50) NOT NULL,
  house_number VARCHAR(5) NOT NULL,
  zip VARCHAR(10) NOT NULL,
  city VARCHAR(50) NOT NULL,
  country VARCHAR(50) NOT NULL
);

# mockdata
INSERT INTO realtor (realtor_id, company_name, tel_number) VALUES
(1, 'Brookfield Asset Management', '01(54)807-34-24'),
(2, 'American Tower Corporation', '01(54)807-34-24'),
(3, 'Simon Property Group', '01(54)807-34-24'),
(4, 'Weyerhaeuser', '01(54)807-34-24'),
(5, 'Westfield', '01(54)807-34-24'),
(6, 'AvalonBay Communities', '01(54)807-34-24'),
(7, 'Jake Simmons Lake View Houses', '01(54)807-34-24');

INSERT INTO address (address_id, street, house_number, zip, city, country) VALUES 
('1', 'Hainbuchenweg', '12', '22299', 'Hamburg ', 'Deutschland'), 
('2', 'Saarlandstraße', '22', '22303', 'Hamburg', 'Deutschland'), 
('3', 'Kellinghusenstraße', '3', '22289', 'Hamburg', 'Germany'), 
('4', 'Holtenauer Straße', '2', '24114', 'Kiel', 'Deutschland'), 
('5', 'Adlershügel', '7', '11199', 'München', 'Deutschland'), 
('6', 'Oberberge', '98', '11198', 'München', 'Deutschland'), 
('7', 'Tiefbach', '12', '50174', 'Erfurt', 'Deutschland'), 
('8', 'Dübelsbeker Weg ', '66', '27798', 'Berlin', 'Deutschland'), 
('9', 'Hasseldieksdammerweg', '211', '24114', 'Kiel', 'Deutschland'), 
('10', 'Kuhdamm', '1', '19234', 'Berlin', 'Deutschland'), 
('11', 'Silberfelz', '39', '18972', 'Köln', 'Deutschland'), 
('12', 'Kleine Straße', '72', '10134', 'Bremen', 'Deutschland'), 
('13', 'Schwemersitz', '12', '23293', 'Bremen', 'Deutschland'), 
('14', 'Lange Reihe', '33', '10343', 'Kitzerwerth', 'Deutschland'), 
('15', 'Zotzenweg', '3', '39188', 'Waldfritzenhof', 'Deutschland'), 
('16', 'Füsselham Street', '4', '13303', 'Kriggbach', 'Deutschland'), 
('17', 'Piperhausenring', '3', '13033', 'Berlin', 'Deutschland'), 
('18', 'Gruckbüttelerweg', '1', '83938', 'Berlin', 'Deutschland'), 
('19', 'Am Einsteiner Bach', '78', '19837', 'München', 'Deutschland'), 
('20', 'Strahlenstraße', '55', '13149', 'München', 'Deutschland');

INSERT INTO person (person_id, last_name, first_name, address_id) VALUES 
('1', 'Franson', 'Timothy', '1'), 
('2', 'Hamm', 'Jose', '2'), 
('3', 'Jackson', 'Connie', '3'), 
('4', 'Sapp', 'Vanessa', '4'), 
('5', 'Hunt', 'William', '5'), 
('6', 'Riordan', 'Linda', '6'), 
('7', 'Isaac', 'Ruben', '7'), 
('8', 'Flemming', 'Frank', '8'), 
('9', 'Hommes', 'Megan', '9'), 
('10', 'Long', 'Katherine', '10'), 
('11', 'Hill', 'Becky', '11'), 
('12', 'Pinard', 'Kevin', '12'), 
('13', 'Grady', 'Matthew', '13'), 
('14', 'Soto', 'Benjamin', '14');

INSERT INTO account (account_id, email, password, person_id, realtor_id, creation_date) VALUES 
('1', 'Franson@gmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '1', '1', CURRENT_TIMESTAMP), 
('2', 'americantower@corporation.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '2', '2', CURRENT_TIMESTAMP), 
('3', 'simon@propertygroup.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '3', '3', CURRENT_TIMESTAMP), 
('4', 'sapp.weyerhaeuser@gmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '4', '4', CURRENT_TIMESTAMP), 
('5', 'hunt.westfield@gmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '5', '5', CURRENT_TIMESTAMP), 
('6', 'riordan@avalonbay.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '6', '6', CURRENT_TIMESTAMP), 
('7', 'isaac@lakeview.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '7', '7', CURRENT_TIMESTAMP), 
('8', 'flemming@hotmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '8', NULL, CURRENT_TIMESTAMP), 
('9', 'hommes@myhsba.de', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '9', NULL, CURRENT_TIMESTAMP), 
('10', 'long@gmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '10', NULL, CURRENT_TIMESTAMP), 
('11', 'hill@hillert.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '11', NULL, CURRENT_TIMESTAMP), 
('12', 'pinard@peanuts.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '12', NULL, CURRENT_TIMESTAMP), 
('13', 'grady@slimshady.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '13', NULL, CURRENT_TIMESTAMP), 
('14', 'soto@sushikyoto.tk', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', '14', NULL, CURRENT_TIMESTAMP);

INSERT INTO offer (offer_id, offer_name, address_id, realtor_id, is_apartment, purchasing_type, rooms, price, qm, image_id, 
has_garden, has_garage, has_bathtub, has_elevator, has_balcony, creation_date) VALUES 
('1', 'Wohnung mit Aussicht **TOP LAGE**', '15', '1', '0', '0', '3', '200000', '100', NULL, '0', '0', '1', '0', '1', CURRENT_TIMESTAMP),
 ('2', 'Direkt am Stadtpark!', '16', '2', '0', '0', '4', '500000', '60', NULL, '0', '1', '1', '0', '1', CURRENT_TIMESTAMP), 
 ('3', 'Ubahn-Anbindung TOP', '17', '3', '1', '1', '2', '1500', '45', NULL, '0', '0', '0', '0', '1', CURRENT_TIMESTAMP), 
 ('4', 'Naturparadies! Haustiere erlaubt.', '18', '4', '0', '1', '5', '2000', '120', NULL, '1', '1', '0', '0', '0', CURRENT_TIMESTAMP), 
 ('5', 'Perfekt zum JOGGEN!', '19', '5', '1', '1', '2', '700', '40', NULL, '0', '0', '1', '1', '0', CURRENT_TIMESTAMP), 
 ('6', '24-Stunden Tageslicht! 2-Z.-Wohn.', '20', '1', '6', '0', '4', '700', '70', NULL, '1', '1', '0', '1', '0', CURRENT_TIMESTAMP), 
 ('7', 'Altbau, ruhig, Stadtpark-Nähe **WINTERHUDE**', '1', '7', '1', '1', '4', '900', '80', NULL, '0', '0', '1', '0', '1', CURRENT_TIMESTAMP), 
 ('8', 'frisch RENOVIERTes City-App.', '2', '1', '1', '0', '5', '1400', '105', NULL, '0', '1', '1', '1', '1', CURRENT_TIMESTAMP), 
 ('9', 'U1 & U3 !!! Perfekt für Singles.', '3', '2', '1', '1', '2', '600', '20', NULL, '0', '0', '0', '0', '0', CURRENT_TIMESTAMP), 
 ('10', 'WG-ZIMMER * Shopping-Street zentral', '4', '3', '1', '1', '1', '300', '15', NULL, '0', '1', '0', '1', '1', CURRENT_TIMESTAMP), 
 ('11', 'Mit Aussicht! Edel Altbau über Dönerbude', '5', '4', '0', '0', '3', '670', '65', NULL, '0', '1', '0', '1', '1', CURRENT_TIMESTAMP), 
 ('12', 'Alpen in Sicht! Traumhüdli mit Kamin', '6', '5', '0', '0', '5', '800000', '120', NULL, '1', '1', '1', '0', '1', CURRENT_TIMESTAMP), 
 ('13', 'Hauptstadt olé! Hipster-WG', '7', '6', '1', '1', '1', '400', '25', NULL, '0', '0', '1', '1', '1', CURRENT_TIMESTAMP), 
 ('14', 'fast Hamburg! Landeshauptstadt Kiel', '8', '7', '0', '1', '4', '6000', '78', NULL, '1', '1', '1', '0', '1', CURRENT_TIMESTAMP);

INSERT INTO favorite_offer (offer_id, account_id) VALUES 
('12', '12'), 
('13', '9');