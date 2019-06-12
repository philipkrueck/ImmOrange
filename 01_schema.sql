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
  acc_email VARCHAR(200) NOT NULL UNIQUE,
  acc_password VARCHAR(255) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  realtor_id INTEGER,
  creation_date DATETIME DEFAULT now() NOT NULL,
  FOREIGN KEY(realtor_id) REFERENCES realtor(realtor_id)
) ENGINE = InnoDB ;