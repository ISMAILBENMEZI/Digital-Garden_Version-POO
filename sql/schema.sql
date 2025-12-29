CREATE DATABASE DIGITAL_GARDEN
CREATE TABLE
    User (
        id INT PRIMARY key AUTO_INCREMENT,
        name VARCHAR(50),
        password VARCHAR(50),
        Registration_date DATE,
        Login_date DATE
    );

CREATE TABLE
    Theme (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50),
        Color VARCHAR(50),
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES User (id)
    );

CREATE TABLE
    Note (
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(50),
        content VARCHAR(250),
        importance INT,
        creation_date DATE,
        theme_id INT,
        FOREIGN KEY (theme_id) REFERENCES Theme (id)
    );

ALTER TABLE utilisateur ADD email varchar(50);