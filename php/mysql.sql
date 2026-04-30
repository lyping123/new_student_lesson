CREATE DATABASE IF NOT EXISTS test_db;

USE test_db;

CREATE TABLE IF NOT EXISTS greetings (
    id INT PRIMARY KEY,
    message VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Products (
    id INT PRIMARY KEY,
    product_name VARCHAR(255),
    qty INT(11),
    mass decimal(10,2)
);

ALTER TABLE `products` 
modify `id` INT(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `products`(`product_name`,`qty`,`mass`) 
			values('abc',120,20.3),('def',100,30);
            
UPDATE `products` SET `product_name`='apple',`qty`=30,`mass`=20
WHERE `id`=3;

DELETE FROM `products` WHERE `id`=3;



select * from `products` ;

CHECK TABLE `products`;

REPAIR TABLE `products`;

CHECK TABLE `products`;


ALTER TABLE `greetings`  
DROP COLUMN `message_type`;

ALTER TABLE `greetings` 
ADD COLUMN `message_type` varchar(450);

ALTER TABLE `greetings`
CHANGE COLUMN message_type message_cat VARCHAR(100);













