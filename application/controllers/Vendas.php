<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendas extends CI_Controller {

	public function index()
	{


        $data['currentPage'] = 'vendasView';


        $this->load->view('includes/navbar',  $data);
		$this->load->view('pages/vendasView', $data);
	}
}
