<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materiais_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Método para obter todos os materiais
    public function getMateriais() {
        $this->db->select('id, nome_prod, tipo, qntd');
        $this->db->from('estoque');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function inserirMaterial($data) {
        $this->db->insert('estoque', $data);
    }

    public function adicionarEntrada($id, $quantidade) {
        $this->db->set('qntd', 'qntd + ' . intval($quantidade), FALSE);
        $this->db->where('id', $id);
        return $this->db->update('estoque');
    }

    public function adicionarSaida($id, $quantidade) {
        $this->db->set('qntd', 'qntd - ' . intval($quantidade), FALSE);
        $this->db->where('id', $id);
        return $this->db->update('estoque');
    }
}
