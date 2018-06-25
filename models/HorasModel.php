<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . 'modules/horas/libraries/component/HorasComponent.php';
include_once APPPATH . 'modules/horas/libraries/component/HorasData.php';

class HorasModel extends MY_Model{

    private $nome;
    private $conteudo;
    private $tempo;
    private $html;

    function __construct(){
        parent::__construct('Horas');
    }

    public function get_nome() {
        return $this->nome;
    }
    public function set_nome($nome) {
        $this->nome = $nome;
    }
    public function conteudo() {
        return $this->conteudo;
    }
    public function set_descricao($conteudo) {
        $this->conteudo = $conteudo;
    }
    public function get_tempo() {
        return $this->tempo;
    }
    public function set_tempo($tempo) {
        $this->tempo = $tempo;
    }

    public function get_elems() {

        $data = new HorasData(1);
        $horas = new HorasComponent($data);
        return $horas->getHtml();
        
    }

    public function inserir() {

        if(sizeof($_POST)) { 
            
            $this->form_validation->set_rules('titulo', 'Titulo', 'required|min_length[5]');
            $this->form_validation->set_rules('conteudo', 'Conteudo', 'required|min_length[1]');
            
            $dados = array();
            $dados['titulo'] = $this->input->post('titulo');
            $dados['conteudo'] = $this->input->post('conteudo');
            $dados['tempo'] = $this->input->post('tempo');

                
            $data = new horasData(1);
            $horas = new horasComponent($data);

            $horas->inserir($dados);
            redirect("horas");

        }
    }

    public function deletar($id) {
        $data = new horasData(1);
        $horas = new horasComponent($data);
        $horas->delete($id); 
        redirect("horas");
    }

    public function verifica() {
        $data = new horasData(1);
        $horas = new horasComponent($data);
        $result = $horas->verifica();
        return $result;
    }

    public function editar($id) {

        $data = new horasData(1);
        $horas = new horasComponent($data);
        
        if(sizeof($_POST) == 0) {
            $v = $horas->get_by_id($id);
            $_POST = $v[0];
        }
        else {
            
            $dados['titulo'] = $this->input->post('titulo');
            $dados['conteudo'] = $this->input->post('conteudo');
            $dados['id'] = $this->input->post('id');
            $dados['estado'] = $this->input->post('estado');
            $horas->update($id, $dados); 
            redirect("horas");
        }
    }

}