DROP DATABASE IF EXISTS PyroShareDB;
CREATE DATABASE PyroShareDB;
USE PyroShareDB;

/* Tables Frontend*/

CREATE TABLE `User` (
  UserID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Username VARCHAR(255) NOT NULL,
  Password VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Country VARCHAR(255),
  Birthday DATE,
  ProfilePic VARCHAR(255),
  ProfileCover VARCHAR(255),
  IsBanned BIT DEFAULT 0
);

CREATE TABLE Post (
  PostID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Img VARCHAR(255) NOT NULL,
  Title VARCHAR(255),
  Description VARCHAR(255),
  UploadedAt TIMESTAMP,
  isHot BIT DEFAULT 0,
  isSticky BIT DEFAULT 0,
  UserID INT NOT NULL
);

CREATE TABLE Category (
  CategoryID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  CategoryName varchar(255)
);

CREATE TABLE Comment (
  CommentID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Description VARCHAR(500) NOT NULL,
  Likes INT,
  CreatedAt TIMESTAMP,
  PostID INT,
  UserID INT
);

CREATE TABLE Likes (
  LikeID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Likes INT,
  Dislikes INT,
  PostID  INT
);

/* Tables Backend */


CREATE TABLE Admin (
  AdminID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Username VARCHAR(255),
  Password VARCHAR(255)
);

CREATE TABLE WebsiteInfo (
  InfoID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Description VARCHAR(1000),
  RulesAndRegulations VARCHAR(1000),
  Contact VARCHAR(1000)
);

CREATE TABLE WebStyle (
  StyleID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  WebTitle VARCHAR(255),
  Logo VARCHAR(255)
);

CREATE TABLE BackendStyle (
  StyleID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  BackgroundColor VARCHAR(10)
);

/* Many to Many tables */

CREATE TABLE PostCat (
  PostID INT NOT NULL,
  CategoryID INT NOT NULL,
  CONSTRAINT PK_PostCat PRIMARY KEY (PostID, CategoryID),
  FOREIGN KEY (PostID) REFERENCES Post (PostID),
  FOREIGN KEY (CategoryID) REFERENCES Category (CategoryID)
);

/* Add Foreign Keys to tables */

ALTER TABLE Post
  ADD FOREIGN KEY (UserID) REFERENCES `User` (UserID);

ALTER TABLE Comment
  ADD FOREIGN KEY (PostID) REFERENCES Post (PostID);

ALTER TABLE Comment
  ADD FOREIGN KEY (UserID) REFERENCES `User` (UserID);

ALTER TABLE Likes
  ADD FOREIGN KEY (PostID) REFERENCES Post (PostID);


/* Insert test data */

/* Admin */
insert into admin (AdminID, Username, Password) values (1, 'SuperAdmin', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');
insert into admin (AdminID, Username, Password) values (2, 'admin1', 'v7QblM4c8sO');
insert into admin (AdminID, Username, Password) values (3, 'admin2', 'k7cEaJ');
insert into admin (AdminID, Username, Password) values (4, 'admin3', '2ndA7soDtq8f');
insert into admin (AdminID, Username, Password) values (5, 'admin4', 'E8BkQ6Zr8ZAr');


/* BackendStyle */
insert into backendstyle (StyleID, BackgroundColor) values (1, '#8ee870');
insert into backendstyle (StyleID, BackgroundColor) values (2, '#923fdb');
insert into backendstyle (StyleID, BackgroundColor) values (3, '#e41164');
insert into backendstyle (StyleID, BackgroundColor) values (4, '#f980b9');
insert into backendstyle (StyleID, BackgroundColor) values (5, '#e2b5de');

/* Category */
insert into category (CategoryID, CategoryName) values (1, 'Nature');
insert into category (CategoryID, CategoryName) values (2, 'Buildings');
insert into category (CategoryID, CategoryName) values (3, 'Explosions');
insert into category (CategoryID, CategoryName) values (4, 'Illustrations');
insert into category (CategoryID, CategoryName) values (5, 'Memes');

/* User */
insert into user (UserID, Username, Password, Email, Country, Birthday, ProfilePic, ProfileCover, IsBanned) values (1, 'FireIsAll', '3WV921fs', 'bcrudgington0@soup.io', 'China', '1989-05-03', 'https://robohash.org/quovelitneque.jpg?size=50x50&set=set1', '#292686', false);
insert into user (UserID, Username, Password, Email, Country, Birthday, ProfilePic, ProfileCover, IsBanned) values (2, 'BurnEverything', 'IbLtMmjRBMO', 'llipscombe1@eventbrite.com', 'Germany', '1982-06-08', 'https://robohash.org/beataequiqui.jpg?size=50x50&set=set1', '#3acd11', false);
insert into user (UserID, Username, Password, Email, Country, Birthday, ProfilePic, ProfileCover, IsBanned) values (3, 'GotGuy85', 'SBHVE7mZor', 'tknowlden2@parallels.com', 'Colombia', '1985-12-28', 'https://robohash.org/liberoconsecteturqui.png?size=50x50&set=set1', '#f0714a', false);
insert into user (UserID, Username, Password, Email, Country, Birthday, ProfilePic, ProfileCover, IsBanned) values (4, 'LightItUp', 'N5ZRHYyC', 'bwhoolehan3@homestead.com', 'Sweden', '1992-09-18', 'https://robohash.org/isterepellendusofficia.bmp?size=50x50&set=set1', '#4a1a6b', true);
insert into user (UserID, Username, Password, Email, Country, Birthday, ProfilePic, ProfileCover, IsBanned) values (5, 'GodWillBurn', 'l6bARqhNBto', 'rcropper4@mlb.com', 'Chile', '1998-02-02', 'https://robohash.org/voluptatemolestiaspariatur.png?size=50x50&set=set1', '	#45c42c', false);

/* Post */
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, isSticky, UserID) values (1, 'https://picsum.photos/800/550?image=903', 'Sugar Town', 'Drsl/drslumb fus ant/ant', '2019-04-01 15:13:06', false, true, 5);
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, isSticky, UserID) values (2, 'https://picsum.photos/800/550?image=250', 'Nice and Easy', 'Delayed clos abd wound', '2019-01-19 14:09:06', true, true, 5);
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, isSticky, UserID) values (3, 'https://picsum.photos/800/550?image=660', 'Catch a Star', 'Bact smear NEC', '2019-03-31 16:56:09', false, true, 5);
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, isSticky, UserID) values (4, 'https://picsum.photos/800/550?image=896', 'Thought Crimes', 'Transsac rectosigmoidect', '2019-03-22 05:59:01', true, false, 2);
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, isSticky, UserID) values (5, 'https://picsum.photos/800/550?image=310', 'Something Different', 'Sphincter of oddi dilat', '2019-04-01 07:05:09', true, true, 4);

