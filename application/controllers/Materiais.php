<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materiais extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Carregar a model
        $this->load->model('materiais_model');
    }

    public function index() {
        $data['materiais'] = $this->materiais_model->getMateriais();
        $data['currentPage'] = 'materiaisView';
        $this->load->view('includes/navbar', $data);
        $this->load->view('pages/materiaisView', $data);
        $this->load->view('includes/modalSaida', $data);
        $this->load->view('includes/modalEntrada', $data);
        $this->load->view('includes/modalCadastrar', $data);
    }

    public function getMateriaisData() {
        $data = $this->materiais_model->getMateriais();
        echo json_encode($data);
    }

    public function inserirMaterial() {
        $nome = $this->input->post('nome');
        $tipo = $this->input->post('tipo');
        $quantidade = $this->input->post('quantidade');

        $data = array(
            'nome_prod' => $nome,
            'tipo' => $tipo,
            'qntd' => $quantidade
        );

        $this->materiais_model->inserirMaterial($data);
        redirect('materiais');
    }

    public function processarEntrada() {
        $id = intval($this->input->post('id'));
        $quantidade = intval($this->input->post('quantidade'));

        if ($this->materiais_model->adicionarEntrada($id, $quantidade)) {
            $this->session->set_flashdata('message', 'Entrada salva com sucesso!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Erro ao salvar entrada!');
            $this->session->set_flashdata('message_type', 'danger');
        }

        redirect('materiais');
    }

    public function processarSaida() {
        $id = intval($this->input->post('id'));
        $quantidade = intval($this->input->post('quantidade'));

        if ($this->materiais_model->adicionarSaida($id, $quantidade)) {
            $this->session->set_flashdata('message', 'Saída salva com sucesso!');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Erro ao salvar saída!');
            $this->session->set_flashdata('message_type', 'danger');
        }

        redirect('materiais');
    }
}
