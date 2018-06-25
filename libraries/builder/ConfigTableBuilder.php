<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/builder/ConfigBuilder.php';


class ConfigTableBuilder extends ConfigBuilder{

    function __construct(){
        parent::__construct('Horas');
    }

    function get_data(){
        // parâmetros básicos de configuração
        $base = parent::get_data();

        // parâmetros específicos de configuração
        $data = array(
            array(
                'nome' => $this->prefix.'num_elem', 
                'valor' => 10,
                'descricao' => 'Indica o número maximo de atividade em execução',
                'admin_only' => 0
            ),
            array(
                'nome' => $this->prefix.'temp_max', 
                'valor' => 240,
                'descricao' => 'Determina o tempo maximo para uma tarefa (em minutos)',
                'admin_only' => 0
            )
        );
        
        return array_merge($base, $data);
    }
}
