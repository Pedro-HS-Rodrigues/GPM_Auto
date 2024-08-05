<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Servico_model');
    }

    public function index() {
        $data['currentPage'] = 'servicoView';
        $data['mecanicos'] = $this->Servico_model->get_mecanicos();
        $data['produtos'] = $this->Servico_model->get_produtos();
        $this->load->view('includes/modalCadastrarServico', $data);
        $this->load->view('includes/navbar', $data);
        $this->load->view('pages/servicoView', $data);
    }

    public function getServicosData() {
        $data = $this->Servico_model->get_servicos();
        echo json_encode($data);
    }

    public function getRelatorioCompleto() {
        $data = $this->Servico_model->get_relatorio_completo();
        echo json_encode($data);
    }

    public function cadastrar() {
        $placas = $this->input->post('placas');
        $placasArray = explode(',', $placas);
        $produtoId = $this->input->post('produto');
        $quantidade = $this->input->post('quantidade');
    
        // Verifica o estoque disponível para o produto selecionado
        $produto = $this->Servico_model->get_produto_by_id($produtoId);
        if ($produto && $quantidade > $produto['qntd']) {
            echo json_encode(['status' => 'error', 'message' => 'Quantidade em estoque insuficiente.']);
            return;
        }
    
        $data = array(
            'mecanico' => $this->input->post('mecanico'),
            'data' => $this->input->post('data'),
            'servico' => $this->input->post('servico'),
            'produto' => $produtoId,
            'quantidade_prod' => $quantidade,
            'placa' => $this->input->post('placa')
        );
    
        foreach ($placasArray as $placa) {
            $data['placa'] = trim($placa);
            if (!$this->Servico_model->inserir_servico($data)) {
                echo json_encode(['status' => 'error', 'message' => 'Falha ao cadastrar o serviço.']);
                return;
            }
        }
    
        echo json_encode(['status' => 'success', 'message' => 'Serviço cadastrado com sucesso!']);
    }
    
}
?>
