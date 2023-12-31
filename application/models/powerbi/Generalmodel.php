<?php

defined('BASEPATH') or exit('No direct script access allowed') ;

class Generalmodel extends CI_Model{

    

    public function __construct () {
        parent::__construct();
        $this->load->database();
    }






    public function getDataIdEventoPadre_VIEW_BO_ENO($id_evento_padre) {

                // SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento FROM BO_ENO eno WHERE eno.id_evento_padre='INFECCIONES RESPIRATORIAS' ;
                $select = "SELECT view_eno.id_un, view_eno.fecha_inic, view_eno.id_evento_padre, view_eno.id_grupo, view_eno.id_rango, view_eno.`COUNT(numero_casos)` ";
                $from = "FROM VIEW_BO_ENO view_eno ";
                // el id_evento_padre necesita comillas porque es string
                $where = "WHERE view_eno.id_evento_padre= '" . $id_evento_padre . "'";
        
        
                $sql = $select . $from . $where;   
                $cadena  = '';
        
                $query = $this->db->query($sql);
        
                if ($query->num_rows() > 0) {
        
                foreach ($query->result() as $row) {
                    $view_bo_eno_data[] = [
                        'id_un' => $row->id_un,
                        'fecha_inic' => $row->fecha_inic,
                        'id_evento_padre' => $row->id_evento_padre,
                        'id_grupo' => $row->id_grupo,
                        'id_rango' => $row->id_rango,
                        // Es necesario utilizar la notación de llaves porque el nombre de la propiedad es compuesto y posee nombres de funcions
                        'COUNT(numero_casos)' => $row->{'COUNT(numero_casos)'}
                    ];
                }
        
                
                return $view_bo_eno_data;
        
                } else {
                    return false ;
                }
            }


     public function getDataIdEventoPadre_VIEW_BO_NOTICFORM($id_evento_padre) {

                        // SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento FROM BO_ENO eno WHERE eno.id_evento_padre='INFECCIONES RESPIRATORIAS' ;
                        $select = "SELECT view_ind.id_grupo, view_ind.id_evento_padre, view_ind.tipo_caso_calculado, view_ind.sexo, view_ind.id_rango, view_ind.id_un, view_ind.fecha_calculada, view_ind.id_corregimiento_calculado, view_ind.`COUNT(numero_casos)` ";
                        $from = "FROM VIEW_BO_NOTICFORM view_ind ";
                        // el id_evento_padre necesita comillas porque es string
                        $where = "WHERE view_ind.id_evento_padre= '" . $id_evento_padre . "'";
                
                
                        $sql = $select . $from . $where;   
                        $cadena  = '';
                
                
                        $query = $this->db->query($sql);
                
                        if ($query->num_rows() > 0) {
                
                        foreach ($query->result() as $row) {
                            $view_bo_noticform_data[] = [
                                'id_grupo' => $row->id_grupo,
                                'id_evento_padre' => $row->id_evento_padre,
                                'tipo_caso_calculado' => $row->tipo_caso_calculado,
                                'sexo' => $row->sexo,
                                'id_rango' => $row->id_rango,
                                'id_un' => $row->id_un,
                                'fecha_calculada' => $row->fecha_calculada,
                                'id_corregimiento_calculado' => $row->id_corregimiento_calculado,
                                // Es necesario utilizar la notación de llaves porque el nombre de la propiedad es compuesto y posee nombres de funcions
                                'COUNT(numero_casos)' => $row->{'COUNT(numero_casos)'}
                
                            ];
                        }
                
                        return $view_bo_noticform_data;
                
                        } else {
                            return false ;
                        }
        }


public function getDataIdEventoPadre_VIEW_BO_VIGMOR($id_evento_padre) {
            
                    // SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento FROM BO_ENO eno WHERE eno.id_evento_padre='INFECCIONES RESPIRATORIAS' ;
                    $select = "SELECT view_mor.id_grupo, view_mor.id_evento_padre, view_mor.tipo_caso_calculado, view_mor.sexo, view_mor.id_rango, view_mor.id_un, view_mor.fecha_defuncion, view_mor.id_corregimiento_calculado, view_mor.`COUNT(numero_casos)` ";
                    $from = "FROM VIEW_BO_VIGMOR view_mor ";
                    // el id_evento_padre necesita comillas porque es string
                    $where = "WHERE view_mor.id_evento_padre= '" . $id_evento_padre . "'";
            
            
                    $sql = $select . $from . $where;   
                    $cadena  = '';
            
            
                    $query = $this->db->query($sql);
            
                    if ($query->num_rows() > 0) {
            
                    foreach ($query->result() as $row) {
                        $view_bo_vigmor_data[] = [
                            'id_grupo' => $row->id_grupo,
                            'id_evento_padre' => $row->id_evento_padre,
                            'tipo_caso_calculado' => $row->tipo_caso_calculado,
                            'sexo' => $row->sexo,
                            'id_rango' => $row->id_rango,
                            'id_un' => $row->id_un,
                            'fecha_defuncion' => $row->fecha_defuncion,
                            'id_corregimiento_calculado' => $row->id_corregimiento_calculado,
                            // Es necesario utilizar la notación de llaves porque el nombre de la propiedad es compuesto y posee nombres de funcions
                            'COUNT(numero_casos)' => $row->{'COUNT(numero_casos)'}
            
                        ];
                    }
            
                    return $view_bo_vigmor_data;
            
                    } else {
                        return false ;
                    }
    }




