CREATE TABLE `app_order_details` (
    `OrderID` INTEGER NOT NULL,
    `ProductID` INTEGER NOT NULL,
    `UnitPrice` DECIMAL(18,2) NOT NULL DEFAULT 0,
    `Quantity` SMALLINT(2) NOT NULL DEFAULT 1,
    `Discount` REAL(8,0) NOT NULL DEFAULT 0,
    `ToTal` decimal(18,2),
    CONSTRAINT `PK_Order Details` PRIMARY KEY (`OrderID`, `ProductID`)
);
CREATE TABLE `app_orders` (
    `OrderID` INTEGER NOT NULL AUTO_INCREMENT,
    `CustomerID` integer,
    `OrderDate` DATETIME,
    `Status` int default 0,
    `SumToTal` decimal(18,0),
    CONSTRAINT `PK_Orders` PRIMARY KEY (`OrderID`)
);
CREATE TABLE `app_products`(
	`Id` int not null auto_increment primary key,
    `name` varchar(100),
    `category` int,
    `price` decimal(18,2),
    `unit` int,
    `created` datetime,
    `created_by` int
);
CREATE TABLE `app_product_categories`(
	`Id` int not null auto_increment primary key,
    `name` varchar(100),
    `descrition` text,
    `created` datetime,
    `created_by` int
);
