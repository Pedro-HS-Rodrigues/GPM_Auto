<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servico_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_servicos() {
        $query = $this->db->select('s.id, u.nome as Mecanico, s.data as Data, s.servico as Servico, e.nome_prod as Produto, s.quantidade_prod as Quantidade, s.placa as Placa')
                          ->from('servico s')
                          ->join('usuario u', 's.mecanico = u.id')
                          ->join('estoque e', 's.produto = e.id')
                          ->get();
        return $query->result_array();
    }

    public function get_relatorio_completo() {
        $this->db->select('s.servico, COUNT(s.id) as total_servicos');
        $this->db->from('servico s');
        $this->db->group_by('s.servico');
        $query = $this->db->get();
        $servicos = $query->result_array();
        return [
            'total_servicos' => $servicos,
        ];
    }

    public function inserir_servico($data) {
        return $this->db->insert('servico', $data);
    }

    public function get_mecanicos() {
        $this->db->select('id, nome');
        $this->db->from('usuario');
        $this->db->where('nivel', 3);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_produtos() {
        $this->db->select('*');
        $this->db->from('estoque');
        $this->db->where('qntd >', 0);
        $query = $this->db->get();
        return $query->result_array();
    }
}
