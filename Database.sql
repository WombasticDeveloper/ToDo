CREATE DATABASE ToDo;
USE ToDo;

CREATE TABLE Users(
    User_ID INT AUTO_INCREMENT PRIMARY KEY,
    Login VARCHAR(35) UNIQUE NOT NULL,
    Email VARCHAR(40) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    UserToken VARCHAR(255) NOT NULL,
    Expiry DATETIME NOT NULL,
    Theme BIT DEFAULT 0
);

CREATE TABLE Tasks(
    Task_ID INT AUTO_INCREMENT PRIMARY KEY,
    User_ID INT,
    Done BIT DEFAULT 0,
    Title VARCHAR(40) NOT NULL,
    Description LONGTEXT,
    Tag_ID INT NOT NULL,
    DateSet DATE,
    Task_Priority VARCHAR(20)
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

INSERT INTO Users (Login,Email,Password,UserToken,Expiry,Theme) VALUES 
('Admin1','xkamil580@gmail.com','$2y$10$iIjbOtsi/vmbXooOD/2BzeeY3Ruzwte2Yt0QqacWSwUHcSHZQv/4S','c8fbdd396d8a41dab063941004b198ed2e2e1027',NOW(),1);

INSERT INTO Tags (User_ID,Tag_Name,Tag_Color) VALUES
(1,'Work','#F03B3B'),
(1,'School','#3B65F0'),
(1,'Home','#CFF03B'),
(1,'Routine','#CE9B60'),
(1,'Reading','#60CE9E');

INSERT INTO Tasks (User_ID,Title,Tag_ID,Task_Priority) VALUES 
(1,'Test',1,'High Priority');