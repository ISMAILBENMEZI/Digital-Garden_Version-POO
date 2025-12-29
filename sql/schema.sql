CREATE DATABASE DIGITAL_GARDEN;
use DIGITAL_GARDEN;
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
CREATE Table Roles(
    id int PRIMARY KEY AUTO_INCREMENT,
    title ENUM('admin', 'user')
);
ALTER TABLE roles 
add COLUMN user_id INT ;
ALTER TABLE roles 
add FOREIGN KEY(user_id) REFERENCES user(id);

ALTER TABLE user ADD email varchar(50);

-- DROP DATABASE DIGITAL_GARDEN;