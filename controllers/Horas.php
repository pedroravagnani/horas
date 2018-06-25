<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Horas extends MY_Controller{

    public function __construct(){
        parent::__construct();
        
        $this->load->model('HorasModel', 'horas');
        $this->menu_itens = $this->horas->get_menu_itens();
    }

    /**
     * Página inicial do módulo; exibe sua funcionalidade principal. Além desta, um
     * módulo pode ter outras páginas, de acordo com sua finalidade. O importante é
     * lembrar que um módulo deve estar focado em fazer, bem feito e de forma flexível, 
     * apenas uma tarefa.
     */
    public function index(){
        $html = 'Apontador de Horas';
        $html = $this->horas->get_elems();
        $this->show($html);
    }

    /**
     * Página de configuração do conteúdo exibido nas páginas de funcionalidades do módulo
     */
    public function inserir(){
        $data['action'] = $this->horas->inserir();
        $data['titulo'] = 'Inserir';
        $data['horas'] = $this->horas->verifica();
        if($data['horas'] == 1) {
            $html = $this->load->view("inserir", $data);
        } else {
            $html = $this->load->view("aviso", $data);
        }
        $this->show($html);
    }

    public function deletar($id) {
        $this->horas->deletar($id);
        redirect('horas');
    }

    public function retomar($id) {
        $data = new horasData(1);
        $horas = new horasComponent($data);
        $dados = $horas->get_by_id($id);
        $estado = intVal($dados[0]['estado']);
        if($dados[0]['estado']== 1){
        $horas->updateEstado($id, '0');
        }else{
        $horas->updateEstado($id, '1'); 
        }
        redirect("horas");
    }

    public function editar($id) {
        $this->horas->editar($id);
        $data['action'] = $id;
        $data['titulo'] = 'Editar';
        $html = $this->load->view("inserir", $data, true);
        $this->show($html);
        }
    }
