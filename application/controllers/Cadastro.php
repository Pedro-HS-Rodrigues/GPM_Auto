<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

	public function index()
	{


        $data['currentPage'] = 'cadastroView';


        $this->load->view('includes/navbar',  $data);
		$this->load->view('pages/cadastroView', $data);
	}
}