    public function getData_VIEW_BO_ENO_fechaInic_anio_mes($anio, $mes) {

                // SELECT view_eno.id_un, view_eno.fecha_inic, view_eno.id_evento_padre, view_eno.id_grupo, view_eno.id_rango, view_eno.`COUNT(numero_casos)` FROM VIEW_BO_ENO view_eno WHERE MONTH(view_eno.fecha_inic)= 2 AND YEAR(view_eno.fecha_inic)= 2018;

                $select = "SELECT view_eno.id_un, view_eno.fecha_inic, view_eno.id_evento_padre, view_eno.id_grupo, view_eno.id_rango, view_eno.`COUNT(numero_casos)` ";
                $from = "FROM VIEW_BO_ENO view_eno ";
                $where = "WHERE MONTH(view_eno.fecha_inic)= '" . $mes . "' AND YEAR(view_eno.fecha_inic)= '" .$anio. "' ";

        
                $sql = $select . $from . $where;   
                $cadena  = '';
        
        
                $query = $this->db->query($sql);
        
                if ($query->num_rows() > 0) {
        
                foreach ($query->result() as $row) {
                    $view_bo_eno_data[] = [
                        'id_un' => $row->id_un,
                        'fecha_inic' => $row->fecha_inic,
                        'id_evento_padre' => $row->id_evento_padre,
                        'id_grupo' => $row->id_grupo,
                        'id_rango' => $row->id_rango,
                        'COUNT(numero_casos)' => $row->{'COUNT(numero_casos)'}
        
                    ];
                }
        
                return $view_bo_eno_data;
        
                } else {
                    return false ;
                }
            }




    public function getData_VIEW_BO_NOTICFORM_fechaInic_anio_mes($anio, $mes) {

                        // SELECT view_ind.id_grupo, view_ind.id_evento_padre, view_ind.tipo_caso_calculado, view_ind.sexo, view_ind.id_rango, view_ind.id_un, view_ind.fecha_calculada, view_ind.id_corregimiento_calculado, view_ind.`COUNT(numero_casos)` FROM VIEW_BO_NOTICFORM view_ind WHERE MONTH(view_ind.fecha_calculada)= 2 AND YEAR(view_ind.fecha_calculada)= 2018;
                        $select = "SELECT view_ind.id_grupo, view_ind.id_evento_padre, view_ind.tipo_caso_calculado, view_ind.sexo, view_ind.id_rango, view_ind.id_un, view_ind.fecha_calculada, view_ind.id_corregimiento_calculado, view_ind.`COUNT(numero_casos)` ";
                        $from = "FROM VIEW_BO_NOTICFORM view_ind ";
                        $where = "WHERE MONTH(view_ind.fecha_calculada)= '" . $mes . "' AND YEAR(view_ind.fecha_calculada)= '" .$anio. "' ";

                
                        $sql = $select . $from . $where;   
                        $cadena  = '';
                
                
                        $query = $this->db->query($sql);
                
                        if ($query->num_rows() > 0) {
                
                        foreach ($query->result() as $row) {
                            $view_bo_noticform_data[] = [
                                'id_grupo' => $row->id_grupo,
                                'id_evento_padre' => $row->id_evento_padre,
                                'tipo_caso_calculado' => $row->tipo_caso_calculado,
                                'sexo' => $row->sexo,
                                'id_rango' => $row->id_rango,
                                'id_un' => $row->id_un,
                                'fecha_calculada' => $row->fecha_calculada,
                                'id_corregimiento_calculado' => $row->id_corregimiento_calculado,
                                'COUNT(numero_casos)' => $row->{'COUNT(numero_casos)'}
                
                            ];
                        }
                
                        return $view_bo_noticform_data;
                
                        } else {
                            return false ;
                        }
                    }


    public function getData_VIEW_BO_VIGMOR_fechaInic_anio_mes($anio, $mes) {

                                // SELECT view_mor.id_grupo, view_mor.id_evento_padre, view_mor.tipo_caso_calculado, view_mor.sexo, view_mor.id_rango, view_mor.id_un, view_mor.fecha_defuncion, view_mor.id_corregimiento_calculado, view_mor.`COUNT(numero_casos)` FROM VIEW_BO_VIGMOR view_mor WHERE MONTH(view_mor.fecha_defuncion)= 2 AND YEAR(view_mor.fecha_defuncion)= 2023;
                                $select = "SELECT view_mor.id_grupo, view_mor.id_evento_padre, view_mor.tipo_caso_calculado, view_mor.sexo, view_mor.id_rango, view_mor.id_un, view_mor.fecha_defuncion, view_mor.id_corregimiento_calculado, view_mor.`COUNT(numero_casos)` ";
                                $from = "FROM VIEW_BO_VIGMOR view_mor ";
                                $where = "WHERE MONTH(view_mor.fecha_defuncion)= '" . $mes . "' AND YEAR(view_mor.fecha_defuncion)= '" .$anio. "' ";

                        
                                $sql = $select . $from . $where;   
                                $cadena  = '';
                        
                        
                                $query = $this->db->query($sql);
                        
                                if ($query->num_rows() > 0) {
                        
                                foreach ($query->result() as $row) {
                                    $view_bo_vigmor_data[] = [
                                        'id_grupo' => $row->id_grupo,
                                        'id_evento_padre' => $row->id_evento_padre,
                                        'tipo_caso_calculado' => $row->tipo_caso_calculado,
                                        'sexo' => $row->sexo,
                                        'id_rango' => $row->id_rango,
                                        'id_un' => $row->id_un,
                                        'fecha_defuncion' => $row->fecha_defuncion,
                                        'id_corregimiento_calculado' => $row->id_corregimiento_calculado,
                                        'COUNT(numero_casos)' => $row->{'COUNT(numero_casos)'}
                        
                                    ];
                                }
                        
                                return $view_bo_vigmor_data;
                        
                                } else {
                                    return false ;
                                }
                    }



}

?>