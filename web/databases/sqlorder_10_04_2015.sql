CREATE TABLE `app_order_details` (
    `orderid` INTEGER NOT NULL,
    `productid` INTEGER NOT NULL,
    `unitprice` DECIMAL(18,2) NOT NULL DEFAULT 0,
    `quantity` SMALLINT(2) NOT NULL DEFAULT 1,
    `discount` REAL(8,0) NOT NULL DEFAULT 0,
    `total` decimal(18,2),
    CONSTRAINT `pk_order details` PRIMARY KEY (`orderid`, `productid`)
);
CREATE TABLE `app_orders` (
    `orderid` INTEGER NOT NULL AUTO_INCREMENT,
    `customerid` integer,
    `orderdate` DATETIME,
    `status` int default 0,
    `sumtotal` decimal(18,0),
    CONSTRAINT `pk_orders` PRIMARY KEY (`orderid`)
);
CREATE TABLE `app_products`(
	`id` int not null auto_increment primary key,
    `name` varchar(100),
    `category` int,
    `price` decimal(18,2),
    `unit` int,
    `created` datetime,
    `created_by` int
);
CREATE TABLE `app_product_categories`(
	`id` int not null auto_increment primary key,
    `name` varchar(100),
    `descrition` text,
    `created` datetime,
    `created_by` int
);
-- DROP TABLE app_modules;
CREATE TABLE `app_modules`(
	`id` int not null auto_increment primary key,
    `name` varchar(100),
    `description` text,
    `attribute` varchar(255),
    `status` tinyint,
    `created` datetime,
    `created_by` int
);


