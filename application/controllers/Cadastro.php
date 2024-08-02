<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

    public function index() {
        $data['currentPage'] = 'cadastroView';

        $this->load->view('includes/navbar', $data);
        $this->load->view('pages/cadastroView', $data);
    }

    public function store() {
        $this->load->model('cadastro_model');
        $user = array(
            "nome" => $_POST['nome'],
            "cargo" => $_POST['cargo'],
            "nivel" => $_POST['nivel'],
            "username" => $_POST['username'],
            "senha" => $_POST['senha'],
        );

        // Tenta inserir o usuário e captura se teve sucesso
        $success = $this->cadastro_model->store($user);
        
        if ($success) {
            $response = array('status' => 'success', 'message' => "Usuário cadastrado com sucesso!");
        } else {
            $response = array('status' => 'error', 'message' => "Erro ao cadastrar usuário. Nome de usuário já existe.");
        }

        // Retorna a resposta em JSON
        echo json_encode($response);
    }
}
?>
