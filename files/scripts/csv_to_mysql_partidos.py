import csv
import access_db

file_to_work = "files/partidos.csv"


# WORKING
def csv_read_insert(a_cnx):
    cursor = a_cnx.cursor()

    with open(file_to_work, "r", encoding='utf8') as csv_file:
        csv_reader = csv.DictReader(csv_file, delimiter=';')

        for lineCSV in csv_reader:
            add_matches = (
                "INSERT INTO partidos (codigo, equipo_local, equipo_visitante, puntos_local, "
                "puntos_visitante, temporada)" 
                "VALUES (%s, %s, %s, %s, %s, %s)")

            data_matches = (
                lineCSV['codigo'], lineCSV['equipo_local'], lineCSV['equipo_visitante'], lineCSV['puntos_local'],
                lineCSV['puntos_visitante'], lineCSV['temporada'])

            cursor.execute(add_matches, data_matches)

        cursor.close()
        a_cnx.commit()


if __name__ == "__main__":
    cnx = access_db.connect_db()
    csv_read_insert(cnx)
    access_db.close_db(cnx)
