<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Vendas_model');
    }

    public function index() {
        $data['vendedores'] = $this->Vendas_model->get_vendedores();
        $data['produtos'] = $this->Vendas_model->get_produtos();
        $data['currentPage'] = 'vendasView';
        $this->load->view('includes/modalCadastrarVenda', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('pages/vendasView', $data);
    }

    public function getVendasData() {
        $data = $this->Vendas_model->getVendas();
        echo json_encode($data);
    }

    public function add_venda() {
        $vendedor = $this->input->post('vendedor');
        $data = $this->input->post('data');
        $produto = $this->input->post('produto');
        $quantidade = $this->input->post('quantidade');

        $estoque = $this->Vendas_model->get_produto_estoque($produto);

        if ($estoque < $quantidade) {
            echo json_encode(['status' => 'error', 'message' => 'Quantidade em estoque insuficiente.']);
            return;
        }

        if ($this->Vendas_model->insert_venda($vendedor, $data, $produto, $quantidade)) {
            echo json_encode(['status' => 'success', 'message' => 'Venda registrada com sucesso!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Falha ao registrar a venda.']);
        }
    }

    public function getRelatorioCompleto() {
        $vendas = $this->Vendas_model->getVendas();
        
        // Contagem de vendas por vendedor
        $vendasPorVendedor = [];
        foreach ($vendas as $venda) {
            $vendedor = $venda['Vendedor'];
            if (!isset($vendasPorVendedor[$vendedor])) {
                $vendasPorVendedor[$vendedor] = 0;
            }
            $vendasPorVendedor[$vendedor]++;
        }
    
        // Dia com mais vendas
        $vendasPorDia = [];
        foreach ($vendas as $venda) {
            $data = $venda['Data'];
            if (!isset($vendasPorDia[$data])) {
                $vendasPorDia[$data] = 0;
            }
            $vendasPorDia[$data]++;
        }
        $diaMaisVendas = array_keys($vendasPorDia, max($vendasPorDia));
    
        // Produto mais vendido
        $vendasPorProduto = [];
        foreach ($vendas as $venda) {
            $produto = $venda['Produto'];
            if (!isset($vendasPorProduto[$produto])) {
                $vendasPorProduto[$produto] = 0;
            }
            $vendasPorProduto[$produto]++;
        }
        $produtoMaisVendido = array_keys($vendasPorProduto, max($vendasPorProduto));
    
        $result = [
            'vendasPorVendedor' => $vendasPorVendedor,
            'diaMaisVendas' => $diaMaisVendas[0],
            'produtoMaisVendido' => $produtoMaisVendido[0]
        ];
    
        echo json_encode($result);
    }
}
?>
