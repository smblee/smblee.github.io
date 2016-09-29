create table account
(unique_id int(3) primary key,
user_id varchar(15),
password char(40),
name varchar(30),
age int(2),
email varchar(40),
first_time int(1) default 0,
interest1 varchar(20),
interest2 varchar(20),
interest3 varchar(20),
interest4 varchar(20),
interest5 varchar(20),
interest6 varchar(20),
interest7 varchar(20)
)
