
from http.client import CannotSendHeader
import pandas as pd
import mysql.connector  as mysql
from mysql.connector import Error

client_data = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/Clients.csv',index_col=False, delimiter = ',')
employee_data = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/Employees.csv',index_col=False, delimiter = ',')
firm_data = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/Firms.csv',index_col=False, delimiter = ',')
case_descriptions = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/CaseDescriptions.csv',index_col=False)
departments_data = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/Departments.csv',index_col=False, delimiter = ',')
case = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/CaseComplete.csv',index_col=False, delimiter = ',')
attny = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/attnywork.csv',index_col=False, delimiter = ',')
task  = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/Tasks.csv',index_col=False, delimiter = ',')
para = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/paralegal.csv',index_col=False, delimiter = ',')
lead = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/Leads.csv',index_col=False, delimiter = ',')

try:
    conn = mysql.connect(
     user = 'user36', password = '1234abcdF!', host = 'cs100.seattleu.edu', database = 'bw_db36'
    )

    if conn.is_connected():
        cursor = conn.cursor()
        
        #for x, row in firm_data.iterrows():
         #   sql = "INSERT INTO bw_db36.Firm VALUES (%s,%s,%s,%s,%s,%s,%s)"
          #  cursor.execute(sql,tuple(row))
           # conn.commit()
       
        #for dep, row in departments_data.iterrows():
         #  sql2 = "INSERT INTO bw_db36.Department VALUES(%s,%s,%s)"
          # cursor.execute(sql2,tuple(row))
           #conn.commit()

        #for y, row in client_data.iterrows():
         #   sql2 = "INSERT INTO bw_db36.Firm_Client VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
          #  cursor.execute(sql2,tuple(row))
           # conn.commit()

        #for emp, row in employee_data.iterrows():
         #   sql2 = "INSERT INTO bw_db36.Employee VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
          #  cursor.execute(sql2,tuple(row))
           # conn.commit()

       # for c, row in case.iterrows():
        #    sql = "INSERT INTO bw_db36.ClientCase VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
         #   cursor.execute(sql,tuple(row))
          #  conn.commit()
        
        #for c, row in lead.iterrows():
        #    sql = "INSERT INTO bw_db36.Leads VALUES(%s,%s)"
         #   cursor.execute(sql,tuple(row))
          #  conn.commit()

        #for c, row in task.iterrows():
         #   sql = "INSERT INTO bw_db36.Task VALUES(%s,%s,%s)"
          #  cursor.execute(sql,tuple(row))
           # conn.commit()     

        #for c, row in para.iterrows():
         #   sql = "INSERT INTO bw_db36.Paralegal_Case_Work VALUES(%s,%s,%s)"
          #  cursor.execute(sql,tuple(row))
           # conn.commit()         

        #for c, row in attny.iterrows():
         #   sql = "INSERT INTO bw_db36.Attorney_Case_Work VALUES(%s,%s,%s)"
          #  cursor.execute(sql,tuple(row))
           # conn.commit()        
        


except Error as e:
    print("Connection error", e)