
use bw_db36;

drop table if exists Attorney_Case_Work;
drop table if exists Paralegal_Case_Work;
drop table if exists Leads;
drop table if exists ClientCase;
drop table if exists Employee;
drop table if exists Firm_Client;
drop table if exists Department;
drop table if exists Firm;


Create Table Firm(
	firm_id CHAR(9),
    firm_name VARCHAR(50),
    firm_street VARCHAR(20),
    firm_city VARCHAR(20),
    firm_state VARCHAR(20),
    firm_zip int(5),
    firm_phone int(9),
    Primary key (firm_id)
) ;   

CREATE Table Department(
	dept_num CHAR(3), 
    dept_name VARCHAR(20),
    firm_id CHAR(9),
	primary key (dept_num),
	foreign key (firm_id) 
		references Firm (firm_id)
        On delete Cascade on Update Cascade
);

CREATE Table Firm_Client(
	client_ssn  CHAR(11),
    client_name VARCHAR(50) not null,
    clinet_phone CHAR(10),
    client_street VARCHAR(20),
    client_city VARCHAR(20),
    client_state VARCHAR(20),
    client_zip int(5),
    firm_id CHAR(9),
    dept_num CHAR(3),
    primary key (client_ssn),
	foreign key (firm_id) 
		references Firm (firm_id)
        On delete Cascade on Update Cascade
);

CREATE Table Employee(
	emp_ssn  CHAR(11),
    emp_name VARCHAR(50) not null,
    emp_phone CHAR(10),
    emp_street VARCHAR(20),
    emp_city VARCHAR(20),
    emp_state VARCHAR(20),
    emp_zip int(5),
    emp_dob DATE,
    emp_role VARCHAR(20),
	CONSTRAINT chk_role CHECK (emp_role
		In('Partner','Managing Partner','Associate','Legal Secretary','Paralegal')),
    dept_num CHAR(3),
    primary key (emp_ssn),
	foreign key (dept_num) 
		references Department (dept_num)
        On delete set null on update cascade
		
);



CREATE TABLE ClientCase(
	case_id CHAR(6),
    client_ssn CHAR(11),
    dept_num CHAR(3), 
    stateofcase VARCHAR(20),
    handling_attny CHAR(9),
	CONSTRAINT chk_state CHECK (stateofcase IN('in_court','in_progress', 'resolved')),
    matter_description VARCHAR(1000),
    court_rules VARCHAR(50),
    ruling VARCHAR(20),
    judge VARCHAR(20),
    litigating_attny CHAR(11),
    primary key (case_id),
    foreign key (dept_num) references Department (dept_num)
		On delete set null on update cascade,
    foreign key (client_ssn) references Firm_Client (client_ssn )
    		On delete set null on update cascade,
    foreign key (handling_attny) references Employee (emp_ssn)
    		On delete set null on update cascade,
	foreign key (litigating_attny) references Employee(emp_ssn)
    		On delete set null on update cascade
);


CREATE TABLE Leads(
	emp_ssn CHAR(11),
    dept_num CHAR(3),
    primary key (emp_ssn,dept_num),
    foreign key (dept_num) references Department (dept_num),
    foreign key (emp_ssn) references Employee(emp_ssn)
);

CREATE TABLE Task(
	task_id CHAR(9),
    case_id CHAR(6),
    task_description VARCHAR(100),
	primary key (task_id,case_id),
    foreign key (case_id) references ClientCase(case_id)
);

CREATE TABLE Paralegal_Case_Work(
	emp_ssn CHAR(11),
    case_id CHAR(6),
    hrs int(4),
	primary key (emp_ssn,case_id),
    foreign key (emp_ssn) references Employee (emp_ssn),
    foreign key (case_id) references ClientCase(case_id)
);

CREATE TABLE Attorney_Case_Work(
    emp_ssn CHAR(11),
    case_id CHAR(6),
    hrs int(4),
	primary key (emp_ssn,case_id),
    foreign key (emp_ssn) references Employee (emp_ssn),
    foreign key (case_id) references ClientCase(case_id)
);






    