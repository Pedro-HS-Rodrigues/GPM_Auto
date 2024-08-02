<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Servico_model');
    }

    public function index() {
        $data['currentPage'] = 'servicoView';
        $data['mecanicos'] = $this->Servico_model->get_mecanicos(); // Certifique-se de que esta função existe e está correta
        $data['produtos'] = $this->Servico_model->get_produtos(); // Certifique-se de que esta função existe e está correta
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
        $data = array(
			'mecanico' => $this->input->post('mecanico'),
			'data' => $this->input->post('data'),
			'servico' => $this->input->post('servico'),
			'produto' => $this->input->post('produto'),
			'quantidade_prod' => $this->input->post('quantidade')
		);

        if ($this->Servico_model->inserir_servico($data)) {
            $this->session->set_flashdata('success', 'Serviço cadastrado com sucesso!');
        } else {
            $this->session->set_flashdata('error', 'Falha ao cadastrar o serviço.');
        }
        redirect('servico'); // Redirecione para a página desejada
    }
}
