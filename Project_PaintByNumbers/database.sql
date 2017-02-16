set NAMES 'cp1251';
USE acsm_d4a0065602d66b1;

DROP TABLE IF EXISTS price_type;

CREATE TABLE price_type (ID mediumint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name varchar(255) NOT NULL COMMENT 'Название типа цены'
  )
COLLATE cp1251_general_ci,
COMMENT 'Справочник типов цен';

DROP TABLE IF EXISTS prices;

CREATE TABLE prices (ID bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ID_price_type mediumint UNSIGNED NOT NULL COMMENT 'Тип цены',
  Cost double NOT NULL COMMENT 'Стоимость',
  CONSTRAINT FOREIGN KEY (ID_price_type) REFERENCES price_type (ID) ON DELETE CASCADE ON UPDATE CASCADE
  )
COLLATE cp1251_general_ci,
COMMENT 'Справочник цен на товар';

DROP TABLE IF EXISTS clients;

CREATE TABLE clients (ID bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name varchar(255) NOT NULL COMMENT 'Имя клиента',
  Site varchar(255) DEFAULT NULL COMMENT 'Сайт странцы соц.сети',
  Phone varchar(10) DEFAULT NULL COMMENT 'Телефон без +7'
  )
COLLATE cp1251_general_ci,
COMMENT 'Справочник клиентов';

DROP TABLE IF EXISTS item_type;

CREATE TABLE item_type (ID mediumint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name varchar(255) NOT NULL COMMENT 'Тип картины'
  )
COLLATE cp1251_general_ci,
COMMENT 'Справочник типов картин';

DROP TABLE IF EXISTS item_size;

CREATE TABLE item_size (ID mediumint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name varchar(255) NOT NULL COMMENT 'Размер картины'
  )
COLLATE cp1251_general_ci,
COMMENT 'Справочник размеров картин';

DROP TABLE IF EXISTS items;

CREATE TABLE items (ID bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name varchar(255) NOT NULL COMMENT 'Название картины',
  ID_item_size mediumint UNSIGNED NOT NULL COMMENT 'ID размера картины',
  ID_item_type mediumint UNSIGNED NOT NULL COMMENT 'ID типа картины',
  ID_price_sell bigint UNSIGNED NOT NULL COMMENT 'ID цены продажи',
  ID_price_buy bigint UNSIGNED NOT NULL COMMENT 'ID цены покупки',
  Site varchar(255) DEFAULT NULL COMMENT 'Ссылка на картину',
  CONSTRAINT FOREIGN KEY (ID_item_type) REFERENCES item_type (ID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (ID_item_size) REFERENCES item_size (ID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (ID_price_sell) REFERENCES prices (ID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (ID_price_buy) REFERENCES prices (ID) ON DELETE CASCADE ON UPDATE CASCADE
  )
COLLATE cp1251_general_ci,
COMMENT 'Каталог';

DROP TABLE IF EXISTS orders;

CREATE TABLE orders (ID bigint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ID_client bigint UNSIGNED NOT NULL COMMENT 'ID клиента',
  ID_item bigint UNSIGNED NOT NULL COMMENT 'ID картины',
  Date timestamp DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания заказа',
  CONSTRAINT FOREIGN KEY (ID_client) REFERENCES clients (ID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (ID_item) REFERENCES items (ID) ON DELETE CASCADE ON UPDATE CASCADE
  )
COLLATE cp1251_general_ci,
COMMENT 'Заказы';

INSERT INTO price_type (Name)
  VALUES ('Продажа');

show variables like '%char%';
 



