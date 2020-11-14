//用户表
create table if not exists `user`(
id int not null primary key auto_increment,
userName varchar(20) not null,
password varchar(10) not null,
name varchar(20) not null,
tel int not null,
last_login_ip int not null,
login_times int default 0,
status tinyint default 0,
last_login_time int(10) not null,
role tinyint default 0,
addate int(10) not null
)ENGINE=MYISAM charset=utf8;


create table if not exists `category`(
id int not null primary key auto_increment,
className varchar(30) not null,
orderBy int not null,
pid int not null
)ENGINE=MYISAM charset=utf8;


create table if not exists `article`(
id int not null primary key auto_increment,
category_id int not null,
user_id int not null,
title varchar(20) not null,
content text not null,
orderBy int not null,
comment_count int not null,
top tinyint default 0,
`read` int default 0,
praise int default 0,
addate int not null
)ENGINE=MYISAM charset=utf8;


create table if not exists `link`(
id int not null primary key auto_increment,
url varchar(30) not null,
domain varchar(30) not null
)ENGINE=MYISAM charset=utf8;

//评论表
create table if not exists `comment`(
id int not null primary key auto_increment,
article_id int not null,
user_id int not null,
content text not null,
create_time date not null
)ENGINE=MYISAM charset=utf8;