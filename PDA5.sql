use bw_db36;

# This select gets the names of five lawyers names 
# the case id's of the case they are working on.

select E.emp_ssn, C.case_id
from Employee E, ClientCase C
where E.emp_ssn = C.litigating_attny
limit 5;

#This Query Gets the name, SSN,and hours worked of a five paralegals
#and the case_Id of the case they worked that number of hours on ordered by case_Id
#

select e.emp_ssn, e.emp_name, p.case_id, p.hrs
from Employee e
	join Paralegal_Case_Work p on e.emp_ssn = p.emp_ssn
order by case_id
limit 5;

#This is a nested query that gets the ssn and  names of lawyers working on 
#cases that mention coffee in the case description
Select E.emp_ssn, E.emp_name
From Employee E
where E.emp_ssn IN (Select C.litigating_attny
					From ClientCase C
                    where matter_description Like '%coffee%')
limit 5;

#Corrleated nested query to find lawyers,  who have worked less than 
# the average number of hours for lawyer work  on a single case
#ordered by the number of hours 
Select E.emp_ssn, E.emp_name, W.hrs
From Employee E, Attorney_Case_Work W
Where E.emp_ssn = W.emp_ssn And W.hrs < (Select AVG(hrs)
										 From Attorney_Case_Work)
order by W.hrs
limit 5;

#This finds names, ssn,  and date of birth, and sum of  hours worked by
#Managing Attorneys (who lead departments) 
#that have worked more than 5000 hours on cases
Select E.emp_ssn, E.emp_name, E.emp_dob,SUM(W.hrs)
From Employee E
	join Attorney_Case_Work W on E.emp_ssn = W.emp_ssn
		join Leads L on W.emp_ssn = L.emp_ssn
group by E.emp_ssn
having SUM(W.hrs) >5000
limit 5;


#inserts a new firm 
INSERT INTO Firm
VALUES (23-673-7754,'Brandybuck, Baggins, Gamgee' ,'5 Bagshot Row','Hobbiton','The Shire',98298,9384618378);

INSERT INTO Department
VALUES 
(23-673-7754,7754-100,'Bankruptcy'),
(23-673-7754,7754-104,'Environmental'),
(23-673-7754,7754-114,'Real Estate'),
(23-673-7754,7754-122,'Corporate'),
(23-673-7754,7754-102,'Real Estate'),
(23-673-7754,7754-110,'Personal Injury'),
(23-673-7754,7754-104,'Bankruptcy'),
(23-673-7754,7754-112,'Elder');
