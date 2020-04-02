/*Create Tables*/
USE wjph202;
DROP TABLE Users;
DROP TABLE Tasks;

CREATE TABLE Users (
                    userid int not null auto_increment,
                    username varchar(30),
                    firstname varchar(30),
                    surname varchar(40),
                    password varchar,
                    salt varchar(64),
                    primary key (userid)
);


CREATE TABLE Tasks (
                    taskid int not null auto_increment,
                    userid int not null,
                    name varchar(32),
                    description varchar(280),
                    state boolean,
                    primary key (taskid, userid),
                    foreign key (userid) references User(userid)
);