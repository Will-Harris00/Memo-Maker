/*Create Tables*/
/* tiny text can store 255 characters whilst
   text datatype can store 65,535 characters */
USE wjph202;

DROP TABLE Users;
DROP TABLE Tasks;
DROP TABLE Preferences;

DELETE FROM Users WHERE true;
DELETE FROM Preferences WHERE true;
DELETE FROM Tasks WHERE true;

CREATE TABLE Users (
                    userid int not null auto_increment,
                    username tinytext not null,
                    password text not null,
                    salt text not null,
                    primary key (userid)
);

CREATE TABLE Tasks (
                       taskid int not null auto_increment,
                       userid int not null,
                       importid int,
                       name tinytext not null,
                       description text not null,
                       due datetime not null,
                       state boolean DEFAULT false not null,
                       primary key (taskid, userid),
                       foreign key (userid) references Users(userid)
);


INSERT INTO Tasks
(taskid, userid, importid, name, description, due, state)
VALUES (21, 1, 702, 'X', 'Y', '2020-04-27 23:00:00', '0');


CREATE TABLE Preferences (
                       userid int not null,
                       foreground varchar(32) DEFAULT 'PowderBlue',
                       background varchar(32) DEFAULT 'AliceBlue',
                       primary key (userid),
                       foreign key (userid) references Users(userid)
);