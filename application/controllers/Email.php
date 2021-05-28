<?php
defined ( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Email extends CI_Controller
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

	public function validar($token){

		if($token == null){

			//$alerta['msg'] = 'Desculpe, não foi possível liberar seu acesso! Entre em contato conosco!';
			//$this->load->view('login', $alerta);
			redirect('login');
		}else{

			$validar['user_token'] = 0;
			$validar['email_conf'] = 1;
			$validar['profile_id'] = 5;


			$confirma = $this->model_user->validar($token, $validar);
			if($confirma == FALSE){
				redirect('login');
			}elseif($confirma == TRUE){
				foreach($confirma as $e){
					$email = array(
					'user_email' =>$e->user_email
					);
				}

				$this->email->from ( "engenhariacoisas@gmail.com" , 'EDC - Engenharia das Coisas' );
				$this->email->subject ( "Cadastro confirmado." );
				$this->email->reply_to ( "engenhariacoisas@gmail.com" );
				$this->email->to ( $email );
				$this->email->bcc ( 'viniciusath@hotmail.com' );
				$this->email->message ( "Olá, <br><br> Seu e-mail foi confirmado com sucesso e agora você pode navegar pela EDC. <br>
										Veja arquivos como pdf, imagens, power point e afins. Tudo para que ajude em seus estudos.<br> Interaja com outros alunos e até mesmo com professores!
										Crie algum assunto para discutir com a comunidade e ajude divulgando arquivos também!<br><br> De todos nós da EDC, muito obrigado por fazer parte disso!
									    <br><br>Seja bem vindo! <br><br> Att,<br> Administração - EDC."
				);
				$this->email->send ();

				$this->load->model("model_user");
				$session = $this->session->userdata('logged_in');
				$id = $session['user_id'];
				$data = date ('d-m-Y');
				$hora = date ('H:i');
				$log = array(
					'log_name' => 'Verificação de email',
					'log_descricao' => 'Confirmação do email:' . $email,
					'tipo' => 'Confirmação de email',
					'user_id' => 0,
					'data' => $data,
					'hora' => $hora
				);
				$this->model_user->log($log);

				redirect('login');
			}
		}


	}
}
