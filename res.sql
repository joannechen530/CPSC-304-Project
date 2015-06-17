--Initializing (drop tables)

drop table Customer;
drop table Staff;
drop table Manager;
drop table Waiter;
drop table Chef;
drop table Supervises;
drop table Restaurant;
drop table Branch_city;
drop table Branch_prov;
drop table Branch;
drop table SellsDish;
drop table WorksAt;
drop table HasWorkedAt;
drop table Visits;
drop table Review;

---------------------------------------
--Create tables

CREATE TABLE Customer
	(username CHAR(50) not null,
	phone CHAR(50) UNIQUE, 
	PRIMARY KEY (username));
 
grant select on Customer to public;
 
CREATE TABLE Staff
	(ssin INT not null,
	name CHAR(50) null,
	pw CHAR(50) null,
	availability CHAR(200) null,
	PRIMARY KEY (ssin));
 
grant select on Staff to public;

 CREATE TABLE Manager
 	(staff_ssin INT not null references staff(ssin),
	PRIMARY KEY (staff_ssin));
 	
grant select on Manager to public;

CREATE TABLE Waiter
	(staff_ssin INT not null references staff(ssin), 
	shifts CHAR(200) null,
	PRIMARY KEY(staff_ssin));
 
grant select on Waiter to public;
 
CREATE TABLE Chef
	(staff_ssin INT not null references staff(ssin),
	schedule CHAR(200) null,
	certificates CHAR(200) null,
	PRIMARY KEY(staff_ssin));
 
grant select on Chef to public;

CREATE TABLE Supervises
	(sr_sin INT not null,
	jr_sin INT not null);

grant select on Supervises to public;

CREATE TABLE Restaurant
	(name CHAR(50) not null,
	rtype CHAR(50) null,
	s_date INT null,
	PRIMARY KEY(name));

grant select on Restaurant to public;

CREATE TABLE Branch_city
	(pc CHAR(7),
	city CHAR(20),
	PRIMARY KEY (pc));
	
grant select on Branch_city to public;

CREATE TABLE Branch_prov
	(pc CHAR(7),
	province CHAR(20),
	PRIMARY KEY (pc));
		
grant select on Branch_prov to public;

CREATE TABLE Branch
	(pc CHAR(7),
	addr CHAR(50),
	s_date DATE,
	av_rating INT,
	phone CHAR(10),
	capacity INT,
	bname CHAR(20) NOT NULL,
	ssin INT NOT NULL, 
	performance INT, 
	budget INT,
	PRIMARY KEY (pc),
	FOREIGN KEY (bname) REFERENCES Restaurant (name)
  		ON DELETE CASCADE,
	FOREIGN KEY(ssin) REFERENCES Manager (staff_ssin)
  		ON DELETE CASCADE);
		
grant select on Branch to public;

CREATE TABLE SellsDish
	(rname CHAR(200) not null,
	dname CHAR(200) not null,
	price INT null,
	popularity INT null,
	PRIMARY KEY (rname, dname),
	FOREIGN KEY (rname) REFERENCES Restaurant (name) 
		ON DELETE CASCADE);
 
grant select on SellsDish to public;

CREATE TABLE WorksAt
	(ssin INT,
	pc CHAR(7),
	since INT, 
	pos CHAR(50),
	salary INT,
	PRIMARY KEY (ssin, pc),
	FOREIGN KEY (ssin) REFERENCES Staff (ssin)
  		ON DELETE CASCADE,
	FOREIGN KEY (pc) REFERENCES Branch (pc)
		ON DELETE CASCADE);
	  	
grant select on WorksAt to public;

CREATE TABLE HasWorkedAt
	(ssin INT,
	pc CHAR(7),
	sfrom INT,
	sto INT,
	pos CHAR(50),
	salary INT,
	PRIMARY KEY (ssin,pc),
	FOREIGN KEY (ssin) REFERENCES Staff (ssin)
  		ON DELETE CASCADE,
	FOREIGN KEY (pc) REFERENCES Branch (pc)
  		ON DELETE CASCADE);
  	
grant select on HasWorkedAt to public;

CREATE TABLE Visits
	(username CHAR(20),
	pc CHAR(7) NOT NULL,
	v_date INT,
	num INT,
	PRIMARY KEY(username,pc),
	FOREIGN KEY(username) REFERENCES Customer (username) ON DELETE CASCADE,
	FOREIGN KEY(pc) REFERENCES Branch (pc) ON DELETE cascade);
  		
grant select on Visits to public;
 
CREATE TABLE Review
	(username CHAR(20),
	pc CHAR(7),
	rating INT,
	p_date int,
	rcomment CHAR(300),
	PRIMARY KEY(username, pc),
	FOREIGN KEY(username) REFERENCES Customer (username) ON DELETE CASCADE,
	FOREIGN KEY(pc) REFERENCES Branch (pc) ON DELETE cascade);
		
grant select on Review to public;

--------------------------------------------
--Inserting instances

--Customer

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


--Staff
 
insert into Staff
values (165867486, 'Charlotte', 'password1', 'Mon,Tues,Fri');

insert into Staff
values (111222333, 'Bob', 'password2', 'Always'); --Manager

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

insert into Staff
values (534534999, 'Ketchup', 'password13', 'Always'); --Manager

insert into Staff
values (999999999, 'Steph', 'password14', 'Always'); --Manager

insert into Staff
values (812837478, 'Honey', 'password15', 'Always'); --Manager

insert into Staff
values (134585289, 'Sugar', 'password15', 'Always'); --Manager


