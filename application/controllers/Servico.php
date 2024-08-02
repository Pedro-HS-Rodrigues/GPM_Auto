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

        $data = array(
            'mecanico' => $this->input->post('mecanico'),
            'data' => $this->input->post('data'),
            'servico' => $this->input->post('servico'),
            'produto' => $this->input->post('produto'),
            'quantidade_prod' => $this->input->post('quantidade')
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
