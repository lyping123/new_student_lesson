CREATE DATABASE IF NOT EXISTS ecommerce;

USE ecommerce;

CREATE TABLE if not EXISTS users(
	id INT(11) primary key auto_increment,
    username varchar(100),
    password varchar(255),
    name varchar(100) null,
    gender varchar(10) null,
    email varchar(100) null,
    address varchar(255) null
);

INSERT into users(username,password) values('asd','123');

-- ALTER TABLE users ADD phone varchar(30);


USE ecommerce;
CREATE TABLE IF NOT EXISTS products(
	id int(11) primary key auto_increment,
	sku varchar(255),
    price decimal(10,2),
    quantity int(11),
    date_created timestamp default current_timestamp
);


INSERT INTO products(sku,price,quantity) 
VALUES('orange',3.20,100),('pineapple',5.00,100);

USE ecommerce;
CREATE TABLE IF NOT EXISTS carts(
	id int(11) primary key auto_increment,
    u_id int(11),
    p_id int(11),
    cart_id int(11),
    qty int(11)
);

ALTER TABLE carts 
ADD constraint FK_productid_cart
foreign key (p_id) references products(id)
ON DELETE CASCADE
ON UPDATE CASCADE;

INSERT INTO carts(u_id,p_id,cart_id,qty) 
VALUES(6,1,1,10),(6,2,1,10);


use ecommerce;
CREATE TABLE IF NOT EXISTS cart_id(
	id int(11) primary key auto_increment,
    cart_id varchar(255)
);

ALTER TABLE carts 
ADD created_date timestamp default current_timestamp;

use ecommerce;
ALTER TABLE cart_id
ADD c_status varchar(255);

use ecommerce;
ALTER TABLE cart_id
ADD payment_amount decimal(10,2);

use ecommerce;
ALTER TABLE cart_id
ADD payment_date timestamp default current_timestamp;

use ecommerce;
ALTER TABLE cart_id
ADD payment_type varchar(100);


