use bw_db36;

with random_dep_sorting as (
    select  distinct case_id,
    	    c.dept_num,
    	    client_ssn,
            row_number() over (partition by F.client_ssn order by rand()) as random_sort
    from TempCase c
    	left join Firm_Client F on c.dept_num = F.dept_num 
	
),
cli as (
	select case_id, min(random_sort) as random_sort
    from random_dep_sorting
    group by case_id
),
results as (
select distinct r.case_id,r.client_ssn,r.dept_num
from random_dep_sorting r join cli c on r.case_id = c.case_id and r.random_sort = c.random_sort
)
select distinct case_id,dept_num,max(client_ssn)
from results
group by case_id,dept_num
order by case_id


