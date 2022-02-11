import csv
import access_db

file_to_work = "files/jugadores.csv"


# WORKING
def csv_read_insert(a_cnx):
    cursor = a_cnx.cursor()

    with open(file_to_work, "r", encoding='utf8') as csv_file:
        csv_reader = csv.DictReader(csv_file, delimiter=';')

        for lineCSV in csv_reader:
            add_players = (
                "INSERT INTO jugadores (codigo, nombre, procedencia, altura, peso, posicion, nombre_equipo)" 
                "VALUES (%s, %s, %s, %s, %s, %s, %s)")

            data_players = (
                lineCSV['codigo'], lineCSV['nombre'], lineCSV['procedencia'], lineCSV['altura'], lineCSV['peso'],
                lineCSV['posicion'], lineCSV['nombre_equipo'])

            cursor.execute(add_players, data_players)

        cursor.close()
        a_cnx.commit()


if __name__ == "__main__":
    cnx = access_db.connect_db()
    csv_read_insert(cnx)
    access_db.close_db(cnx)
