/*Create Tables*/
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
                    name tinytext not null,
                    description text not null,
                    due datetime not null,
                    state boolean DEFAULT false not null,
                    primary key (taskid, userid),
                    foreign key (userid) references Users(userid)
);

CREATE TABLE Preferences (
                       userid int not null,
                       foreground varchar(32) DEFAULT '#028090',
                       background varchar(32) DEFAULT '#CCE0F5',
                       primary key (userid),
                       foreign key (userid) references Users(userid)
);
