import csv
import access_db

file_to_work = "files/equipos.csv"


# WORKING
def csv_read_insert(a_cnx):
    cursor = a_cnx.cursor()

    with open(file_to_work, "r", encoding='utf8') as csv_file:
        csv_reader = csv.DictReader(csv_file, delimiter=';')

        for lineCSV in csv_reader:
            add_teams = (
                "INSERT INTO equipos (nombre, ciudad, conferencia, division)" 
                "VALUES (%s, %s, %s, %s)")

            data_teams = (
                lineCSV['nombre'], lineCSV['ciudad'], lineCSV['conferencia'], lineCSV['division'])

            cursor.execute(add_teams, data_teams)

        cursor.close()
        a_cnx.commit()


if __name__ == "__main__":
    cnx = access_db.connect_db()
    csv_read_insert(cnx)
    access_db.close_db(cnx)
