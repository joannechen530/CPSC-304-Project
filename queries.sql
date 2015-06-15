
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
-- FOR CUSTOMERS ONLY. STAFF CAN ONLY BE ADDED BY SOMEONE ELSE.
INSERT INTO Customer VALUES(uname, phone, password);

/* GENERAL */ 

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

-- Find the most highly rated restaurants that sell a specific dish (e.g. burger) - argument(dish)
CREATE VIEW PlacesWithDish 
SELECT DISTINCT rname
FROM Restaurant natural inner join SellsDish
WHERE dname like '%dish&';

SELECT rname, pc
FROM Branch 
WHERE rname in PlacesWithDish AND 
      av_rating = (SELECT MAX(av_rating)
		   FROM Branch
		   GROUP BY rname
		   HAVING rname IN PlacesWithDish);

-- Find branches of a given restaurant with the highest rating - argument(restaurant)
SELECT pc
FROM Branch b1
WHERE rname = restaurant 
	AND NOT EXIST (SELECT *
		    FROM Branch b2
		    WHERE b1.rating < b2.rating);

		  
--  Find the most popular dish of a restaurant - argument(retaurant)
SELECT dname
FROM SellsDish sd1
WHERE rname = restaurant 
	AND NOT EXIST (SELECT *
	FROM SellsDish sd2
	WHERE sd1.popularity < sd2.popularity)

/* RESTAURANT - argument(restaurant) */

-- Get basic info of a restaurant
SELECT rname, type, s_date
FROM Restaurant
WHERE rname=restaurant;

-- Get a list of dishes that a restaurant sells
SELECT dname, price, popularity
FROM SellsDish
WHERE rname=restaurant;

-- Get a list of branches of a restaurant
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

-- Add staff - argument(v_sin, v_pw, v_name, avail, curr_date, v_pc, v_pos, v_salary)
INSERT INTO Staff VALUES(v_sin, avail, v_name, v_pw);
INSERT INTO WorksAt VALUES(v_sin, v_pc, curr_date, v_pos, v_salary);
-- if adding a waiter - argument(v_shifts)
INSERT INTO Waiter VALUES (v_sin, v_shifts);
-- if adding a chef - argument(v_schedule, v_certificates)
INSERT INTO Chef VALUES(v_sin, v_schedule, v_certificates);


/* EDIT STAFF */

-- Update shifts - argument(v_sin, v_shifts)
UPDATE Waiter
SET shifts = v_shifts
WHERE sin = v_sin;

-- Update schedule - arguments(v_sin, v_schedule)
UPDATE Chef
SET schedule = v_schedule
WHERE sin = v_sin;

-- Update certificates - arguments(v_sin, v_certificates)
-- REMEMBER TO APPEND ORIGINAL CERTIFICATES TO THE NEW ONE (INPUT)
UPDATE Chef
SET certificates = v_certificates
WHERE sin = v_sin

-- Remove a manager from a branch

-- Move a manager to a different branch and (new_manager, old_manager, from_branch, to_branch)
UPDATE Branch
SET sin = old_manager
WHERE pc = to_branch
-- Replace him with someone else
UPDATE Branch
SET sin = new_manager
WHERE pc = from_branch


UPDATE Branch
SET sin = v_manager
WHERE pc = to_branch

-- Add a branch to a manager (v_manage, v_branch)





/* GENERAL STAFF PAGE */

-- Get basic info: sin, name, availability, pos, start date, salary - argument(v_sin)
SELECT name, sin, availability, since, pos, salary
FROM Staff natural inner join WorksAt
WHERE sin = v_sin;

-- Update password - argument(new_pw, v_sin)
UPDATE Staff 
SET pw = new_pw
WHERE sin = v_sin;

-- Update availability - argument(avail, v_sin)
UPDATE Staff
SET availability = avail
WHERE sin = v_sin;

-- Look up name supervisor - argument(v_sin)
SELECT name;
FROM Supervises, Staff
WHERE sr_sin = sin AND jr_sin = v_sin;

-- Look up staff members that an employee is supervizing - argument(v_sin)
SELECT name;
FROM Supervises, Staff
WHERE jr_sin = sin AND sr_sin = v_sin;


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


