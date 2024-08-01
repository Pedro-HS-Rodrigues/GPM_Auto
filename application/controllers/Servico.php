<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servico extends CI_Controller {

	public function index()
	{


        $data['currentPage'] = 'servicoView';


        $this->load->view('includes/navbar',  $data);
		$this->load->view('pages/servicoView', $data);
	}
}
