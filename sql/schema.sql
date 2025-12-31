CREATE DATABASE DIGITAL_GARDEN;
use DIGITAL_GARDEN;
CREATE TABLE
    User (
        id INT PRIMARY key AUTO_INCREMENT,
        name VARCHAR(50),
        password VARCHAR(50),
        statut ENUM('pending','active','blocked'),
        Registration_date DATETIME DEFAULT CURRENT_TIMESTAMP
    );

    DROP TABLE user;


CREATE TABLE
    Theme (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50),
        Color VARCHAR(50),
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES User (id)
    );
DROP TABLE theme;
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
CREATE Table Roles(
    id int PRIMARY KEY AUTO_INCREMENT,
    status ENUM('admin', 'user')
);
DROP TABLE note;
ALTER TABLE roles 
add COLUMN user_id INT ;
ALTER TABLE roles 
add FOREIGN KEY(user_id) REFERENCES user(id);

ALTER TABLE user ADD email varchar(50);

insert into user (name ,password ,statut, email) VALUES ("oussama", "11111" ,"pending" ,"oussama@gmail.com");
-- DROP DATABASE DIGITAL_GARDEN;