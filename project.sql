# 
# disable foreign key constraint to load and drop child and parent tables in any order
#

SET default_storage_engine=InnoDB;

DROP TABLE IF EXISTS favorite_offer;
DROP TABLE IF EXISTS account;
DROP TABLE IF EXISTS property_offer;
DROP TABLE IF EXISTS realtor;

CREATE TABLE realtor  (
  realtor_id INTEGER PRIMARY KEY NOT NULL,
  company_name VARCHAR(50) NOT NULL,
  tel_number VARCHAR(25) NOT NULL
);

CREATE TABLE property_offer (
  offer_id INTEGER PRIMARY KEY NOT NULL,
  realtor_id INTEGER NOT NULL,
  offer_name VARCHAR(50) NOT NULL,
  is_apartment BOOLEAN NOT NULL,
  is_for_rent BOOLEAN NOT NULL,
  number_of_rooms INTEGER NOT NULL,
  price DOUBLE(11, 2), 
  qm INTEGER NOT NULL,
  construction_year INTEGER NOT NULL, 
  has_garden BOOLEAN NOT NULL,
  has_garage BOOLEAN NOT NULL,
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
  creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  FOREIGN KEY(realtor_id) REFERENCES realtor(realtor_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE account (
  acc_email VARCHAR(50) PRIMARY KEY NOT NULL,
  acc_password VARCHAR(255) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  realtor_id INTEGER,
  creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  FOREIGN KEY(realtor_id) REFERENCES realtor(realtor_id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE favorite_offer (
  offer_id INTEGER NOT NULL,
  acc_email VARCHAR(50) NOT NULL,
  PRIMARY KEY(offer_id, acc_email), 
  FOREIGN KEY(offer_id) REFERENCES property_offer(offer_id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY(acc_email) REFERENCES account(acc_email) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO realtor (realtor_id, company_name, tel_number) VALUES
(1, 'Brookfield Asset Management', '01(54)807-34-24'),
(2, 'American Tower Corporation', '01(54)807-34-24'),
(3, 'Simon Property Group', '01(54)807-34-24'),
(4, 'Weyerhaeuser', '01(54)807-34-24'),
(5, 'Westfield', '01(54)807-34-24'),
(6, 'AvalonBay Communities', '01(54)807-34-24'),
(7, 'Jake Simmons Lake View Houses', '01(54)807-34-24');

INSERT INTO account (acc_email, acc_password, first_name, last_name, realtor_id, creation_date) VALUES 
('Franson@gmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Franson', 'Timothy', '1', CURRENT_TIMESTAMP), 
('americantower@corporation.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Hamm', 'Jose', '2', CURRENT_TIMESTAMP), 
('simon@propertygroup.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Jackson', 'Connie', '3', CURRENT_TIMESTAMP), 
('sapp.weyerhaeuser@gmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Sapp', 'Vanessa', '4', CURRENT_TIMESTAMP), 
('hunt.westfield@gmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Hunt', 'William', '5', CURRENT_TIMESTAMP), 
('riordan@avalonbay.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Riordan', 'Linda', '6', CURRENT_TIMESTAMP), 
('isaac@lakeview.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS','Isaac', 'Ruben', '7', CURRENT_TIMESTAMP), 
('flemming@hotmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Flemming', 'Frank', '1', CURRENT_TIMESTAMP), 
('hommes@myhsba.de', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Hommes', 'Megan', NULL, CURRENT_TIMESTAMP), 
('long@gmail.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Long', 'Katherine', NULL, CURRENT_TIMESTAMP), 
('hill@hillert.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Hill', 'Becky', NULL, CURRENT_TIMESTAMP), 
('pinard@peanuts.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Pinard', 'Kevin', NULL, CURRENT_TIMESTAMP), 
('grady@slimshady.com', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Grady', 'Matthew', NULL, CURRENT_TIMESTAMP), 
('soto@sushikyoto.tk', '$2y$10$FJX1BetFa9sChYb8S3YHRe3nM7cz.bhtCEL7U2PqV9x9xrrStz/PS', 'Soto', 'Benjamin', NULL, CURRENT_TIMESTAMP);

INSERT INTO property_offer (offer_id, offer_name, address_id, realtor_id, is_apartment, purchasing_type, rooms, price, qm, image_id, 
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
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 




