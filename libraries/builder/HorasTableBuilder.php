<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/builder/TableBuilder.php';

class HorasTableBuilder extends TableBuilder{

    public function __construct(){
        parent::__construct('Horas');
    }

    function get_fields(){
        $fields['id'] = array('type' => 'int', 'constraint', 'primary key' =>  11);
        $fields['titulo'] = array('type' => 'VARCHAR', 'constraint' =>  150);
        $fields['conteudo'] = array('type' => 'VARCHAR', 'constraint' =>  500);
        $fields['tempo'] = array('type' => 'int', 'constraint' =>  11);
        $fields['estado'] = array('type' => 'int', 'constraint' =>  11);

        return $fields;
    }

    function get_data(){
        // para inserir um registro na tabela jumbotron...
        $data[] = array(
            'id' => 1,
            'titulo' => 'Atividade 1', 
            'conteudo' => 'Esta é uma Atividade de 60 minutos', 
            'tempo' => 60
        );
        $data[] = array(
            'id' => 2,
            'titulo' => 'Atividade 2', 
            'conteudo' => 'Esta é uma Atividade de 120 minutos', 
            'tempo' => 120
        );
        $data[] = array(
            'id' => 3,
            'titulo' => 'Atividade 3', 
            'conteudo' => 'Esta é uma Atividade de 180 minutos', 
            'tempo' => 180
        );
        $data[] = array(
            'id' => 4,
            'titulo' => 'Atividade 4', 
            'conteudo' => 'Esta é uma Atividade de 240 minutos', 
            'tempo' => 240
        );


        return $data;
    }

}