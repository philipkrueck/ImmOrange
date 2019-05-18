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
