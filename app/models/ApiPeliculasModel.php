<?php

class ApiPeliculasModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_cine;charset=utf8', 'root', '');
    }


    /**
     * Devuelve la lista de peliculas completa.
     */
    function getPeliculas()
    {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase
        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT * FROM peliculas ORDER BY anio DESC");
        $query->execute();
         // 3. obtengo los resultados
        return  $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
    }

    public function getPelicula($id) {
        $query = $this->db->prepare("SELECT * FROM peliculas WHERE id = ?");
        $query->execute([$id]);
        $task = $query->fetch(PDO::FETCH_OBJ);
        
        return $task;
    }

    /**
     * Inserta una pelicula en la base de datos.
     */
    public function insertarPelicula($titulo, $duracion, $anio, $imagen, $sinopsis, $video, $director, $elenco, $id_genero) {
        $query = $this->db->prepare("INSERT INTO peliculas (titulo, duracion, anio, imagen, sinopsis, video, director, elenco, id_genero) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$titulo, $duracion, $anio, $imagen, $sinopsis, $video, $director, $elenco, $id_genero]);

        return $this->db->lastInsertId();
    }

    /**
     * Elimina una pelicula dado su id.
     */
    function eliminarPelicula($id) {
        $query = $this->db->prepare('DELETE FROM peliculas WHERE id = ?');
        $query->execute([$id]);
    }

        /**
     * Edita una pelicula dado su id.
     */

    public function editarPelicula( $id_pelicula, $titulo, $duracion, $anio, $imagen, $sinopsis, $video, $director, $elenco, $id_genero) {
        $query = $this->db->prepare("UPDATE peliculas SET titulo = ?, duracion = ?, anio = ?, imagen = ?, sinopsis = ?, video = ?, director = ?, elenco = ?, id_genero = ? WHERE id=?");
        $query->execute([$titulo, $duracion, $anio, $imagen, $sinopsis, $video, $director, $elenco, $id_genero, $id_pelicula]);

    }


}
