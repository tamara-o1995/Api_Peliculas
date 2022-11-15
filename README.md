# API REST para el recurso de peliculas
Una API REST sencilla para manejar un CRUD de peliculas

## Importar la base de datos
- importar desde PHPMyAdmin (o cualquiera) database/db_cine.php


## Pueba con postman
El endpoint de la API es: http://localhost/Api_Peliculas/api/pelicula

GET
Por defecto, el GET trae todas las peliculas ordenadas por año de mayor a menor

GET/ID
http://localhost/Api_Peliculas/api/pelicula/:ID
Ej: http://localhost/Api_Peliculas/api/pelicula/10 (Nos trae la pelicula con id 10)

POST
http://localhost/Api_Peliculas/api/pelicula/
Insertamos una nueva pelicula

PUT
http://localhost/Api_Peliculas/api/pelicula/:ID
Ej: http://localhost/Api_Peliculas/api/pelicula/10 (Editamos la pelicula con id 10)

DELETE
http://localhost/Api_Peliculas/api/pelicula/:ID
Ej: http://localhost/Api_Peliculas/api/pelicula/10 (Eliminamos la pelicula con id 10)