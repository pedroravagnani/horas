<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . 'libraries/util/CI_Object.php';

class horasComponent extends CI_Object {

    private $data;
    private $numhoras;
    private $tempo;
    private $estado;
    private $temp_max;
    private $dados = array();

    public function __construct (horasData $data) {
        parent::__construct();
        $this->data = $data;
        $this->habilitado = $data->habilitado ? 1 : 0;
        $this->temp_max = $data->temp_max;
        $this->numhoras = $data->num_elem;
    }

    public function getItens() {

        $rs = $this->db->get('horas');
        return $rs->result();;

    }

    public function inserir($dados) {

        $horas = $this->db->get('horas');
        $horas = $horas->result();
        $id = 0;

        foreach($horas as $index) {
            if(is_null($index->id)) {
                $id = 0; 
             } else {
                $id = $index->id;
             }
        }
        $id = $id + 1;
       
    
        $rs = "INSERT into horas (id,titulo, conteudo, tempo) values ('".$id."', '" .$dados['titulo'] . "', '". $dados['conteudo'] . "', '". $dados['tempo'] ."')";
        $this->db->query($rs);

    }

    public function update ($id, $dados) {
        $this->db->update('horas', 
        array('titulo' => $dados['titulo'], 'conteudo' => $dados['conteudo'], 'tempo'=>$dados['tempo']), "id = $id");
    }

    public function updateEstado ($id, $estado) {
        $this->db->update('horas', 
        array('estado' => $estado), "id = $id");
    }

    public function delete($id) {
        $this->db->delete('horas', array('id' => $id));
    }

    public function get_by_id($id){
        $sql = "SELECT * FROM horas WHERE id = $id";
        $res = $this->db->query($sql);

        return $res->result_array();    
    }
    


    public function getHTML () {

        if ($this->habilitado) {
           
            $this->dados = $this->getItens();

            $html = '';

            $html .= '<div class="container">';
            $html .= '<div class="card">';
            $html .= '<h3 class="card-header green white-text" style="text-align: center;">Atividades Prontas</h3>';
            $html .= '<div class="card-body">';
            $html .= '<table class="table">';
            $html .= '<thead class="blue-grey lighten-4"><tr><th>#</th><th>Titulo</th><th style="width:400px">Conteudo</th><th style="width:400px">Tempo</th><th style="width:200px">Opções</th></tr></thead>';
            $html .= '<tbody>';
            foreach ($this->dados as $index) {
                if($index->estado == 1){
                    $html .= '<th scope="row">'.$index->id . '</th>
                    <td> ' . $index->titulo . ' </td>
                    <td style="width:400px"> ' . $index->conteudo . '</td>

                    <td style="width:400px"> ' . $index->tempo . '</td>
                    <td style="width:200px">
                    <div class="btn-group mr-2" role="group" aria-label="...">

                    <a href="'.base_url("/Horas/retomar/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm red" role="group">Retomar</button></a>
                    
                    <a href="'.base_url("/Horas/editar/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm btn-primary" role="group">
                    Editar</button></a>';
                    
                    $html .= '<a href="'.base_url("/Horas/deletar/$index->id").'">';
                    $html .= '<button type="button" class="btn btn-group btn-sm btn-danger" role="group">Deletar</button></a>';
    
                    $html .= '</td></th></div></tbody>';
                }
            }
            $html .= '</table></div></div><br>';
            
            $html .= '<div class="card">';
            $html .= '<h3 class="card-header red white-text" style="text-align: center;">Em Progresso</h3>';
            $html .= '<div class="card-body">';
            $html .= '<table class="table">';
            $html .= '<thead class="blue-grey lighten-4"><tr><th>#</th><th>Titulo</th><th style="width:400px">Conteudo</th><th style="width:400px">Tempo</th><th style="width:200px">Opções</th></tr></thead>';
            $html .= '<tbody>';
            foreach ($this->dados as $index) {
                if($index->estado == 0){
                    $html .= '<th scope="row">'.$index->id . '</th>
                    <td> ' . $index->titulo . ' </td>
                    <td style="width:400px"> ' . $index->conteudo . '</td>

                    <td style="width:400px"> ' . $index->tempo . '</td>
                    <td style="width:200px">
                    <div class="btn-group mr-2" role="group" aria-label="...">

                    <a href="'.base_url("/Horas/retomar/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm green" role="group">Concluir</button></a>
                    
                    <a href="'.base_url("/Horas/editar/$index->id").'">
                    <button type="button" class="btn btn-group btn-sm btn-primary" role="group">
                    Editar</button></a>';
                    
                    $html .= '<a href="'.base_url("/Horas/deletar/$index->id").'">';
                    $html .= '<button type="button" class="btn btn-group btn-sm btn-danger" role="group">Deletar</button></a>';
    
                    $html .= '</td></th></div></tbody>';
                }
            }
            $html .= '</table></div></div><br>';
            
            $html .= '</table></div></div></div><br>';
            return $html;
        } else {
            return '<h3 class="card title" style="text-align: center">Modulo Desabilitado</h3>';
        }
    }

    public function verifica() { 
        $horas = $this->db->get('horas');
        $horas = $horas->result();
        $i = 0;
        foreach($horas as $index) {
            if($index->estado == 0) {
                $i++;
            }
        }
        if($this->numhoras >= $i) {
            return 1;
        } else {
            return 0;
        }
    }
}