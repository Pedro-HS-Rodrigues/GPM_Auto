<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navbar extends CI_Controller {

    public function index()
    {
        // Carregando a view com os dados
        $this->load->view('includes/navbar');
        $this->load->view('pages/cadastroView');
        
    }
}
