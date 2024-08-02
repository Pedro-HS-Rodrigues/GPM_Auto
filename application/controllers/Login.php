<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $data['currentPage'] = 'loginView';
        $this->load->view('includes/navbar', $data);
        $this->load->view('pages/loginView', $data);
    }

    public function store() {
        $this->load->model('login_model');

        $user = $this->input->post("username");
        $password = $this->input->post("password");
        $usuario = $this->login_model->store($user, $password);

        if ($usuario) {
            $this->session->set_userdata(array(
                'logged_user' => $usuario,
                'user_nivel'  => $usuario['nivel'] 
            ));
            redirect("dashboard");
        } else {
            
            $this->session->set_flashdata('login_error', 'Usuário não encontrado ou senha incorreta.');
            redirect('login');
        }
    }
}
?>
