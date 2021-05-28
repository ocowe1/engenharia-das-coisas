<?php
defined ( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Home extends CI_Controller
{

	function __construct ()
	{
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->library ( 'form_validation' );
		$this->load->helper ( 'form' );
		date_default_timezone_set ( 'America/Sao_Paulo' );
	}

	function index ()
	{
		redirect ( 'login' );
	}

	function logout ()
	{


		if ( $this->session->userdata ( 'logged_in' ) ) {


			$this->load->model ( "model_user" );

			if ( $this->session->userdata ( 'logged_in' ) ) {
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
			}
			elseif ( $this->session->userdata ( 'bloqueado' ) ) {
				$session = $this->session->userdata ( 'bloqueado' );
				$id = $session[ 'user_email' ];
			}


			$data = date ( 'd-m-Y' );
			$hora = date ( 'H:i' );
			$log = array(
				'log_name' => 'Logout de usuário' ,
				'log_descricao' => 'O usuário de id registrado realizou o logout.' ,
				'tipo' => 'Logout' ,
				'user_id' => $id ,
				'data' => $data ,
				'hora' => $hora
			);
			$this->model_user->log ( $log );

			$this->session->unset_userdata ( 'logged_in' );
			session_destroy ();
			redirect ( 'login' , 'refresh' );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function bloquear ()
	{
		$session = $this->session->userdata ( 'logged_in' );

		$id = $session[ 'user_id' ];
		$this->load->model ( 'model_user' );
		$dados = $this->model_user->busca ( $id );
		$this->session->unset_userdata ( 'logged_in' );

		foreach ($dados as $d) {
			$cmd = array(
				'user_email' => $d->user_email ,
				'user_img' => $d->user_img ,
				'user_name' => $d->user_name
			);
		}

		$this->session->set_userdata ( 'bloqueado' , $cmd );

		redirect ( 'bloqueado' , 'refresh' );


	}

	public
	function bloqueado ()
	{
		if ( $this->session->userdata ( 'bloqueado' ) ) {

			$this->load->view ( 'view_bloqueado' );

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

}
