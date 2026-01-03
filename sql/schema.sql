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


ALTER TABLE user
MODIFY COLUMN password VARCHAR(225);
ALTER TABLE user
add Foreign Key (role_id) REFERENCES roles(id);
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
SHOW CREATE TABLE user;
DROP TABLE note;
DROP TABLE roles;
ALTER TABLE roles 
DROP COLUMN user_id  ;
ALTER TABLE user 
DROP Foreign Key  user_ibfk_1;
delete from roles;
TRUNCATE TABLE roles;
insert into roles (status) VALUES ('user') ,('admin');
ALTER TABLE user ADD email varchar(50);

SELECT * from user;
insert into user (name ,password ,statut, email) VALUES ("oussama", "11111" ,"pending" ,"oussama@gmail.com");
