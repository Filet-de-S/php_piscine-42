<?php
session_start();

$link = mysqli_connect('127.0.0.1', 'root', 'root');
if (!$link) {
    die('Ошибка соединения: ' . mysqli_error()); exit; }



if (($que = mysqli_query($link, 'CREATE DATABASE shop;') === TRUE)) ;
else 
{ 
    return ;
    }
if (($que = mysqli_query($link, 'USE shop;') === TRUE)) ;
else
    echo "USE ne OK" . mysqli_error($link);
$que = mysqli_query($link, 'CREATE TABLE basket (
    article VARCHAR(20),
    `price` INT,
    `sess.id` VARCHAR(32)
    );');
// article VARCHAR(20) when adding to basket ADD STR TO basket TABLE

if (($que = mysqli_query($link, 'CREATE TABLE products (
    `name` VARCHAR(20),
    branch VARCHAR(20),
    tier int,
    others int,
    complex int,
    price int
    );')) === FALSE)
        echo "prod ne OK" . mysqli_error($link);

$que = mysqli_query($link, 'CREATE TABLE priv (
    `log` VARCHAR (20),
    rights int,
    email VARCHAR (30), 
    pw VARCHAR (128),
    UNIQUE (`log`),
    UNIQUE (email)
    );');

$root = hash('whirlpool', 'root');
$que = mysqli_query($link, "INSERT INTO priv VALUES ('root', 1, 'root@root.root', '06948d93cd1e0855ea37e75ad516a250d2d0772890b073808d831c438509190162c0d890b17001361820cffc30d50f010c387e9df943065aa8f4e92e63ff060c');");


$que = mysqli_query($link, "INSERT INTO products VALUES ('init', 'devops', 1, 0, 1, 5000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('roger', 'devops', 1, 0, 1, 5000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('docker', 'devops', 1, 0, 1, 5000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('ft_ls', 'unix', 1, 0, 1, 6000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('minishell', 'unix', 1, 0, 1, 6000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('ft_select', 'unix', 1, 0, 1, 6000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('21sh', 'unix', 2, 0, 1, 8000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('taskmaster', 'unix', 2, 0, 1, 8000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('42sh', 'unix', 3, 0, 1, 10000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('ft_printf', 'algoritm', 1, 0, 1, 6000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('filler', 'algoritm', 1, 0, 1, 6000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('push_swap', 'algoritm', 1, 0, 1, 6000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('lem_in', 'algoritm', 2, 0, 1, 8000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('mod1', 'algoritm', 2, 0, 1, 8000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('corewar', 'algoritm', 3, 0, 1, 10000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('fdf', 'graph', 1, 0, 1, 6000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('fract'ol', 'graph', 1, 0, 1, 6000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('guimp', 'graph', 2, 0, 1, 8000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('wolf3d', 'graph', 2, 0, 1, 8000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('rtv1', 'graph', 2, 0, 1, 8000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('doom', 'graph', 3, 0, 1, 10000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('rt', 'graph', 3, 0, 1, 10000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('slots', 'others', 0, 1, 0, 2000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('tig', 'others', 0, 1, 0, 2000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('combo', 'unix', 0, 0, 0, 35000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('combo', 'devops', 0, 0, 0, 15000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('combo', 'graph', 0, 0, 0, 35000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('combo', 'algoritm', 0, 0, 0, 35000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('combo', 'web', 0, 0, 0, 20000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('camagru', 'web', 1, 0, 1, 20000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('matcha', 'web', 2, 0, 1, 20000);");
$que = mysqli_query($link, "INSERT INTO products VALUES ('hypertube', 'web', 3, 0, 1, 20000);");

$que = mysqli_query($link, "CREATE USER 'user'@'localhost' IDENTIFIED BY 'user';");
$que = mysqli_query($link, "GRANT UPDATE, INSERT, DELETE, SELECT ON shop.basket TO 'user'@'localhost';");
$que = mysqli_query($link, "GRANT SELECT ON shop.products TO 'user'@'localhost';");
$que = mysqli_query($link, "GRANT UPDATE, INSERT, DELETE, SELECT ON shop.priv TO 'user'@'localhost';");

$link = mysqli_connect('127.0.0.1', 'user', 'user', 'shop');

if (($que = mysqli_query($link, "SELECT `name`, price FROM products WHERE branch = 'unix';")) === FALSE)
	echo "ERROR DURING QUERYING IMAGES";

$row = mysqli_fetch_all($que, MYSQLI_ASSOC);

print_r($row);


//   header('Location: /index.php');
// article VARCHAR(20) when adding to basket ADD STR TO basket TABLE

/*
if ((mysqli_change_user ($link , "user", "user", "shop")) === FALSE)
    echo "uSER change ne oK" . mysqli_error($link);

mysqli_query($link, "INSERT INTO basket VALUES (
    '42sh', 'useer', 1042, 144, 'd0772890b07380sssss8d831c4385091'
);");
*/


?>