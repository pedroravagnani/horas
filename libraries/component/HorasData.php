<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH.'libraries/util/CI_Object.php';


class HorasData extends CI_Object{

    public function __construct($id){
        parent::__construct();
        $this->load_data($id);
    }


        private function load_data ($id) { 
            $rs = $this->db->get_where('config', array('id' => $id));

            foreach ($rs->row() as $key => $value) { 
                $this->key = $value;
            }

            $this->{'habilitado'} = $this->modconfig->mod_Horas_active;
            $this->{'num_elem'} = $this->modconfig->mod_Horas_num_elem;
            $this->{'temp_max'} = $this->modconfig->mod_Horas_temp_max;

        }
}