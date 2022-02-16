select E.emp_ssn, C.case_id
From ClientCase C, Employee E
where C.dept_num = E.dept_num and E.emp_role= 'Paralegal';