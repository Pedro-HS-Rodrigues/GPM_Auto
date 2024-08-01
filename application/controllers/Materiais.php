<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materiais extends CI_Controller {

	public function index()
	{


        $data['currentPage'] = 'materiaisView';


        $this->load->view('includes/navbar',  $data);
		$this->load->view('pages/materiaisView', $data);
	}
}
