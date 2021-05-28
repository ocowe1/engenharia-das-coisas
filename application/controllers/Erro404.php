<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Erro404 extends CI_Controller {

	public function index()
	{

		redirect('error_404');

	}

	public function tela(){
		$this->load->view('view_404');
	}
}
