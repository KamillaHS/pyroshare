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
  IsBanned BIT DEFAULT 0
);

CREATE TABLE Post (
  PostID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Img VARCHAR(255) NOT NULL,
  Title VARCHAR(255),
  Description VARCHAR(255),
  UploadedAt DATE,
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
  CreatedAt DATE,
  PostID INT
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

ALTER TABLE Likes
  ADD FOREIGN KEY (PostID) REFERENCES Post (PostID);


/* Insert test data */

/* Admin */
insert into admin (AdminID, Username, Password) values (1, 'klansberry0', 'FWCGHkGNscb');
insert into admin (AdminID, Username, Password) values (2, 'idown1', 'v7QblM4c8sO');
insert into admin (AdminID, Username, Password) values (3, 'sfarrier2', 'k7cEaJ');
insert into admin (AdminID, Username, Password) values (4, 'gsurgey3', '2ndA7soDtq8f');
insert into admin (AdminID, Username, Password) values (5, 'eamott4', 'E8BkQ6Zr8ZAr');

/* BackendStyle */
insert into backendstyle (StyleID, BackgroundColor) values (1, '#8ee870');
insert into backendstyle (StyleID, BackgroundColor) values (2, '#923fdb');
insert into backendstyle (StyleID, BackgroundColor) values (3, '#e41164');
insert into backendstyle (StyleID, BackgroundColor) values (4, '#f980b9');
insert into backendstyle (StyleID, BackgroundColor) values (5, '#e2b5de');

/* Category */
insert into category (CategoryID, CategoryName) values (1, 'synergy');
insert into category (CategoryID, CategoryName) values (2, 'strategy');
insert into category (CategoryID, CategoryName) values (3, 'project');
insert into category (CategoryID, CategoryName) values (4, 'process improvement');
insert into category (CategoryID, CategoryName) values (5, 'holistic');

/* User */
insert into user (UserID, Username, Password, Email, Country, Birthday, IsBanned) values (1, 'cwidger0', '3WV921fs', 'bcrudgington0@soup.io', 'China', '11/2/2019', false);
insert into user (UserID, Username, Password, Email, Country, Birthday, IsBanned) values (2, 'hsergeaunt1', 'IbLtMmjRBMO', 'llipscombe1@eventbrite.com', 'Russia', '16/3/2019', false);
insert into user (UserID, Username, Password, Email, Country, Birthday, IsBanned) values (3, 'hfasham2', 'SBHVE7mZor', 'tknowlden2@parallels.com', 'Colombia', '29/3/2018', false);
insert into user (UserID, Username, Password, Email, Country, Birthday, IsBanned) values (4, 'hkimmins3', 'N5ZRHYyC', 'bwhoolehan3@homestead.com', 'Indonesia', '11/4/2018', true);
insert into user (UserID, Username, Password, Email, Country, Birthday, IsBanned) values (5, 'wfandrey4', 'l6bARqhNBto', 'rcropper4@mlb.com', 'Chile', '22/6/2018', false);

/* Post */
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, UserID) values (1, 'http://dummyimage.com/128x224.bmp/ff4444/ffffff', 'Sugar Town', 'Drsl/drslumb fus ant/ant', '23/11/2018', false, true, 5);
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, UserID) values (2, 'http://dummyimage.com/180x171.png/ff4444/ffffff', 'Ace Attorney (Gyakuten saiban)', 'Delayed clos abd wound', '19/9/2018', true, true, 5);
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, UserID) values (3, 'http://dummyimage.com/105x236.jpg/cc0000/ffffff', 'Return of the Living Dead, The', 'Bact smear NEC', '9/10/2018', false, true, 5);
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, UserID) values (4, 'http://dummyimage.com/207x107.bmp/5fa2dd/ffffff', 'Thoughtcrimes', 'Transsac rectosigmoidect', '22/3/2018', true, false, 2);
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, UserID) values (5, 'http://dummyimage.com/247x180.bmp/cc0000/ffffff', 'Amour fou, L''', 'Sphincter of oddi dilat', '11/7/2018', true, true, 4);

/* Comment */
insert into comment (CommentID, Description, Likes, CreatedAt, PostID) values (1, 'Other muscle/fasc suture', 55, '26/05/2018', 1);
insert into comment (CommentID, Description, Likes, CreatedAt, PostID) values (2, 'Artificial insemination', 60, '11/08/2018', 2);
insert into comment (CommentID, Description, Likes, CreatedAt, PostID) values (3, 'Tracheoscopy thru stoma', 43, '05/06/2018', 3);
insert into comment (CommentID, Description, Likes, CreatedAt, PostID) values (4, 'Adrenal exploration NOS', 81, '04/08/2018', 4);
insert into comment (CommentID, Description, Likes, CreatedAt, PostID) values (5, 'Leg varicos v liga-strip', 36, '17/08/2018', 5);

/* Likes */
insert into likes (LikeID, Likes, Dislikes, PostID) values (1, 47, 63, 2);
insert into likes (LikeID, Likes, Dislikes, PostID) values (2, 72, 76, 4);
insert into likes (LikeID, Likes, Dislikes, PostID) values (3, 33, 83, 3);
insert into likes (LikeID, Likes, Dislikes, PostID) values (4, 11, 65, 5);
insert into likes (LikeID, Likes, Dislikes, PostID) values (5, 64, 84, 3);

/* PostCat */
insert into postcat (PostID, CategoryID) values (5, 5);
insert into postcat (PostID, CategoryID) values (2, 5);
insert into postcat (PostID, CategoryID) values (1, 3);
insert into postcat (PostID, CategoryID) values (2, 1);
insert into postcat (PostID, CategoryID) values (1, 4);

/* WebsiteInfo */
insert into websiteinfo (InfoID, Description, RulesAndRegulations, Contact) values (1, 'Other diagnostic procedures on prostate and periprostatic tissue', 'Prostatic dx proced NEC', '818-428-2011');

/* WebStyle */
insert into webstyle (StyleID, WebTitle, Logo) values (1, 'House of Tolerance', 'https://robohash.org/doloresidinventore.png?size=50x50&set=set1');
