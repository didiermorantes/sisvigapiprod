<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Generalcontroller extends REST_Controller {
    // para suprimir errores de php
    public $db;
    public $format;
    public $auth_override;
    public $Generalmodel;
    // para suprimir errores de php


    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('powerbi/Generalmodel');
    }


    public function index_get(){
        $this->response([
            'STATUS' => FALSE,
            'MESSAGE' => 'Proporcione un endpoint completo '
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    }
    




    public function fecha_inic_anio_mes_get() {

        $fecha_inic = $this->get('fecha');


        if ($fecha_inic === null) {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Error en el URL'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        if ($fecha_inic === "") {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'fecha no ingresada'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        } else {

                    if($fecha_inic != '' || $fecha_inic != null ){
                        $fecha_inic_limpio = trim($fecha_inic);
                        $separador = '-';
                        // explode produce un arreglo

                        $stringSeparado = explode($separador, $fecha_inic_limpio);
                        //COL-2022-05, de acuerdo con este formato proporcionado por Edison

                        $tipo = $stringSeparado[0];
                        $anio = $stringSeparado[1];
                        $mes = $stringSeparado[2];




                        if($tipo == 'COL'){
                            // NOTIFICACION COLECTIVA, HACIA LA VISTA VIEW_BO_ENO
                            $dat = $this->Generalmodel->getData_VIEW_BO_ENO_fechaInic_anio_mes($anio, $mes);
                        

                            if ($dat) {
    
    
                                $this->response([
                                    'STATUS' => TRUE,
                                    'MESSAGE' => 'datos encontrados',
                                    "DATA" => $dat
                                        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    
                            } else {
                                $this->response([
                                    'STATUS' => FALSE,
                                    'MESSAGE' => 'datos no encontrados por fecha_inic',
                                    'fecha_inic' => $fecha_inic_limpio
                                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                            }


                        }
                        else if($tipo == 'IND'){
                            // NOTIFICACION INDIVIDUAL, HACIA LA VISTA VIEW_BO_NOTIC_FORM
                            $dat = $this->Generalmodel->getData_VIEW_BO_NOTICFORM_fechaInic_anio_mes($anio, $mes);
                        

                            if ($dat) {
    
    
                                $this->response([
                                    'STATUS' => TRUE,
                                    'MESSAGE' => 'datos encontrados',
                                    "DATA" => $dat
                                        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    
                            } else {
                                $this->response([
                                    'STATUS' => FALSE,
                                    'MESSAGE' => 'datos no encontrados por fecha_calculada',
                                    'fecha_calculada' => $fecha_inic_limpio
                                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                            }

                        }
                        else if($tipo == 'MOR'){
                            // NOTIFICACION MORTALIDAD, HACIA LA VISTA VIEW_BO_VIGMOR
                            $dat = $this->Generalmodel->getData_VIEW_BO_VIGMOR_fechaInic_anio_mes($anio, $mes);
                        

                            if ($dat) {
    
    
                                $this->response([
                                    'STATUS' => TRUE,
                                    'MESSAGE' => 'datos encontrados',
                                    "DATA" => $dat
                                        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
    
                            } else {
                                $this->response([
                                    'STATUS' => FALSE,
                                    'MESSAGE' => 'datos no encontrados por fecha_defuncion',
                                    'fecha_defuncion' => $fecha_inic_limpio
                                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                            }
                        }
                        else{
                            // NO HAY UN PREFIJO DE NOTIFICACIÓN VÁLIDO
                            $this->response([
                                'STATUS' => FALSE,
                                'MESSAGE' => 'no existe notificacion con tipo proporcionado',
                                'tipo' => $tipo
                                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                        }
                        





                    }
                    else{
                        $this->response([
                            'STATUS' => FALSE,
                            'MESSAGE' => 'fecha no ingresada correctamente con formato TIPO-AÑO-MES'
                                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code 
                    }



    }

    }




    public function id_evento_padre_tipo_get() {
        $id_evento_padre = $this->get('id');


        if ($id_evento_padre === null) {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Error en el URL'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        if ($id_evento_padre === "") {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'id evento padre no ingresado'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        } else {

            // si hay id_evento_padre lo limpiamos y consultamos. Hacemos segunda validacion porque a veces no toma bien la primera validacion
            if($id_evento_padre!= '' || $id_evento_padre != null ){


            $id_evento_padre_con_espacio = urldecode($id_evento_padre);

            $id_evento_padre_limpio = trim($id_evento_padre_con_espacio);
        
            $separador = '-';


            $stringSeparado = explode($separador, $id_evento_padre_limpio);
            //COL-14, de acuerdo con este formato proporcionado por Edison
            /*
            1- IAPS- EFECTOS TOXICOS Y OTRAS CAUSAS EXTERNAS
            2- ENF.INFL.SNC - ENFERMEDADES INFLAMATORIAS DEL SISTEMA NERVIOSO
            3- ENF.INMUNOPREV - ENFERMEDADES PREVENIBLES POR VACUNA
            4- ETA - ENFERMEDADES TRANSMITIDAS POR ALIMENTOS
            5- VECTORES - ENFERMEDADES TRANSMITIDAS POR VECTORES
            6- HELMINTIASIS - HELMINTIASIS
            7- IAAS - IAAS
            8- ITS - INFECCIONES TRANSMISION SEXUAL
            9- INF RESP - INFECCIONES RESPIRATORIAS
            10- M.INF - MUERTE INFANTIL
            11- O.TRAUMAS - OTRAS CAUSAS DE TRAUMATISMO
            12- O.EVE - OTROS EVENTOS
            13- SIND - SINDROMES
            14- V.INTRAF - VIOLENCIA INTRAFAMILIAR
            15- ZOONOSIS - ZOONOSIS
            */

            $tipo = $stringSeparado[0];
            $id_evento_padre = $stringSeparado[1];
            $nombre_evento_padre = '';

            // evaluamos el id del evento padre para proporcionar el parametro correcto en la consulta
            switch($id_evento_padre){
                case '1':
                    $nombre_evento_padre = 'EFECTOS TÓXICOS Y OTRAS CAUSAS EXTERNAS DE ENVENENAMIENTO';
                    break;
                case '2':
                    $nombre_evento_padre = 'ENFERMEDADES INFLAMATORIAS DEL SISTEMA NERVIOSO CENTRAL';
                    break;
                case '3':
                    $nombre_evento_padre = 'ENFERMEDADES PREVENIBLES POR VACUNA';
                    break;
                case '4':
                    $nombre_evento_padre = 'ENFERMEDADES TRANSMITIDAS POR ALIMIENTOS';
                    break;
                case '5':
                    $nombre_evento_padre = 'ENFERMEDADES TRANSMITIDAS POR VECTORES';
                    break;
                case '6':
                    $nombre_evento_padre = 'HELMINTIASIS';
                    break;
                case '7':
                    $nombre_evento_padre = 'IAAS';
                    break;
                case '8':
                    $nombre_evento_padre = 'INFECCIONES DE TRANSMISIÓN SEXUAL';
                    break;
                case '9':
                    $nombre_evento_padre = 'INFECCIONES RESPIRATORIAS';
                    break;
                case '10':
                    $nombre_evento_padre = 'MUERTE INFANTIL';
                    break;
                case '11':
                    $nombre_evento_padre = 'OTRAS CAUSAS DE TRAUMATISMO';
                    break;
                case '12':
                    $nombre_evento_padre = 'OTROS EVENTOS';
                    break;
                case '13':
                    $nombre_evento_padre = 'SINDROMES';
                    break;
                case '14':
                    $nombre_evento_padre = 'VIOLENCIA INTRAFAMILIAR';
                    break;
                case '15':
                    $nombre_evento_padre = 'ZOONOSIS';
                    break;
                default:
                    $nombre_evento_padre = '';
            }



            if($tipo =='COL'){


                $dat = $this->Generalmodel->getDataIdEventoPadre_VIEW_BO_ENO($nombre_evento_padre);

                if ($dat) {
                    $this->response([
                        'STATUS' => TRUE,
                        'MESSAGE' => 'datos encontrados',
                        "DATA" => $dat
                            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    $this->response([
                        'STATUS' => FALSE,
                        'MESSAGE' => 'datos no encontrados por id_evento_padre',
                        'id_evento_padre' => $id_evento_padre,
                        'nombre_evento_padre' => $nombre_evento_padre
                            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }



            }
            else if($tipo =='IND'){

                $dat = $this->Generalmodel->getDataIdEventoPadre_VIEW_BO_NOTICFORM($nombre_evento_padre);

                if ($dat) {
                    $this->response([
                        'STATUS' => TRUE,
                        'MESSAGE' => 'datos encontrados',
                        "DATA" => $dat
                            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    $this->response([
                        'STATUS' => FALSE,
                        'MESSAGE' => 'datos no encontrados por id_evento_padre',
                        'id_evento_padre' => $id_evento_padre,
                        'nombre_evento_padre' => $nombre_evento_padre
                            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }



            }
            else if($tipo =='MOR'){
                
                $dat = $this->Generalmodel->getDataIdEventoPadre_VIEW_BO_VIGMOR($nombre_evento_padre);

                if ($dat) {
                    $this->response([
                        'STATUS' => TRUE,
                        'MESSAGE' => 'datos encontrados',
                        "DATA" => $dat
                            ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    $this->response([
                        'STATUS' => FALSE,
                        'MESSAGE' => 'datos no encontrados por id_evento_padre',
                        'id_evento_padre' => $id_evento_padre,
                        'nombre_evento_padre' => $nombre_evento_padre
                            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }

            }
            else{
                // NO HAY UN PREFIJO DE NOTIFICACIÓN VÁLIDO
                $this->response([
                    'STATUS' => FALSE,
                    'MESSAGE' => 'no existe notificacion con tipo proporcionado',
                    'tipo' => $tipo
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }

        }else{
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'id_evento_padre no fue ingresado correctamente con formato TIPO-id_evento_padre'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code 

        }



    }

    }





}
?>