use bw_db36;

with random_dep_sorting as (
    select  client_ssn,client_name, client_street,client_city,
			client_zip,client_state,client_dob,client_phone,
    	    c.firm_id,
    	    dept_num,
            row_number() over (partition by d.dept_num order by rand()) as random_sort
    from Temp_Client c
    	left join Department d on c.firm_id = d.firm_id
),
mins as (
    select
		client_ssn,client_name, client_street,client_city,client_zip,client_state,client_dob,client_phone,
        firm_id,
        dept_num,
        min(random_sort) as min_sort
    from
        random_dep_sorting
    group by client_ssn, client_name, client_street,client_city,client_zip,client_state,client_dob,client_phone,
        firm_id,dept_num
)
select client_ssn, client_name, client_street,client_city,client_zip,client_state,client_dob,client_phone, firm_id, dept_num
from mins
order by client_ssn, firm_id



