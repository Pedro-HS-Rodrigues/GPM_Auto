<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getVendas() {
        $this->db->select('vd.id, v.nome AS Vendedor, vd.data AS Data, e.nome_prod AS Produto, vd.quantidade AS Quantidade');
        $this->db->from('venda vd');
        $this->db->join('usuario v', 'vd.vendedor = v.id', 'left');
        $this->db->join('estoque e', 'vd.produto = e.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSelectedVendas($ids) {
        $this->db->select('v.nome AS Vendedor, vd.data AS Data, e.nome_prod AS Produto, vd.quantidade AS Quantidade');
        $this->db->from('venda vd');
        $this->db->join('usuario v', 'vd.vendedor = v.id', 'left');
        $this->db->join('estoque e', 'vd.produto = e.id', 'left');
        $this->db->where_in('vd.id', $ids);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function inserirVenda($data) {
        $this->db->insert('venda', $data);
    }

    public function insert_venda($vendedor, $data, $produto, $quantidade) {
        $data = array(
            'vendedor' => $vendedor,
            'data' => $data,
            'produto' => $produto,
            'quantidade' => $quantidade
        );

        return $this->db->insert('venda', $data);
    }

    public function get_vendedores() {
        $this->db->select('id, nome');
        $this->db->from('usuario');
        $this->db->where('nivel', 4);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_produtos() {
        $this->db->select('id, nome_prod, qntd');
        $this->db->from('estoque');
        $this->db->where('qntd >', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_produto_estoque($produto_id) {
        $this->db->select('qntd');
        $this->db->from('estoque');
        $this->db->where('id', $produto_id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result ? $result['qntd'] : 0;
    }

    public function atualizar_estoque($produto_id, $quantidade_vendida) {
        $this->db->set('qntd', 'qntd - ' . (int)$quantidade_vendida, FALSE);
        $this->db->where('id', $produto_id);
        $this->db->update('estoque');
    }
}
