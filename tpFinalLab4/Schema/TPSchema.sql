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
	fee float,
	size char(6),
	constraint pk_keeper primary key (keeperid),
	constraint fk_user foreign key (userid) references user(userid)
);

create table pet
(
	petid int auto_increment,
	name varchar(100),
	birthDate date,
	ownerid int,
	vaccinationPlan varchar(200),
	picture varchar(200),
	breed varchar (50),
	size varchar(50),
	video varchar(200),
	comments varchar(100),
	constraint pk_pet primary key (petid),
	constraint fk_owner foreign key (ownerid) references owner(ownerid)
);

create table calendar
(
	calendarid int auto_increment,
	keeperid int,
	calendarDate date,
	status varchar (50),
	constraint pk_calendar primary key (calendarid),
	constraint fk_keeper foreign key(keeperid) references keeper(keeperid)
);

create table booking
(
	bookingNr int auto_increment,
	bookingDate date,
	startDate date,
	endDate date,
	keeperid int,
	petid int,
	totalPrice float,
	paidAmount float,
	isAccepted char(3),
	constraint pk_booking primary key (bookingNr),
	constraint fk_keeper foreign key (keeperid) references keeper (keeperid),
	constraint fk_pet foreign key (petid) references pet (petid)
);

create table email
(
	emailid int auto_increment,
	sentDate date,
	emailRecipient varchar(50),
	body varchar (1000),
	bookingNr int,
	message varchar (1000),
	constraint pk_email primary key (emailid),
	constraint fk_booking foreign key (bookingNr) references booking (bookingNr)	
);


create table invoice
(
	invoiceid int auto_increment,
	invoiceNr int,
	invoiceDate date,
	bookingNr int,
	value float,
	constraint pk_invoice primary key (invoiceid),
	constraint fk_booking foreign key (bookingNr) references booking (bookingNr)
);



