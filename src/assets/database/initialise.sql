/*Create Tables*/
USE wjph202;
DROP TABLE Users;
DROP TABLE Tasks;

CREATE TABLE Users (
                    userid int not null auto_increment,
                    username tinytext not null,
                    password longtext not null,
                    salt longtext not null,
                    primary key (userid)
);


CREATE TABLE Tasks (
                    taskid int not null auto_increment,
                    userid int not null,
                    name tinytext not null,
                    description longtext not null,
                    state boolean,
                    primary key (taskid, userid),
                    foreign key (userid) references Users(userid)
);