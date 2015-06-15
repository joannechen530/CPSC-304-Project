drop table Customer;
drop table Staff;
drop table Restaurant;
drop table SellsDish;
drop table Waiter;
drop table Chef;

--havnt done these
drop table Supervises;
drop table Branch;
drop table WorksAt;
drop table HasWorkedAt;
drop table Reviews;
drop table Visits;

CREATE TABLE Customer
	(username CHAR(20) not null,
	phone CHAR(10) UNIQUE, 
	PRIMARY KEY (username));
 
grant select on Customer to public;
 
CREATE TABLE Staff
	(sin INT not null,
	name CHAR(50) null,
	pw CHAR(50) null,
	availability CHAR(200) null,
	PRIMARY KEY (sin));
 
grant select on Staff to public;
 
CREATE TABLE Restaurant
	(name CHAR(50) not null,
	type CHAR(50) null,
	s_date DATE null,
	PRIMARY KEY(name));

grant select on Restaurant to public;

CREATE TABLE SellsDish
	(restaurant_name CHAR(200) not null,
	dish_name CHAR(200) not null,
	price INT null,
	popularity INT null,
	PRIMARY KEY(restaurant_name, dish_name),
	FOREIGN KEY(restaurant_name) REFERENCES Restaurant ON DELETE CASCADE, ON UPDATE CASCADE);
 
grant select on SellsDish to public;
 

CREATE TABLE Waiter
	(sin INT not null, 
	shifts CHAR(200) null,
	PRIMARY KEY(sin),
	FOREIGN KEY (sin) REFERENCES Staff ON DELETE CASCADE, ON UPDATE CASCADE);
 
grant select on Waiter to public;
 
CREATE TABLE Chef(
	sin INT not null,
	certificates CHAR(200) null,
	PRIMARY KEY(sin),
	FOREIGN KEY (sin) REFERENCES Staff ON DELETE CASCADE, ON UPDATE CASCADE);
 
grant select on Chef to public;
