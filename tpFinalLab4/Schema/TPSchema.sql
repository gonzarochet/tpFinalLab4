create database pethero;

USE pethero;

create table user
(
	userid int auto_increment,
	username varchar(100),
	email varchar(100) unique key,
	pass varchar(50),
	firstName varchar(100),
	lastName varchar(100),
	dateBirth datetime,
	constraint pk_user primary key(userid)
)  engine=InnoDB;

create table owner
(
	ownerid int auto_increment,
	userid int,
	constraint pk_owner primary key (ownerid),
	constraint fk_user foreign key (userid) references user(userid)
);

create table keeper
(
	keeperid int auto_increment,
	userid int,
	reputation float,
	constraint pk_keeper primary key (keeperid),
	constraint fk_user foreign key (userid) references user(userid)
);

create table pet
(
	petid int auto_increment,
	name varchar(100),
	birthDate date,
	ownerid int,
	vaccinationPlan varchar(100),
	picture varchar(100),
	breed varchar (50),
	size varchar(50),
	video varchar(100),
	comments varchar(100),
	constraint pk_pet primary key (petid),
	constraint fk_owner foreign key (ownerid) references owner(ownerid)
);

