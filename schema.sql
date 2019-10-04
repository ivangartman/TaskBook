-- Создание БД и вход
CREATE DATABASE taskBook
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
USE taskBook;

-- Создание таблицы с задачами
CREATE TABLE tasks (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  date_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  name VARCHAR(40) NOT NULL,
  email VARCHAR(40) NOT NULL,
  content TEXT(500) NOT NULL,
  status INT(11) DEFAULT 0,
  edit_content INT(11) DEFAULT 0
);
CREATE INDEX t_name ON tasks(name);

-- Создаём таблицы зарегистрированных пользователей
CREATE TABLE users (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  date_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  first_name VARCHAR(60) NOT NULL,
  password VARCHAR(120) NOT NULL
);
CREATE INDEX u_first_name ON users(first_name);
