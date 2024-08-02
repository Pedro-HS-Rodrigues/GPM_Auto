<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{


        $data['currentPage'] = 'dashboardView';


        $this->load->view('includes/navbar',  $data);
		$this->load->view('pages/dashboardView', $data);
		$this->load->view('includes/footer',  $data);
	}
}
