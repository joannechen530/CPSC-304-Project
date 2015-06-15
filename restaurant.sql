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
drop table Manager;

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


insert into Customer
values('TheEater56', '416 555-0100');

insert into Customer
values('FoodieFoo', '604 666-0200');

insert into Customer
values('CheeseBurgo', '741 888-0300');

insert into Customer
values('ieatyou36', '250 000-0400');

insert into Customer
values('user3333', '778 333-0500');


 
insert into Staff
values (165867486, 'Charlotte', 'password1', 'Mon,Tues,Fri');

insert into Staff
values (111222333, 'Bob', 'password2', 'Always');

insert into Staff
values (444888555, 'Kate', 'password3', 'Weekends'); --waiter

insert into Staff
values (222999666, 'Jake', 'password4', 'Always'); --waiter

insert into Staff
values (555666999, 'Jake', 'password5', 'Weekdays'); --chef

insert into Staff
values (486957496, 'Sara', 'password6', 'Mon'); --waiter

insert into Staff
values (444978690, 'Mike', 'password7', 'Weekend'); --waiter

insert into Staff
values (220996978, 'Eva', 'password8', 'Tues,Thurs'); --waiter

insert into Staff
values (285769686, 'Pikachu', 'password9', 'Always'); --chef

insert into Staff
values (666888777, 'Groot', 'password10', 'Always'); --chef

insert into Staff
values (334455668, 'Wolverine', 'password11', 'Always'); --chef

insert into Staff
values (229604950, 'Ironman', 'password12', 'Always'); --chef


 
insert into Restaurant
values('McDonald’s', 'American', '1980-01-01');

insert into Restaurant
values('Sushi Town', 'Japanese', '2009-09-06');

insert into Restaurant
values('Le Crocodile', 'French', '2005-03-31');

insert into Restaurant
values('Italian Kitchen', 'Italian', '1996-02-29');

insert into Restaurant
values('Peaceful', 'Chinese', '2011-11-11');


 
insert into SellsDish
values('McDonald’s', 'cheeseburger', 3, 2);

insert into SellsDish
values('Sushi Town', 'crunch roll', 6, 2);

insert into SellsDish
values('Le Crocodile', 'salad', 4, 0);

insert into SellsDish
values('Italian Kitchen', 'meatball', 4, 1);

insert into SellsDish
values('Peaceful', 'noodles', 6, 1);


 
insert into Waiter
values(222999666, 'Mon, Tues, Wed, Thurs, Fri: 8-4');

insert into Waiter
values(486957496, 'Mon: 4-8');

insert into Waiter
values(444978690, 'Sat: 4-8, Sun: 3-8');

insert into Waiter
values(220996978, 'Tues: 4-8, Thurs: 9-5');

insert into Waiter
values(444888555, 'Sat: 9-5, Sun: 9-5');


 
insert into Chef
values(555666999, 'Food safe');

insert into Chef
values(285769686, 'University of Food degree');

insert into Chef
values(666888777, 'null');

insert into Chef
values(334455668, 'Community College diploma, food safe');

insert into Chef
values(229604950, 'College diploma, food safe, university bachelors'); 
