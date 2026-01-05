CREATE DATABASE DIGITAL_GARDEN;

use DIGITAL_GARDEN;

CREATE TABLE
    User (
        id INT PRIMARY key AUTO_INCREMENT,
        name VARCHAR(50),
        password VARCHAR(225),
        email VARCHAR(50),
        statut ENUM('pending','active','blocked'),
        Registration_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        role_id int DEFAULT 1,
        Foreign Key (role_id) REFERENCES roles(id)
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
        creation_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        theme_id INT,
        FOREIGN KEY (theme_id) REFERENCES Theme (id)
    );
    
CREATE Table Roles(
    id int PRIMARY KEY AUTO_INCREMENT,
    status ENUM('admin', 'user')
);

<<<<<<< HEAD
CREATE Table
    Roles (
        id int PRIMARY KEY AUTO_INCREMENT,
        status ENUM ('admin', 'user')
    );

insert into
    roles (status)
VALUES
    ('user'),
    ('admin');


UPDATE user SET role_id = 2 , statut = 'active' where id = 8;
=======
insert into roles (status) VALUES ('user') ,('admin');
>>>>>>> 1df51128622d107d2f0fdfd0b958db1558385bac
