<?php
require_once('libs/Router.php');
require_once('app/controllers/ApiPeliculasController.php');

// creo el router/instancia
$router = new Router();

// defino la tabla de ruteo
$router->addRoute("pelicula", "GET", "ApiPeliculasController", "showPeliculas");
$router->addRoute("pelicula/:ID", "GET", "ApiPeliculasController", "showPelicula");
$router->addRoute("pelicula", "POST", "ApiPeliculasController", "insertarPelicula");
$router->addRoute("pelicula/:ID", "PUT", "ApiPeliculasController", "editarPelicula");
$router->addRoute("pelicula/:ID", "DELETE", "ApiPeliculasController", "eliminarPelicula");

// ejecuto la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);