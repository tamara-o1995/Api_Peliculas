<?php
require_once('libs/Router.php');
require_once('app/controllers/ApiPeliculasController.php');

// crea el router
$router = new Router();

// define la tabla de ruteo

$router->addRoute("pelicula", "GET", "ApiPeliculasController", "showPeliculas");
$router->addRoute("pelicula/:ID", "GET", "ApiPeliculasController", "showPelicula");
$router->addRoute("pelicula", "POST", "ApiPeliculasController", "insertarPelicula");
$router->addRoute("pelicula/:ID", "PUT", "ApiPeliculasController", "editarPelicula");
$router->addRoute("pelicula/:ID", "DELETE", "ApiPeliculasController", "eliminarPelicula");

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);