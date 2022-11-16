<?php

require_once("app/models/ApiPeliculasModel.php");
require_once("app/views/ApiView.php");



class ApiPeliculasController{

    private $PeliculasView;
    private $PeliculasModel;
    private $data;

    function __construct() {
        $this->PeliculasView = new ApiView();
        $this->PeliculasModel = new ApiPeliculasModel();

        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    function showPeliculas(){
        $peliculas = $this->PeliculasModel->getPeliculas();
        return $this->PeliculasView->response($peliculas, 200);
    }

  
    public function showPelicula($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $pelicula = $this->PeliculasModel->getPelicula($id);

        // si no existe devuelvo 404
        if ($pelicula)
            $this->PeliculasView->response($pelicula);
        else 
            $this->PeliculasView->response("La pelicula con el id=$id no existe", 404);
    }
    
 
    public function insertarPelicula() {
        $pelicula = $this->getData();

        if (empty($pelicula->titulo) || empty($pelicula->duracion) || empty($pelicula->anio)|| empty($pelicula->imagen)|| empty($pelicula->sinopsis)
        || empty($pelicula->video)|| empty($pelicula->director)|| empty($pelicula->elenco)|| empty($pelicula->id_genero)) {
            $this->PeliculasView->response("Complete los datos", 400);
        } else {
            $id = $this->PeliculasModel->insertarPelicula($pelicula->titulo, $pelicula->duracion, $pelicula->anio, $pelicula->imagen, $pelicula->sinopsis, $pelicula->video, $pelicula->director, $pelicula->elenco, $pelicula->id_genero);
            $pelicula = $this->PeliculasModel->getPelicula($id);
            $this->PeliculasView->response($pelicula, 201);
        }
    }

    public function eliminarPelicula($params = null) {
        $id = $params[':ID'];

        $pelicula= $this->PeliculasModel->getPelicula($id);
        if ($pelicula) {
            $this->PeliculasModel->eliminarPelicula($id);
            $this->PeliculasView->response($pelicula);
        } else 
            $this->PeliculasView->response("La peliculas con el id=$id no existe", 404);
    }


    public function editarPelicula($params = []) {

        $id = $params[':ID'];
        $pelicula = $this->PeliculasModel->getPelicula($id);

        if($pelicula){
            $peliculaData = $this->getData();
            $this->PeliculasModel->editarPelicula($id,$peliculaData->titulo, $peliculaData->duracion, $peliculaData->anio, $peliculaData->imagen, $peliculaData->sinopsis, $peliculaData->video, $peliculaData->director, $peliculaData->elenco, $peliculaData->id_genero);
            $this->PeliculasView->response("La pelicula con el id= $id actualizada con éxito", 200);
        }
        else{
            $this->PeliculasView->response("La pelicula con el  id= $id no existe", 404);
        }
    }

}