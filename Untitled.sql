Select C.client_ssn, D.firm_id, D.dept_num
from Firm_Client C, Department D
where (C.firm_id = D.firm_id and C.firm_id = '19-605-3360')