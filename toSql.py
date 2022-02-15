
import pandas as pd
import mysql.connector  as mysql
from mysql.connector import Error

client_data = pd.read_csv('Clients.csv',index_col=False, delimiter = ',')
employee_data = pd.read_csv('Employees.csv',index_col=False, delimiter = ',')
firm_data = pd.read_csv('Firms.csv',index_col=False, delimiter = ',')
case_descriptions = pd.read_csv('CaseDesciptions.csv',index_col=False, delimiter = ',')

try:
    conn = mysql.connect(
     user = 'user36', password = '1234abcdF!', host = 'cs100.seattleu.edu', databse = 'bw_db36'
    )

    if conn.is_connected():
        cursor = conn.cursor()


        for x, row in firm_data.itterrows():
            sql = "INSERT INTO bw_db36 VALUES (%s,%s,%s,%s,%s,%s,%s)"
            cursor.execute(sql,tuple(row))
            conn.commit()
        


except Error as e:
    print("Connection error", e)