/* Comment */
insert into comment (CommentID, Description, Likes, CreatedAt, PostID, UserID) values (1, 'Other muscle/fasc suture', 55, '2019-04-26 15:22:09', 1, 1);
insert into comment (CommentID, Description, Likes, CreatedAt, PostID, UserID) values (2, 'Artificial insemination', 60, '2019-01-19 16:13:07', 2, 5);
insert into comment (CommentID, Description, Likes, CreatedAt, PostID, UserID) values (3, 'Tracheoscopy thru stoma', 43, '2019-04-01 01:00:05', 3, 5);
insert into comment (CommentID, Description, Likes, CreatedAt, PostID, UserID) values (4, 'Adrenal exploration NOS', 81, '2019-03-23 09:21:05', 4, 2);
insert into comment (CommentID, Description, Likes, CreatedAt, PostID, UserID) values (5, 'Leg varicos v liga-strip', 36, '2019-04-06 11:11:11', 5, 1);

/* Likes */
insert into likes (LikeID, Likes, Dislikes, PostID) values (1, 47, 63, 2);
insert into likes (LikeID, Likes, Dislikes, PostID) values (2, 72, 76, 4);
insert into likes (LikeID, Likes, Dislikes, PostID) values (3, 33, 83, 3);
insert into likes (LikeID, Likes, Dislikes, PostID) values (4, 11, 65, 5);
insert into likes (LikeID, Likes, Dislikes, PostID) values (5, 64, 84, 1);

/* PostCat */
insert into postcat (PostID, CategoryID) values (5, 5);
insert into postcat (PostID, CategoryID) values (2, 5);
insert into postcat (PostID, CategoryID) values (1, 3);
insert into postcat (PostID, CategoryID) values (2, 1);
insert into postcat (PostID, CategoryID) values (1, 4);

/* WebsiteInfo */
insert into websiteinfo (InfoID, Description, RulesAndRegulations, Contact) values (1, 'Other diagnostic procedures on prostate and periprostatic tissue', 'Prostatic dx proced NEC', '11223344');

/* WebStyle */
insert into webstyle (StyleID, WebTitle, Logo) values (1, 'House of Tolerance', '../../logo/PyroShareLogo.png');



/* Stored Procedures */
DELIMITER $$
CREATE DEFINER='root'@'localhost' PROCEDURE proc_create_post(IN input_img VARCHAR(255), IN input_title VARCHAR(255), IN input_description VARCHAR(255), IN user_id INT)
  BEGIN
    INSERT INTO `post` (`PostID`, `Img`, `Title`, `Description`, `UploadedAt`, `isHot`, `isSticky`, `UserID`)
                        VALUES (NULL, input_img, input_title, input_description, CURRENT_TIMESTAMP, 0, 0, user_id);
  END$$
DELIMITER ;