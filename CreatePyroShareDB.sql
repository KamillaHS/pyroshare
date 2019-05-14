DROP DATABASE IF EXISTS PyroShareDB;
CREATE DATABASE PyroShareDB;
USE PyroShareDB;

/* Tables Frontend*/

CREATE TABLE `user` (
  UserID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Username VARCHAR(255) NOT NULL,
  Password VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  Country VARCHAR(255),
  Birthday DATE,
  ProfilePic VARCHAR(255),
  ProfileCover VARCHAR(255),
  Role VARCHAR(10) DEFAULT 'user',
  IsBanned BIT DEFAULT 0
);

CREATE TABLE post (
  PostID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Img VARCHAR(255) NOT NULL,
  Title VARCHAR(255),
  Description VARCHAR(255),
  UploadedAt TIMESTAMP,
  isHot BIT DEFAULT 0,
  isSticky BIT DEFAULT 0,
  UserID INT NOT NULL
);

CREATE TABLE category (
  CategoryID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  CategoryName varchar(255)
);

CREATE TABLE comment (
  CommentID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Description VARCHAR(500) NOT NULL,
  Likes INT,
  CreatedAt TIMESTAMP,
  PostID INT,
  UserID INT,
  isPic BIT DEFAULT 0
);

CREATE TABLE likes (
  LikeID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Likes INT,
  Dislikes INT,
  PostID  INT
);

/* Tables Backend */


CREATE TABLE admin (
  AdminID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Username VARCHAR(255),
  Password VARCHAR(255)
);

CREATE TABLE websiteinfo (
  InfoID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Description VARCHAR(5000),
  RulesAndRegulations VARCHAR(10000),
  Contact VARCHAR(1000)
);

CREATE TABLE webstyle (
  StyleID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  WebTitle VARCHAR(255),
  Logo VARCHAR(255)
);

CREATE TABLE backendstyle (
  StyleID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  BackgroundColor VARCHAR(10)
);

/* Many to Many tables */

CREATE TABLE postcat (
  PostID INT NOT NULL,
  CategoryID INT NOT NULL,
  CONSTRAINT PK_postcat PRIMARY KEY (PostID, CategoryID),
  FOREIGN KEY (PostID) REFERENCES post (PostID),
  FOREIGN KEY (CategoryID) REFERENCES category (CategoryID)
);

/* Add Foreign Keys to tables */

ALTER TABLE post
  ADD FOREIGN KEY (UserID) REFERENCES `user` (UserID);

ALTER TABLE comment
  ADD FOREIGN KEY (PostID) REFERENCES post (PostID);

ALTER TABLE comment
  ADD FOREIGN KEY (UserID) REFERENCES `user` (UserID);

ALTER TABLE likes
  ADD FOREIGN KEY (PostID) REFERENCES post (PostID);


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
insert into user (UserID, Username, Password, Email, Country, Birthday, ProfilePic, ProfileCover, Role, IsBanned) values (1, 'FireIsAll', '3WV921fs', 'bcrudgington0@soup.io', 'China', '1989-05-03', 'quovelitneque.png', '#292686', 'mod', false);
insert into user (UserID, Username, Password, Email, Country, Birthday, ProfilePic, ProfileCover, Role, IsBanned) values (2, 'BurnEverything', 'IbLtMmjRBMO', 'llipscombe1@eventbrite.com', 'Germany', '1982-06-08', 'beataequiqui.png', '#3acd11', 'user', false);
insert into user (UserID, Username, Password, Email, Country, Birthday, ProfilePic, ProfileCover, Role, IsBanned) values (3, 'GotGuy85', 'SBHVE7mZor', 'tknowlden2@parallels.com', 'Colombia', '1985-12-28', 'liberoconsecteturqui.png', '#f0714a', 'user', false);
insert into user (UserID, Username, Password, Email, Country, Birthday, ProfilePic, ProfileCover, Role, IsBanned) values (4, 'LightItUp', 'N5ZRHYyC', 'bwhoolehan3@homestead.com', 'Sweden', '1992-09-18', 'isterepellendusofficia.png', '#4a1a6b', 'user', true);
insert into user (UserID, Username, Password, Email, Country, Birthday, ProfilePic, ProfileCover, Role, IsBanned) values (5, 'GodWillBurn', 'l6bARqhNBto', 'rcropper4@mlb.com', 'Chile', '1998-02-02', 'voluptatemolestiaspariatur.png', '	#45c42c', 'user', false);

