
/* LOGIN */

-- Customer login - arguments(uname, password)
SELECT username
FROM Customer
WHERE username=uname AND pw=password;

-- Staff login - arguments(uname, password)
SELECT sin
FROM Staff
WHERE sin=uname AND pw=password;

-- Create account - arguments(uname, phone, password)
INSERT INTO Customer VALUES(uname, phone, password);

/* HOME */ 

-- Find the list of restaurants
SELECT name
FROM Restaurant;

-- Find the list of provinces
SELECT DISTINCT province
FROM Branch;

-- Find branches of a given restaurant - argument(restaurant)
SELECT addr, city, province
FROM Branch
WHERE name=restaurant;

-- Find restaurants that sell burgers and their branches that have the highest rating

CREATE VIEW MX 
SELECT MAX(av_rating)
FROM Branch
GROUP BY Restaurant

SELECT rname, pc
FROM Branch 
WHERE av_rating = MX rname AND rname IN (
SELECT DISTINCT rname
FROM Restaurant natural inner join SellsDish
WHERE dname like '%burger&' or dname like '%Burger%')


-- Find branches of a given restaurant with the highest rating
--  Find the most popular dish of  a restaurant




/* RESTAURANT - argument(restaurant) */

-- Get basic info of a restaurant
SELECT rname, type, s_date
FROM Restaurant
WHERE rname=restaurant;

-- Get a list of dishes that a restaurant sells
SELECT dname, price, popularity
FROM SellsDish
WHERE rname=restaurant;

-- Get a list of branches of a restauran
SELECT addr, city, province
FROM Branch
WHERE rname=restaurant;

-- Get the pc of a branch given address - argument(a, c)
SELECT pc
FROM Branch
WHERE addr=a AND city=c;

/* PROVINCE - argument(prov) */

-- Find branches in a given province
--!!! select rname???
SELECT addr, city
FROM Branch
WHERE province=prov
GROUP BY rname
ORDER BY city;

-- Get the pc of a branch given address - argument(a, c)
SELECT pc
FROM Branch
WHERE addr=a AND city=c;

/* BRANCH - argument(postalCode) */

-- Get basic info of a branch
SELECT rname, type, s_date, phone, addr, city, prov, capacity, rating
FROM Branch
WHERE pc=postalCode;

-- Get comments of a branch
SELECT rating, p_date, comments, username
FROM Reviews
WHERE pc=postalCode;

/* REVIEW - argument(postalCode) */

-- Get restaurant name and branch
SELECT rname, addr, city, province
FROM Branch
WHERE pc=postalCode;

-- Insert a review - arguments(rating, comments)
INSERT INTO Reviews VALUES(login, potalCode, rating, <date>, comments);

-- Update the average rating of a given branch when a new rating is inserted - argument(v_rpc)
UPDATE Branch
SET av_rating = (SELECT AVG(rating)
FROM Reviews
WHERE pc = v_rpc
GROUP BY pc) ;

/* MANAGER */

-- Get general staff page info → see below

-- Get branches and related info that the manager is managing 
SELECT addr, city, province, budge, performance
FROM Branch
WHERE sin=login;

-- Find staff in branches managed by the manager - arguments(sname)
SELECT name, sin    //display name, use sin to jump to staff page
FROM Staff s, WorksAt w
WHERE name=sname AND
	   s.sin=w.sin AND
	   w.pc IN (SELECT pc
		      FROM WorksAt
		      WHERE sin=login);

-- Find staff in branches managed by the manager - arguments(input_sin)
SELECT name, sin    //display name, use sin to jump to staff page
FROM Staff s, WorksAt w
WHERE s.sin=input_sin AND
	   s.sin=w.sin AND
	   w.pc IN (SELECT pc
		      FROM WorksAt
		      WHERE sin=login);

-- Find staff in branches managed by the manager - arguments(postalCode)
SELECT name, sin    //display name, use sin to jump to staff page
FROM Staff s, WorksAt w
WHERE  s.sin=w.sin AND
	   w.pc = postalCode
	   w.pc IN (SELECT pc
		      FROM WorksAt
		      WHERE sin=login);

-- List the performances of each branch/manager of a given restaurant - argument(restaurant)
SELECT performance, pc
FROM Branch
WHERE rname=restaurant
ORDER BY performance desc;

-- Find the number of visits - arguments(from, to, branch)
SELECT SUM(num)
FROM Visits
WHERE v_date>=from OR v_date<=to AND pc=branch;
--!!! How do we compare dates???

-- Add visits - arguments(phn, date, branch, ppl)
CREATE VIEW User 
SELECT uname
FROM Customer
WHERE phone=phn;
INSERT INTO Visits VALUES(User, branch, date, ppl);

/* STAFF LIST */

-- View the list of staff working at the branches managed by the manager
SELECT name
FROM Staff s, WorksAt w
WHERE s.sin=w.sin AND 
	w.pc IN (SELECT pc
		FROM WorksAt
		WHERE sin=login)
ORDER BY name;

-- View the list of staff used to work at the branches managed by the manager
SELECT name
FROM Staff s, HasWorkedAt h
WHERE s.sin=h.sin AND
	h.pc IN (SELECT pc
		FROM HasWorkedAt
		WHERE sin=login)
ORDER BY name;

ADD STAFF 



EDIT STAFF



GENERAL STAFF PAGE 



WAITER



CHEF






/*
General: 
Find the ratings of each branch
Find the branch of a restaurant with the highest rating (10)
Find all the branches or locations a restaurant has (in a specific province or city) (10)
Update the budget of branch with highest average rating (9)
Find reviews of a branch
Find a list of restaurants and look up information about a restaurant. Info includes:
restaurant name, type, 
a list of dishes and corresponding prices and popularity
Find a list of branches given a restaurant and look up information about a branch, including:
branch addr, phone, capacity, rating, reviews
Find restaurants in a given location (province (and city))
then find branches 
Find branches of restaurants they have visited
Find restaurants that sell burgers and their branches that have the highest rating
Find branches of a given restaurant with the highest rating
Find the most popular dish of  a restaurant




Customers:
Write reviews of different branches
update their phone number
//
edit their reviews of a branch posted on a given date


Managers:
Look up the availability of the staff and assign schedules accordingly
Find the background and work history of the staff
Look up the budget assigned of the month
everything other staff can do 
add customer records (on which date did they visit which restaurant/branch)
change names of staff
view a list of people who have worked at a branch/restaurant
and related information
view a list of positions that a staff has worked as
and the related information
update waiter shifts and chef schedules
update budget and performance 
Find the most popular dishes of a restaurant in a region (city or province)
Find and count all the users that have visited a branch on a specific day
Look up information of staff
Find and compare the performances of other managers of a given restaurant

//
delete staff whose pay is higher than the average
set the salary of the staff whose pay is higher than the average to be the average
transfer all the staff members that have worked at a specific branch but no longer work there to that branch in their current positions
Find the waiter with the highest pay and make him supervise all the other waiters
Waiters:
Look up their shifts (schedules) and salaries
add customer records (on which date did they visit which restaurant/branch)

Chefs:
Update their certificates
look up their schedule

Staff
(change their own pw)
look up their supervisor and who they are supervising
view and update their availability

Transitions:
Look up position and generate unique pages
Sign up for an account 
*/



