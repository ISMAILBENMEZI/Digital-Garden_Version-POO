-- Active: 1765793749744@@127.0.0.1@3306@digital_garden
CREATE DATABASE DIGITAL_GARDEN;

use DIGITAL_GARDEN;

CREATE TABLE
    User (
        id INT PRIMARY key AUTO_INCREMENT,
        name VARCHAR(50),
        password VARCHAR(225),
        email VARCHAR(50),
        img VARCHAR(100),
        statut ENUM ('pending', 'active', 'blocked'),
        Registration_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        role_id int DEFAULT 1,
        Foreign Key (role_id) REFERENCES roles (id)
    );

UPDATE User
set
    statut = 'active',
    role_id = 2
WHERE
    id = 3;
-- ismailBen@.com
CREATE TABLE
    Theme (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50),
        Color VARCHAR(50),
        status ENUM('private' , 'public'),
        user_id INT,
        FOREIGN KEY (user_id) REFERENCES User (id)
    );

DROP TABLE Theme;

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

drop Table note;

CREATE Table
    Roles (
        id int PRIMARY KEY AUTO_INCREMENT,
        status ENUM ('admin', 'user')
    );

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

UPDATE user
SET
    role_id = 2,
    statut = 'active'
where
    id = 10;

insert into
    roles (status)
VALUES
    ('user'),
    ('admin');

CREATE TABLE
    Report (
        id INT PRIMARY KEY AUTO_INCREMENT,
        report_type VARCHAR(225),
        status ENUM (
            'pending',
            'under_review',
            'resolved',
            'dismissed'
        ) DEFAULT 'pending',
        reporter_name VARCHAR(50) NOT NULL,
        reported_user_id INT NOT NULL,
        report_theme_id INT NOT NULL,
        FOREIGN KEY (reporter_name) REFERENCES User (name),
        FOREIGN KEY (report_theme_id) REFERENCES Theme (id),
        FOREIGN KEY (reported_user_id) REFERENCES Theme (user_id)
    );

INSERT INTO Report 
(report_type, status, reporter_name, reported_user_id, report_theme_id) 
VALUES 
('Harassment in comments', 'pending', 'Ahmed', 10, 5),
('Spam content', 'under_review', 'Sara', 12, 3),
('Inappropriate image', 'resolved', 'John', 8, 2),
('Fake profile', 'pending', 'Mona', 15, 7),
('Offensive language', 'dismissed', 'Ali', 10, 5),
('Copyright violation', 'under_review', 'Ahmed', 20, 1),
('Scam attempt', 'pending', 'Sara', 5, 4);