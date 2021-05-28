<?php
defined ( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Autentica extends CI_Controller
{

	function __construct ()
	{
		parent::__construct ();
		$this->load->model ( 'model_user' );
		$this->load->model ( 'model_user' , TRUE );
		$this->load->helper ( 'url' );

	}

	public
	function index ()
	{
		$this->load->helper ( 'cookie' );
		$this->load->library ( 'form_validation' );

		$this->form_validation->set_message ( 'required' , 'Campo %s obrigatório!' );
		$this->form_validation->set_rules ( 'email' , 'Email' , 'trim|required' );
		$this->form_validation->set_rules ( 'senha' , 'Senha' , 'trim|required|callback_check_database' );

		if ( $this->form_validation->run () == FALSE ) {
			$this->load->view ( 'view_login' );
		}
		else {
			$email = $this->input->post ( 'email' );
			$senha = md5 ( $this->input->post ( 'senha' ) );

			$resultado = $this->model_user->login ( $email , $senha );

			foreach ($resultado as $user_data) {
				$config_array = array(
					'user_id' => $user_data->user_id
				);

				$this->session->set_userdata ( 'logged_in' , $config_array );

				$session = $this->session->userdata ( 'logged_in' );

				$id = $session[ 'user_id' ];
				$dados = $this->model_user->busca ( $id );

				foreach ($dados as $d) {
					$dado = array(
						'profile_id' => $d->profile_id ,
						'semestre' => $d->semestre ,
						'alter_dados' => $d->alter_dados
					);
				}

				$this->load->model ( "model_user" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Login de usuário' ,
					'log_descricao' => 'O usuário de id registrado realizou login.' ,
					'tipo' => 'Login' ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_user->log ( $log );


				if ( $dado[ 'profile_id' ] == 1 ) {
					$this->session->userdata ( 'logged_in' );
					redirect ( 'master/inicio' );
				}
				elseif ( $dado[ 'profile_id' ] == 2 ) {
					$this->session->userdata ( 'logged_in' );
					redirect ( 'administrador/inicio' );
				}
				elseif ( $dado[ 'profile_id' ] == 3 ) {
					$this->session->userdata ( 'logged_in' );
					redirect ( 'gestor/inicio' );
				}
				elseif ( $dado[ 'profile_id' ] == 4 ) {
					$this->session->userdata ( 'logged_in' );
					redirect ( 'professor/inicio' );
				}
				elseif ( $dado[ 'profile_id' ] == 5 ) {
					$this->session->userdata ( 'logged_in' );
					redirect ( 'usuario/inicio' );
				}
				else {
					redirect ( 'login' , 'refresh' );
				}
			}
		}
	}

	function check_database ( $senha )
	{
		$email = $this->input->post ( 'email' );
		$senha_m = md5($senha);

		$result = $this->model_user->login ( $email , $senha_m );

		if ( isset( $result ) && !empty( $result ) ) {
			return true;
		}
		else {
			$this->form_validation->set_message ( 'check_database' , 'Ops! Houve um erro com nosso banco de dados.' );
			return false;
		}
	}

	public function logado ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];

			$this->load->model ( 'model_user' );
			$dados = $this->model_user->busca ( $id );

			foreach ($dados as $d) {
				$dado = array(
					'profile_id' => $d->profile_id ,
					'semestre' => $d->semestre ,
					'alter_dados' => $d->alter_dados
				);
			}

			if ( $dado[ 'profile_id' ] == 1 ) {
				$this->session->userdata ( 'logged_in' );
				redirect ( 'master/inicio' );
			}
			elseif ( $dado[ 'profile_id' ] == 2 ) {
				$this->session->userdata ( 'logged_in' );
				redirect ( 'administrador/inicio' );
			}
			elseif ( $dado[ 'profile_id' ] == 3 ) {
				$this->session->userdata ( 'logged_in' );
				redirect ( 'gestor/inicio' );
			}
			elseif ( $dado[ 'profile_id' ] == 4 ) {
				$this->session->userdata ( 'logged_in' );
				redirect ( 'professor/inicio' );
			}
			elseif ( $dado[ 'profile_id' ] == 5 ) {
				$this->session->userdata ( 'logged_in' );
				redirect ( 'usuario/inicio' );
			}
			else {
				session_destroy ();
				redirect ( 'login' );
				die();
			}
		}elseif ( $this->session->userdata ( 'bloqueado' ) ) {
			//$session = $this->session->userdata ( 'bloqueado' );
			//$id = $session[ 'user_email' ];

			redirect ('bloqueado', 'refresh');
		}
	}

	function desbloquear (){
		if ( $this->session->userdata ( 'bloqueado' ) ) {
			$this->load->helper(array('form', 'url'));

			$this->form_validation->set_message ( 'required' , 'Campo %s é obrigatório!' );
			$this->form_validation->set_rules ( 'senha' , 'senha' , 'trim|required' );
			$this->form_validation->set_error_delimiters ( '<center><div class="form-group has-error">' , '</div></center>' );

			if  ($this->form_validation->run ()  ==  FALSE ) {
				$this->load->view('view_bloqueado');
			}else {

				$session = $this->session->userdata("bloqueado");
				$email = $session['user_email'];
				$senha = $this->input->post('senha');

				$this->load->model('model_user');
				$user_senha = $this->model_user->busca_e($email);

				foreach($user_senha as $u_senha){
					$enha = array(
						'user_senha' => $u_senha->user_senha
					);
				}

				$user_pass = $enha['user_senha'];
				$input_senha = md5($senha);

				if($input_senha != $user_pass){
					$this->form_validation->set_message ( 'matches' , 'A senha é inválida!' );
					$this->form_validation->set_rules ( 'senha' , 'senha' , 'matches[Senha]' );
					$this->form_validation->set_error_delimiters ( '<center><div class="form-group has-error">' , '</div></center>' );
					if  ($this->form_validation->run ()  ==  FALSE ) {
						$this->load->view('view_bloqueado');
					}
				} else {

					$resultado = $this->model_user->login($email, $user_pass);

					foreach ($resultado as $user_data) {
						$config_array = array(
							'user_id' => $user_data->user_id
						);


						$this->session->unset_userdata('bloqueado');
						$this->session->set_userdata('logged_in', $config_array);

						$session = $this->session->userdata('logged_in');

						$id = $session['user_id'];
						$dados = $this->model_user->busca($id);

						foreach ($dados as $d) {
							$dado = array(
								'profile_id' => $d->profile_id,
								'semestre' => $d->semestre,
								'alter_dados' => $d->alter_dados
							);
						}

						$this->load->model("model_user");
						$session = $this->session->userdata('logged_in');
						$id = $session['user_id'];
						$data = date('d-m-Y');
						$hora = date('H:i');
						$log = array(
							'log_name' => 'Login de usuário',
							'log_descricao' => 'O usuário de id registrado realizou login.',
							'tipo' => 'Login',
							'user_id' => $id,
							'data' => $data,
							'hora' => $hora
						);
						$this->model_user->log($log);


						if ($dado['profile_id'] == 1) {
							$this->session->userdata('logged_in');
							redirect('master/inicio');
						} elseif ($dado['profile_id'] == 2) {
							$this->session->userdata('logged_in');
							redirect('administrador/inicio');
						} elseif ($dado['profile_id'] == 3) {
							$this->session->userdata('logged_in');
							redirect('gestor/inicio');
						} elseif ($dado['profile_id'] == 4) {
							$this->session->userdata('logged_in');
							redirect('professor/inicio');
						} elseif ($dado['profile_id'] == 5) {
							$this->session->userdata('logged_in');
							redirect('usuario/inicio');
						} else {
							redirect('login', 'refresh');
						}
					}
				}
			}

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	/*function nao_autorizado($dados){
		$this->load->model("model_user");
		$session = $this->session->userdata('logged_in');
		$id = $session['user_id'];
		$data = date ('d-m-Y');
		$hora = date ('H:i');
		$log = array(
			'log_name' => 'Acesso não autorizado',
			'log_descricao' => 'Usuário de id registrado tentou acessar área: '. base64_decode ($dados),
			'tipo' => 'Autorização',
			'user_id' => $id,
			'data' => $data,
			'hora' => $hora
		);
		$this->model_user->log($log);

		$dados = $this->model_user->busca($id);


		foreach ($dados as $d){
			$dado = array(
				'profile_id' => $d->profile_id,
				'semestre' => $d->semestre,
				'alter_dados' => $d->alter_dados
			);
		}

		if ( $dado[ 'profile_id' ] == 1 ) {
			$this->session->userdata ( 'logged_in' );
			redirect ( 'master/inicio' );
		}
		elseif ( $dado[ 'profile_id' ] == 2 ) {
			$this->session->userdata ( 'logged_in' );
			redirect ( 'administrador/inicio' );
		}
		elseif ( $dado[ 'profile_id' ] == 3 ) {
			$this->session->userdata ( 'logged_in' );
			redirect ( 'gestor/inicio' );
		}
		elseif ( $dado[ 'profile_id' ] == 4 ) {
			$this->session->userdata ( 'logged_in' );
			redirect ( 'professor/inicio' );
		}
		elseif ( $dado[ 'profile_id' ] == 5 ) {
			$this->session->userdata ( 'logged_in' );
			redirect ( 'usuario/inicio' );
		}
		else {
			redirect ( 'login' , 'refresh' );
		}



	}
}*/}