--Manager 

insert into Manager
values(111222333);

insert into Manager
values(534534999);

insert into Manager
values(999999999);

insert into Manager
values(134585289);

insert into Manager
values(812837478);


--Waiter
 
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


--Chef
 
insert into Chef
values(555666999, 'Food safe', 'Mon, Tues, Wed, Thurs, Fri: 8-4');

insert into Chef
values(285769686, 'University of Food degree', 'Mon, Tues, Wed, Thurs, Fri, Sat, Sun: 8-4');

insert into Chef
values(666888777, 'null', 'Fri, Sat, Sun: 4-10');

insert into Chef
values(334455668, 'Community College diploma, food safe', 'Mon, Tues, Wed, Thurs: 4-10');

insert into Chef
values(229604950, 'College diploma, food safe, university bachelors', 'Sat, Sun: 9-5');


--Supervises

insert into Supervises
values(111222333, 334455668);

insert into Supervises
values(999999999, 222999666);

insert into Supervises
values(111222333, 220996978);

insert into Supervises
values(534534999, 555666999);

insert into Supervises
values(812837478, 229604950);


--Restaurant
 
insert into Restaurant
values('McDonald’s', 'American', 19800101);

insert into Restaurant
values('Sushi Town', 'Japanese', 20090906);

insert into Restaurant
values('Le Crocodile', 'French', 20050331);

insert into Restaurant
values('Italian Kitchen', 'Italian', 19960229);

insert into Restaurant
values('Peaceful', 'Chinese', 20111111);


--Branch

insert into Branch_city
values('V1V 1V2', 'Toast');

insert into Branch_city
values('V5E 2T2', 'Pukwana Beach');

insert into Branch_city
values('V8R 2T5', 'Indianbone');

insert into Branch_city
values('S4V 9F9', 'Telegraph');

insert into Branch_city
values('S6B 7W5', 'Grimshaw');

insert into Branch_prov
values('V1V 1V2', 'QC');

insert into Branch_prov
values('V5E 2T2', 'BC');

insert into Branch_prov
values('V8R 2T5', 'BC');

insert into Branch_prov
values('S4V 9F9', 'BC');

insert into Branch_prov
values('S6B 7W5', 'NS');

insert into Branch
values('V1V 1V2', '1010 Main Str', 20080114, 4, 6135302998, 70, 'Le Crocodile', 123123123, 4, 9999);

insert into Branch
values('V5E 2T2', '6218 Red Bay', 20030520, 5, 2342365345, 30, 'Sushi Town', 249585833, 4, 6000);

insert into Branch
values('V8R 2T5', '891 Clear Gate Acres', 20051204, 4, 3453432121, 120, 'McDonald’s', 112312332, 3, 7000);

insert into Branch
values('S4V 9F9', '742 Rustic Street', 20080821, 3, 5667778342, 240, 'Peaceful', 301929393, 3, 4000);

insert into Branch
values('S6B 7W5', '254 Thunder Rise', 2010101, 2, 1341345645, 40, 'Peaceful', 201010203, 2, 2500);


--SellsDish
 
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


--WorksAt

insert into WorksAt
values(555666999, 'V1V 1V2', 20100530, 'Chef', 15);

insert into WorksAt
values(444888555, 'V5E 2T2', 20030520, 'Waiter', 10);

insert into WorksAt
values(222999666, 'V1V 1V2', 20100530, 'Waiter', 11);

insert into WorksAt
values(165867486, 'V8R 2T5', 20051204, 'Dish Washer', 9);

insert into WorksAt
values(334455668, 'S4V 9F9', 20131010, 'Chef', 14);


--HasWorkedAt

insert into HasWorkedAt
values(334455668, 'S6B 7W5', 20100429, 20130611, 'Chef', 12);

insert into HasWorkedAt
values(220996978, 'S4V 9F9', 20090309, 20111111, 'Waiter', 10);

insert into HasWorkedAt
values(444888555, 'V1V 1V2', 20100124, 20110207, 'Waiter', 10);

insert into HasWorkedAt
values(334455668, 'V8R 2T5', 20060816, 20091210, 'Chef', 12);

insert into HasWorkedAt
values(229604950, 'S4V 9F9', 20110921, 20120101, 'Chef', 12);


--Visits

insert into Visits
values('TheEater56', 'V5E 2T2', 20120330, 4);

insert into Visits
values('TheEater56', 'V5E 2T2', 20110909, 2);

insert into Visits
values('TheEater56', 'S4V 9F9', 20140520, 3);

insert into Visits
values('CheeseBurgo', 'V8R 2T5', 20081230, 5);

insert into Visits
values('user3333', 'V1V 1V2', 20130511, 9);

insert into Visits
values('FoodieFoo', 'V1V 1V2', 20130511, 2);


--Review

insert into Review
values('TheEater56', 'V5E 2T2', 5, 20110912, 'SO GOOD OMG I LOVED IT');

insert into Review
values('user3333', 'V1V 1V2', 2, 20130511, 'Food was fantastic, but I was offended by the skirt the waitress was wearing so I’m rating it a 2.');

insert into Review
values('CheeseBurgo', 'V8R 2T5', 4, 20081230, 'Looooved the cute blonde waiter boy~');

insert into Review
values('TheEater56', 'S4V 9F9', 3, 20140601, 'it was ok');

insert into Review
values('FoodieFoo', 'V1V 1V2', 5, 20130112, 'Best. Place. Ever. Food is top notch, so tasty and full of flavor. The waitresses are also hot as hell. Would go again many times, no hesitation.');




