<?php
defined ( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Cadastrar extends CI_Controller
{
	function __construct ()
	{
		parent::__construct ();
		$this->load->model ( 'model_user' );
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'model_user' , TRUE );
		$this->load->helper ( 'url' );
		$this->load->library ( 'email' );

	}

	public
	function index ()
	{
		//$this->load->library ( 'form_validation' );

		$this->form_validation->set_message ( 'required' , 'Campo %s é obrigatório!' );
		//$this->form_validation->set_message ('min:8', 'Campo %s precisa de no minímo 8 caracteres!');
		$this->form_validation->set_rules ( 'termos' , 'required' );
		$this->form_validation->set_rules ( 'email' , 'email' , 'trim|required|callback_validacao' );
		$this->form_validation->set_rules ( 'nome' , 'nome' , 'trim|required' );
		$this->form_validation->set_rules ( 'celular' , 'celular' , 'trim|required' );
		$this->form_validation->set_rules ( 'curso' , 'curso' , 'trim|required' );
		$this->form_validation->set_rules ( 'ra' , 'ra' , 'trim|required' );
		$this->form_validation->set_rules ( 'senha' , 'senha' , 'trim|required' );
		$this->form_validation->set_rules ( 'confsenha' , 'confsenha' , 'trim|required|callback_confsenha' );
		$this->form_validation->set_rules ( 'termos' , 'termos' , 'trim|required' );
		$this->form_validation->set_error_delimiters ( '<div class="form-group has-error">' , '</div>' );

		if ( $this->form_validation->run () == FALSE ) {

			$this->load->view ( 'view_cadastro' );
		}
		else {
			$senha = $this->input->post ( 'senha' );
			$token = md5 ( 'user_edc' . $senha );

			$default = "default.png";
			$u = "Usuário";

			$user_data[ 'user_name' ] = $this->input->post ( 'nome' );
			$user_data[ 'user_email' ] = $this->input->post ( 'email' );
			$user_data[ 'user_celular' ] = $this->input->post ( 'celular' );
			$user_data[ 'user_curso' ] = $this->input->post ( 'curso' );
			$user_data[ 'user_ra' ] = $this->input->post ( 'ra' );
			$user_data[ 'user_senha' ] = md5($this->input->post ( 'senha' ));
			$user_data[ 'user_token' ] = $token;
			$user_data['user_img'] = $default;
			$user_data['user_profile'] = $u;
			$user_data['alter_dados'] = date('d-m-Y');

			$senha = $this->input->post ( 'senha' );
			$confsenha = $this->input->post ( 'confsenha' );
			$email = $this->input->post ( 'email' );

			$this->load->model ( 'model_user' );

			$this->model_user->cadastrar ( $user_data , $email );

			$this->email->from ( "edc@engenhariadascoisas.com.br" , 'EDC - Engenharia das Coisas' );
			$this->email->subject ( "Confirmação de cadastro." );
			$this->email->reply_to ( "engenhariacoisas@gmail.com" );
			$this->email->to ( $email );
			$this->email->bcc ( 'viniciusath@hotmail.com' );
			$this->email->message ( "Olá, <br><br> Falta pouco para você poder finalmente acessar todos os recursos da EDC (Engenharia das Coisas).<br> <br>
									Para poder ter acesso é necessário que você confirme seu e-mail e assim você terá acesso a todo o conteúdo disponível. <br><br>
									Clique <a href='http://localhost:8080/EDC/confirma/email/" . $token . "'/>aqui</a> para liberarmos seu acesso. \n Obrigado por se inscrever! <br>
									<br><br><br>Seja bem vindo! <br><br> Att,<br> Administração - EDC."
							       );
			$this->email->send ();

			$this->load->model("model_user");
			$session = $this->session->userdata('logged_in');
			$id = $session['user_id'];
			$data = date ('d-m-Y');
			$hora = date ('H:i');
			$log = array(
				'log_name' => 'Cadastro de usuário',
				'log_descricao' => 'O usuário de email registrado realizou o cadastro.',
				'tipo' => 'Cadastro',
				'user_id' => $email,
				'data' => $data,
				'hora' => $hora
			);
			$this->model_user->log($log);

			redirect ( 'login' , 'refresh' );


		}
	}

	function validacao ( $email )
	{
		$this->load->model ( 'model_user' );

		$result = $this->model_user->verificar ( $email );
		if ( $result == FALSE ) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message ( 'validacao' , 'Email já esta cadastrado!' );
			return FALSE;
		}
	}

	function confsenha ( $senha , $confsenha )
	{
		if ( $senha != $confsenha ) {
			$this->form_validation->set_message ( 'confsenha' , 'Senhas não conferem!' );
			return true;
		}
		else {
			return false;
		}
	}
}
