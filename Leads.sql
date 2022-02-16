select max(emp_ssn) as emp_ssn, dept_num
from Employee 
where emp_role = 'Managing Partner'
group by dept_num