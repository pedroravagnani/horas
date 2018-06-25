<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/builder/MenuBuilder.php';


class MenuTableBuilder extends MenuBuilder{

    function __construct(){
        parent::__construct('Horas');
    }

    function get_data(){
        // páginas básicas: index e edit
        

        // páginas extras: funcionalidades adicionais do módulo
        $data = array(
            array(
                'label'  => 'Inicio', 
                'link'   => $this->mod_name,
                'name'   => $this->prefix.'inicio',
                'module' => $this->mod_name
            ),
            array(
                'label'  => 'Inserir', 
                'link'   => $this->mod_name.'/inserir',
                'name'   => $this->prefix.'insert',
                'module' => $this->mod_name
            )
        );

        return array_merge($data);
    }
}