/* Post */
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, isSticky, UserID) values (1, '550.jpg', 'Sugar Town', 'Drsl/drslumb fus ant/ant', '2019-04-01 15:13:06', false, true, 5);
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, isSticky, UserID) values (2, '560.jpg', 'Nice and Easy', 'Delayed clos abd wound', '2019-01-19 14:09:06', true, true, 5);
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, isSticky, UserID) values (3, '570.jpg', 'Catch a Star', 'Bact smear NEC', '2019-03-31 16:56:09', false, true, 5);
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, isSticky, UserID) values (4, '580.jpg', 'Thought Crimes', 'Transsac rectosigmoidect', '2019-03-22 05:59:01', true, false, 2);
insert into post (PostID, Img, Title, Description, UploadedAt, isHot, isSticky, UserID) values (5, '590.jpg', 'Something Different', 'Sphincter of oddi dilat', '2019-04-01 07:05:09', true, true, 4);

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
insert into websiteinfo (InfoID, Description, RulesAndRegulations, Contact) values (1, '<div>Welcome to PyroShare!</div>This is a website for <b>pyromaniacs</b> or people who just loves fire!<div>We are the bigget <b>official</b> photosharing site for pyromaniacs.</div><div><br></div><div>The purpose of PyroShare is to try and satisfy the fire needs of people without them doing something dangerous or illegal! And of course to share beautiful photos or illustrations of fire, or funny memes about fire. </div><div><br></div><div>We of course have rules and regulations, which you can read <u>here</u>. We have made those rules and regulations because we strive to give our users the best legal experiences with fire as possible. </div><div><br></div><div>Do you want to contact us? send us a mail!</div>', '<h5 style="line-height: 25.256px; margin-top: 1.09333rem;">Introduction<br></h5><div><div>PyroShare is a photosharing platform for Pyromaniacs or people who simply like looking at fire. </div><div>In the following sections, you will be able to read about the rules, regulations and terms for using the website PyroShare.</div><div>By making an account you automatically agree to follow the following rules, regulations and terms, and you also agree that not following them, gives us the right to either ban or delete your account.</div><div>In the following sections, PyroShare will be refered to as "the site".</div><div><br></div><h5 style="line-height: 25.256px; margin-top: 1.09333rem;">The 10 Golden Rules</h5><div><div><b>1</b></div><div>Please regulate your use of profanity on the site. It can be offensive, and if someone contacts us about your use of profanity, we will have to investigate and possibly take action.<br><br></div><div><b>2</b></div><div>Nudity in any way is not allowed on this site - no matter how hot it may be (this is a site for fire, not nudity)<br><br></div><div><b>3</b></div><div>Please keep your content fire related.<br><br></div><div><b>4</b></div><div>Do not make any personal attacks on this site</div><div><br></div><div><b>5</b><br>Do not make any advertisment for other sites. </div><div><br></div><div><b>6</b><br>When you upload a photo or gif, please make the title and description related to the photo or gif. </div><div><br></div><div><b>7</b><br>Photos or gifs that display cruelty to animals or humans are not allowed. Even though this is a site for Pyromaniacs, we do not condone cruelty to animals or humans.</div><div><br></div><div><b>8</b><br>If you do not own the content yourself, please make relevant references to credit the owner. </div><div><br></div><div><b>9</b></div><div>Do not make duplicate uploads.</div><div><br></div><div><b>10</b><br>If you see someone who does NOT follow these rules, please contact us.</div></div></div><div><br></div><div><h5 style="line-height: 25.256px; margin-top: 1.09333rem;">Accounts and Registration</h5><div><div>The site is designed for use by people who are at least 18 years old. If you are not yet 18 years old, you cannot use the site. </div><div>If you have or previously have had an account on the site, and you make a new account, you promise to us that your current or previous account have not been banned or deleted by us (the PyroShare Team).</div></div><div><br></div><div>You are able to access parts of the site when you are not logged in, but you cannot make any uploads or comments unless you are logged in.</div><div>Therefore we (the PyroShare Team) suggest that you Sign Up (make/register an account). When you Sign Up, you also have access to a profile page specific for your account.</div><div><br></div><div>When you Sign Up, we ask of you to give us minimal information about yourself, some of which is required. When you fill out these fields, you promise that the information you provde is accurate and that you will keep it up-to-date as long as the account is active (not banned or deleted). </div><div>A password is required to make an account, and you yourself is responsible to make a secure password and keep it safe and confidential. Any activity on your account will be your responsibility. </div><div><br></div><div>If you want to reset your password or delete your account, you need to contact us.</div><div>For more information about how to contact us, <u>click here</u>.</div><div><div><br></div><h5 style="line-height: 25.256px; margin-top: 1.09333rem;">License to Photos</h5><div>On the site, you can view and upload photos or gifs, either as posts or as comments. </div><div>If you upload a photo or gif as a post, you either need to own the uploaded subject yourself, or give credit to the owner in the description.</div><div>If you uoload a photo as a comment, you either need to own the uploaded subject yourself, or give credit to the owner in a way of your choosing, that is visible to the public and is close to the specific photo. </div><div>If you upload a gif as a comment, there are no rules.</div><div><br></div><div><h5 style="line-height: 25.256px; margin-top: 1.09333rem;">User Content</h5><div>You are responsible for any content that you have written or uploaded to the site (refered to as "your content"). This includes any information on your profile page, any photos or gifs that you have uploaded and comments that you have written.</div><div><br></div><div>It is your responsibility that your content follow the rules and regulation of the site. If your content does not follow the rules and regulations of the site, you automatically grant us permission to ban your account or delete your account or content.</div><div><br></div><div><div><h5 style="line-height: 25.256px; margin-top: 1.09333rem;">Termination of your account</h5><div>If you breach any of these rules, regulations or terms, you automatically grant us permission to ban or delete your account without any notice given to you.<br>If your account gets banned, your data, including your uploads and comments, will still be in our database, and therefore also visible on the site.<br>If your account gets deleted, your data, including your uploads and comments, will get delete from our database, and therefore not visible on the site anymore.<br><br>We (the PyroShare Team), will never ban or delete accounts without good reason. Furthermore, deleting an account will only be done, if most or all the user content does not follow the rules, regulations and terms.<br></div><h5 style="line-height: 25.256px; margin-top: 1.09333rem;">Ownership of the site</h5><div>The PyroShare Team own and operates the site. All the software, visual interfaces, graphics, design, information and content is protected by intellectual property and other laws. Usage of any of the mentioned things are not permitted outside of the site, unless you yourself own content, or is granted permission by the PyroShare Team. <br></div></div></div><div><br></div></div></div></div>', 'support@pyroshare.com');

/* WebStyle */
insert into webstyle (StyleID, WebTitle, Logo) values (1, 'PyroShare', '../../logo/PyroShareLogo.png');



/* Stored Procedures */
DELIMITER $$
CREATE DEFINER='root'@'localhost' PROCEDURE proc_create_post(IN input_img VARCHAR(255), IN input_title VARCHAR(255), IN input_description VARCHAR(255), IN user_id INT)
  BEGIN
    INSERT INTO `post` (`PostID`, `Img`, `Title`, `Description`, `UploadedAt`, `isHot`, `isSticky`, `UserID`)
                        VALUES (NULL, input_img, input_title, input_description, CURRENT_TIMESTAMP, 0, 0, user_id);
  END$$
DELIMITER ;

/* one more stored procedure is missing */

/* Views */
/* two views are missing */