
import pandas as pd
import mysql.connector  as mysql
from mysql.connector import Error

client_data = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/Clients.csv',index_col=False, delimiter = ',')
employee_data = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/Employees.csv',index_col=False, delimiter = ',')
firm_data = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/Firms.csv',index_col=False, delimiter = ',')
#case_descriptions = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/CaseDescriptions.csv',index_col=False, delimiter = '\n')
departments_data = pd.read_csv('/Users/rudolph2/Desktop/CPSC3300/CPSC3300-Project/Departments.csv',index_col=False, delimiter = ',')



try:
    conn = mysql.connect(
     user = 'user36', password = '1234abcdF!', host = 'cs100.seattleu.edu', database = 'bw_db36'
    )

    if conn.is_connected():
        cursor = conn.cursor()


       
        for x, row in firm_data.iterrows():
            sql = "INSERT INTO bw_db36.Firm VALUES (%s,%s,%s,%s,%s,%s,%s)"
            cursor.execute(sql,tuple(row))
            conn.commit()
       
        for dep, row in departments_data.iterrows():
           sql2 = "INSERT INTO bw_db36.Department VALUES(%s,%s,%s)"
           cursor.execute(sql2,tuple(row))
           conn.commit()

        for y, row in client_data.iterrows():
            sql2 = "INSERT INTO bw_db36.Firm_Client VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
            cursor.execute(sql2,tuple(row))
            conn.commit()

except Error as e:
    print("Connection error", e)