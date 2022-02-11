import csv
import access_db

file_to_work = "files/estadisticas.csv"


# WORKING
def csv_read_insert(a_cnx):
    cursor = a_cnx.cursor()

    with open(file_to_work, "r", encoding='utf8') as csv_file:
        csv_reader = csv.DictReader(csv_file, delimiter=';')

        for lineCSV in csv_reader:
            add_stats = (
                "INSERT INTO estadisticas (temporada, jugador, puntos_por_partido, asistencias_por_partido, "
                "tapones_por_partido, rebotes_por_partido)" 
                "VALUES (%s, %s, %s, %s, %s, %s)")

            data_stats = (
                lineCSV['temporada'], lineCSV['jugador'], lineCSV['puntos_por_partido'],
                lineCSV['asistencias_por_partido'], lineCSV['tapones_por_partido'], lineCSV['rebotes_por_partido'])

            cursor.execute(add_stats, data_stats)

        cursor.close()
        a_cnx.commit()


if __name__ == "__main__":
    cnx = access_db.connect_db()
    csv_read_insert(cnx)
    access_db.close_db(cnx)
