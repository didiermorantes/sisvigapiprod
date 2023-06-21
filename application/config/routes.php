<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//SERVICIO DEMO
$route['API'] = 'Rest_server';

//SERVICIO PARA BO_ENO , BO_NOTICFOR, BO_VIGMOR(colectiva, individual, mortalidad) POR FILTRO ANIO MES CON CONTROLADOR GENERAL
$route['powerbi/generalcontroller/fecha_inic_anio_mes/([a-zA-Z0-9]+)'] = 'powerbi/generalcontroller/fecha_inic_anio_mes'; // GET BY fecha_inic_anio_mes

//SERVICIO PARA BO_ENO , BO_NOTICFOR, BO_VIGMOR(colectiva, individual, mortalidad)  POR EVENTO PADRE
$route['powerbi/generalcontroller/id_evento_padre_tipo/([a-zA-Z0-9]+)'] = 'powerbi/generalcontroller/id_evento_padre_tipo'; // GET BY id_evento_padre

$route['prueba/usuarios2/saludar/([a-zA-Z0-9]+)'] = 'prueba/usuarios2/saludar'; // GET BY id_evento_padre
?>