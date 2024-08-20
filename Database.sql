CREATE DATABASE ToDo;
USE ToDo;

CREATE TABLE Users(
    User_ID INT AUTO_INCREMENT PRIMARY KEY,
    Login VARCHAR(35) UNIQUE NOT NULL,
    Email VARCHAR(40) UNIQUE NOT NULL,
    Password VARCHAR(60) NOT NULL,
    Theme BIT DEFAULT 0
);

CREATE TABLE Tasks(
    Task_ID INT AUTO_INCREMENT PRIMARY KEY,
    User_ID INT,
    Done BIT DEFAULT 0,
    Title VARCHAR(40) NOT NULL,
    Describition LONGTEXT,
    Tag_ID INT NOT NULL,
    DateSet DATE,
    DateUntil INT,
    Task_Priority INT
);

CREATE TABLE Tags(
    Tag_ID INT AUTO_INCREMENT PRIMARY KEY,
    User_ID INT,
    Tag_Name VARCHAR(20),
    Tag_Color VARCHAR(10)
);

ALTER TABLE Tasks
ADD FOREIGN KEY (User_ID) REFERENCES Users(User_ID),
ADD FOREIGN KEY (Tag_ID) REFERENCES Tags(Tag_ID);

ALTER TABLE Tags
ADD FOREIGN KEY (User_ID) REFERENCES Users(User_ID);

INSERT INTO Users (Login,Email,Password,Theme) VALUES 
('Admin1','xkamil580@gmail.com','ZAQ!2wsx',1);

INSERT INTO Tags (User_ID,Tag_Name,Tag_Color) VALUES
(1,'Work','#F03B3B'),
(1,'School','#3B65F0'),
(1,'Home','#CFF03B'),
(1,'Routine','#CE9B60'),
(1,'Reading','#60CE9E');

INSERT INTO Tasks (User_ID,Title,Tag_ID,Task_Priority) VALUES 
(1,'Test',1,3);