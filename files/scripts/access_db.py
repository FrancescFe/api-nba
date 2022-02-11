import mysql.connector
from mysql.connector import errorcode


# WORKING
def connect_db():
    cnx = None

    try:
        cnx = mysql.connector.connect(user='root', password='dbrootpass',
                                      host='add-dbms',
                                      database='nba')
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)

    return cnx


# WORKING
def close_db(cnx):
    cnx.close()

    return 0
