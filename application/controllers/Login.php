<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function index()
    {
        // Carrega a navbar e armazena na variável $data['navbar']
		$data['currentPage'] = 'loginView';
        $data['navbar'] = $this->load->view('includes/navbar', $data, TRUE);

        // Carrega a view de login e passa as variáveis de dados
        $this->load->view('pages/loginView', $data);
    }
}
