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
