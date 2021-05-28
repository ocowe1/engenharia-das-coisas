<?php
defined ( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Professor extends CI_Controller
{

	public
	function __construct ()
	{
		parent::__construct ();
		$this->load->model ( 'model_user' );
		$this->load->helper ( 'url' );
		$this->load->library ( 'form_validation' );
		$this->load->helper ( 'form' );
		date_default_timezone_set ( 'America/Sao_Paulo' );

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
			if ( $dado[ 'profile_id' ] != 4 ) {

				$dados = base64_encode ('Professor');

				redirect('p/autorizacao/verificar/'.$dados);
			}
		}
		elseif ( $this->session->userdata ( 'bloqueado' ) ) {
			//$session = $this->session->userdata ( 'bloqueado' );
			//$id = $session[ 'user_email' ];

			redirect ('bloqueado', 'refresh');
		}


	}

	public
	function index ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			redirect ( 'professor/inicio' , 'refresh' );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function inicio ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$this->load->model ( "model_professor" );
			$id = $session[ "user_id" ];
			$resultado = $this->model_professor->busca ( $id );

			$dados[ 'requisicao' ] = $resultado;

			$total_posts = $this->model_user->total_posts ();

			$this->load->library ( 'pagination' );

			$maximo = 15;
			$inicio = ( !$this->uri->segment ( "3" ) ) ? 0 : $this->uri->segment ( "3" );
			$config[ 'base_url' ] = base_url ( 'professor/feed' );
			$config[ 'total_rows' ] = $total_posts;
			$config[ 'per_page' ] = $maximo;
			$config[ 'display_pages' ] = FALSE;


			$config[ 'full_tag_open' ] = '<div class="btn-group"><nav aria-label="..."><ul class="pager">';
			$config[ 'full_tag_close' ] = '</ul></nav></div>';


			$config[ 'next_link' ] = 'Próximo';
			$config[ 'next_tag_open' ] = '<li>';
			$config[ 'next_tag_close' ] = '</li>';

			$config[ 'num_tag_open' ] = '<div>';
			$config[ 'num_tag_close' ] = '</div>';

			$config[ 'prev_link' ] = 'Voltar';
			$config[ 'prev_tag_open' ] = '<li>';
			$config[ 'prev_tag_close' ] = '</li>';

			$config[ 'first_link' ] = 'Primeiro';
			$config[ 'first_tag_open' ] = '<li>';
			$config[ 'first_tag_close' ] = '</li>';
			$config[ 'last_link' ] = 'Último';
			$config[ 'last_tag_open' ] = '<li>';
			$config[ 'last_tag_close' ] = '</li>';


			$this->pagination->initialize ( $config );

			$dados[ 'paginacao' ] = $this->pagination->create_links ();
			$dados[ "emails" ] = $this->model_professor->trazer_posts ( $maximo , $inicio );


			$dados[ 'tela' ] = 'view_feed_p';

			$this->load->view ( 'view_home_prof' , $dados );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function mensagens ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$this->load->model ( "model_professor" );
			$id = $session[ "user_id" ];

			$total_emails = $this->model_professor->recebidos_l ( $id );

			$this->load->library ( 'pagination' );

			$maximo = 10;
			$inicio = ( !$this->uri->segment ( "3" ) ) ? 0 : $this->uri->segment ( "3" );
			$config[ 'base_url' ] = base_url ( 'professor/mensagens' );
			$config[ 'total_rows' ] = $total_emails;
			$config[ 'per_page' ] = $maximo;
			$config[ 'display_pages' ] = FALSE;


			$config[ 'full_tag_open' ] = '<div class="btn-group"><nav aria-label="..."><ul class="pager">';
			$config[ 'full_tag_close' ] = '</ul></nav></div>';


			$config[ 'next_link' ] = '&gt;';
			$config[ 'next_tag_open' ] = '<li>';
			$config[ 'next_tag_close' ] = '</li>';

			$config[ 'num_tag_open' ] = '<div class="hidden">';
			$config[ 'num_tag_close' ] = '</div>';
			$config[ 'prev_link' ] = '&lt;';
			$config[ 'prev_tag_open' ] = '<li>';
			$config[ 'prev_tag_close' ] = '</li>';
			$config[ 'first_link' ] = 'Primeiro';
			$config[ 'first_tag_open' ] = '<li>';
			$config[ 'first_tag_close' ] = '</li>';
			$config[ 'last_link' ] = 'Último';
			$config[ 'last_tag_open' ] = '<li>';
			$config[ 'last_tag_close' ] = '</li>';


			$this->pagination->initialize ( $config );

			$dados[ 'paginacao' ] = $this->pagination->create_links ();
			$dados[ "emails" ] = $this->model_professor->recebidos_d ( $id , $maximo , $inicio );

			$resultado = $this->model_professor->busca ( $id );

			$dados[ 'requisicao' ] = $resultado;

			$dados[ 'tela' ] = 'view_mensagens_p';


			$this->load->view ( 'view_home_prof' , $dados );

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function feed ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$this->load->model ( "model_professor" );
			$id = $session[ "user_id" ];
			$resultado = $this->model_professor->busca ( $id );

			$dados[ 'requisicao' ] = $resultado;


			$total_posts = $this->model_user->total_posts ();

			$this->load->library ( 'pagination' );

			$maximo = 15;
			$inicio = ( !$this->uri->segment ( "3" ) ) ? 0 : $this->uri->segment ( "3" );
			$config[ 'base_url' ] = base_url ( 'professor/feed' );
			$config[ 'total_rows' ] = $total_posts;
			$config[ 'per_page' ] = $maximo;
			$config[ 'display_pages' ] = FALSE;


			$config[ 'full_tag_open' ] = '<div class="btn-group"><nav aria-label="..."><ul class="pager">';
			$config[ 'full_tag_close' ] = '</ul></nav></div>';


			$config[ 'next_link' ] = 'Próximo';
			$config[ 'next_tag_open' ] = '<li>';
			$config[ 'next_tag_close' ] = '</li>';

			$config[ 'num_tag_open' ] = '<div>';
			$config[ 'num_tag_close' ] = '</div>';

			$config[ 'prev_link' ] = 'Voltar';
			$config[ 'prev_tag_open' ] = '<li>';
			$config[ 'prev_tag_close' ] = '</li>';

			$config[ 'first_link' ] = 'Primeiro';
			$config[ 'first_tag_open' ] = '<li>';
			$config[ 'first_tag_close' ] = '</li>';
			$config[ 'last_link' ] = 'Último';
			$config[ 'last_tag_open' ] = '<li>';
			$config[ 'last_tag_close' ] = '</li>';


			$this->pagination->initialize ( $config );

			$dados[ 'paginacao' ] = $this->pagination->create_links ();
			$dados[ "emails" ] = $this->model_professor->trazer_posts ( $maximo , $inicio );


			$dados[ 'tela' ] = 'view_feed_p';


			$this->load->view ( 'view_home_prof' , $dados );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function curso ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$this->load->model ( "model_professor" );
			$id = $session[ "user_id" ];
			$resultado = $this->model_professor->busca ( $id );

			$dados[ 'requisicao' ] = $resultado;


			foreach ($resultado as $r) {
				$curso = array(
					'user_curso' => $r->user_curso
				);
			}

			$total_posts = $this->model_professor->total_p_c ( $curso[ 'user_curso' ] );

			$this->load->library ( 'pagination' );

			$maximo = 15;
			$inicio = ( !$this->uri->segment ( "3" ) ) ? 0 : $this->uri->segment ( "3" );
			$config[ 'base_url' ] = base_url ( 'professor/curso' );
			$config[ 'total_rows' ] = $total_posts;
			$config[ 'per_page' ] = $maximo;
			$config[ 'display_pages' ] = FALSE;


			$config[ 'full_tag_open' ] = '<div class="btn-group"><nav aria-label="..."><ul class="pager">';
			$config[ 'full_tag_close' ] = '</ul></nav></div>';


			$config[ 'next_link' ] = 'Próximo';
			$config[ 'next_tag_open' ] = '<li>';
			$config[ 'next_tag_close' ] = '</li>';

			$config[ 'num_tag_open' ] = '<div>';
			$config[ 'num_tag_close' ] = '</div>';

			$config[ 'prev_link' ] = 'Voltar';
			$config[ 'prev_tag_open' ] = '<li>';
			$config[ 'prev_tag_close' ] = '</li>';

			$config[ 'first_link' ] = 'Primeiro';
			$config[ 'first_tag_open' ] = '<li>';
			$config[ 'first_tag_close' ] = '</li>';
			$config[ 'last_link' ] = 'Último';
			$config[ 'last_tag_open' ] = '<li>';
			$config[ 'last_tag_close' ] = '</li>';


			$this->pagination->initialize ( $config );

			$dados[ 'paginacao' ] = $this->pagination->create_links ();
			$dados[ "emails" ] = $this->model_professor->trazer_p_c ( $maximo , $inicio , $curso[ 'user_curso' ] );

			###############################

			$dados[ 'tela' ] = 'view_curso_p';

			$this->load->view ( 'view_home_prof' , $dados );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function enviar_arquivo ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$this->load->model ( "model_professor" );
			$id = $session[ "user_id" ];
			$resultado = $this->model_professor->busca ( $id );

			$dados[ 'requisicao' ] = $resultado;

			$dados[ 'tela' ] = 'view_enviar_conteudo_p';

			$this->load->view ( 'view_home_prof' , $dados );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function enviar_texto ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$this->load->model ( "model_professor" );
			$id = $session[ "user_id" ];
			$resultado = $this->model_professor->busca ( $id );

			$dados[ 'requisicao' ] = $resultado;

			$dados[ 'tela' ] = 'view_enviar_texto_p';

			$this->load->view ( 'view_home_prof' , $dados );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function calendario ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$this->load->model ( "model_professor" );
			$id = $session[ "user_id" ];
			$resultado = $this->model_professor->busca ( $id );

			$dados[ 'requisicao' ] = $resultado;


			$this->load->model ( 'model_professor' );
			$calendar = $this->model_professor->calendar ();

			$dados[ 'calendar' ] = $calendar;
			$dados[ 'eventos' ] = $this->model_professor->meus_eventos ( $id );

			$dados[ 'tela' ] = 'view_calendario_p';

			$this->load->view ( 'view_home_prof' , $dados );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function apagar_evento ( $e_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->model ( 'model_professor' );
			$this->model_professor->apagar_evento ( $e_id );
			$this->session->flashdata ( 'sucesso' , 'Apagado com sucesso!' );
			redirect ( $_SERVER[ 'HTTP_REFERER' ] );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function contato ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$this->load->model ( "model_professor" );
			$id = $session[ "user_id" ];
			$resultado = $this->model_professor->busca ( $id );

			$dados[ 'requisicao' ] = $resultado;

			$dados[ 'tela' ] = 'view_contato_p';

			$this->load->view ( 'view_home_prof' , $dados );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function info ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$this->load->model ( "model_professor" );
			$id = $session[ "user_id" ];
			$resultado = $this->model_professor->busca ( $id );

			$dados[ 'requisicao' ] = $resultado;

			$dados[ 'tela' ] = 'view_info_p';

			$this->load->view ( 'view_home_prof' , $dados );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function membros ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$this->load->model ( "model_professor" );
			$id = $session[ "user_id" ];
			$resultado = $this->model_professor->busca ( $id );

			$dados[ 'requisicao' ] = $resultado;

			$dados[ 'tela' ] = 'view_membros_p';

			$this->load->view ( 'view_home_prof' , $dados );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function contatar ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->library ( 'form_validation' );

			$this->form_validation->set_message ( 'required' , 'Campo %s obrigatório!' );
			$this->form_validation->set_rules ( 'email' , 'email' , 'trim|required' );
			$this->form_validation->set_rules ( 'nome' , 'nome' , 'trim|required' );
			$this->form_validation->set_rules ( 'assunto' , 'assunto' , 'trim|required' );
			$this->form_validation->set_rules ( 'mensagem' , 'mensagem' , 'trim|required' );

			if ( $this->form_validation->run () == FALSE ) {
				$this->session->set_flashdata ( 'alerta' , 'Favor preencher todos os campos!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
			else {
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];

				$user_data[ 'contact_email' ] = $this->input->post ( 'email' );
				$user_data[ 'contact_name' ] = $this->input->post ( 'nome' );
				$user_data[ 'contact_assunto' ] = $this->input->post ( 'assunto' );
				$user_data[ 'contact_mensagem' ] = $this->input->post ( 'mensagem' );
				$user_data[ 'user_id' ] = $id;


				$this->load->model ( 'model_professor' );
				$return = $this->model_professor->contatar ( $user_data );

				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Contato' ,
					'log_descricao' => 'O usuario de id registrado enviou uma mensagem de contato' ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				if ( $return == true ) {
					$this->session->set_flashdata ( 'sucesso' , 'Enviado com sucesso, aguarde o retorno de nossa equipe!' );
					redirect ( $_SERVER[ 'HTTP_REFERER' ] );
				}
				else {
					$this->session->set_flashdata ( 'erro' , 'Houve um problema, tente novamente mais tarde ou nos contate pelo whatsapp! <br> <b>O número e o email podem ser encontrados nos termos de uso do site!</b>' );
					redirect ( $_SERVER[ 'HTTP_REFERER' ] );
				}
			}
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function upload_texto ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$title = $this->input->post ( 'titulo' );
			$desc = $this->input->post ( 'sobre' );
			$curso = $this->input->post ( 'curso' );
			$session = $this->session->userdata ( 'logged_in' );

			if ( empty( $title ) or empty( $desc ) or empty( $curso ) ) {
				$this->session->set_flashdata ( 'alerta' , 'Favor preencher todos os campos!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}

			date_default_timezone_set ( 'America/Sao_Paulo' );
			$date = date ( 'd-m-Y' );
			$hora = date ( 'H:i' );

			$dados = array(
				'direcionado' => $curso ,
				'conteudo' => $desc ,
				'titulo' => $title ,
				'user_id' => $session[ 'user_id' ] ,
				'tipo' => '2' ,
				'status' => 'ativo' ,
				'data' => $date ,
				'hora' => $hora
			);

			$this->load->model ( 'model_professor' );
			$this->model_professor->upar ( $dados );

			$this->load->model ( "model_professor" );
			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];
			$data = date ( 'd-m-Y' );
			$hora = date ( 'H:i' );
			$log = array(
				'log_name' => 'Upload de Texto' ,
				'log_descricao' => 'O usuario de id registrado realizou o upload de Texto' ,
				'user_id' => $id ,
				'data' => $data ,
				'hora' => $hora
			);
			$this->model_professor->log ( $log );

			$this->session->set_flashdata ( 'sucesso' , 'Seu conteúdo foi compartilhado com sucesso!' );
			redirect ( $_SERVER[ 'HTTP_REFERER' ] );

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}


	public
	function upload ()
	{
		$session = $this->session->userdata ( 'logged_in' );
		if ( $this->session->userdata ( 'logged_in' ) ) {

			$title = $this->input->post ( 'titulo' );
			$desc = $this->input->post ( 'sobre' );
			$curso = $this->input->post ( 'curso' );
			//$tag = $this->input->post('tag');

			if ( empty( $title ) or empty( $desc ) or empty( $curso ) ) {
				$this->session->set_flashdata ( 'alerta' , 'Favor preencher todos os campos!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}

			$i = str_replace ( " " , "_" , $_FILES[ 'arquivo' ][ 'name' ] );

			$configuracao = array(
				'upload_path' => realpath ( APPPATH . '../assets/upload/files/' ) ,
				'allowed_types' => "jpg|png|jpeg|pdf|rar|zip|docx|pptx" ,
				'overwrite' => FALSE ,
				'max_size' => "52428800" ,
				'file_name' => $i
			);

			$this->load->library ( 'upload' );
			$this->upload->initialize ( $configuracao );
			if ( $this->upload->do_upload ( 'arquivo' ) ) {
				date_default_timezone_set ( 'America/Sao_Paulo' );
				$date = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$i = str_replace ( " " , "_" , $_FILES[ 'arquivo' ][ 'name' ] );
				$dados = array(
					'arquivo' => $i ,
					'direcionado' => $curso ,
					'conteudo' => $desc ,
					'titulo' => $title ,
					'user_id' => $session[ 'user_id' ] ,
					'tipo' => '1' ,
					'status' => 'ativo' ,
					'data' => $date ,
					'hora' => $hora
				);


				$this->load->model ( 'model_professor' );
				$this->model_professor->upar ( $dados );

				array('upload_data' => $this->upload->data ());

				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Upload de imagem' ,
					'log_descricao' => 'O usuario de id registrado realizou o upload de imagem' ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				$this->session->set_flashdata ( 'sucesso' , 'Seu conteúdo foi compartilhado com sucesso!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
			else {
				$this->session->set_flashdata ( 'erro' , 'Tem algo de errado com o arquivo, favor tentar novamente. <br> O limite de tamanho é de 50mb e os arquivos permitidos são: jpg|png|jpeg|pdf|rar|zip|docx|pptx.' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function ler_recebido ( $mail_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			if ( $mail_id == null ) {
				redirect ( 'mensagens' ); //acrescentar mensagem de erro
			}
			else {
				$this->load->model ( 'model_professor' );
				$email = $this->model_professor->mail_recebido ( $mail_id );
				$dados[ 'email' ] = $email;
				$dados[ 'tela' ] = 'view_ler_recebido_p';

				$this->load->view ( 'view_home_prof' , $dados );
			}

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function ler_enviado ( $mail_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			if ( $mail_id == null ) {
				redirect ( 'mensagens' ); //acrescentar mensagem de erro
			}
			else {
				$this->load->model ( 'model_professor' );
				$email = $this->model_professor->mail_enviado ( $mail_id );
				$dados[ 'email' ] = $email;
				$dados[ 'tela' ] = 'view_ler_enviado_p';

				$this->load->view ( 'view_home_prof' , $dados );
			}

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function escrever ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$dados[ 'tela' ] = 'view_escrever_p';
			$this->load->view ( 'view_home_prof' , $dados );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function envio ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {

			$this->load->model ( 'model_professor' );

			$this->form_validation->set_message ( 'required' , 'Campo %s é obrigatório!' );
			$this->form_validation->set_rules ( 'emailto' , 'emailto' , 'trim|required' );
			$this->form_validation->set_rules ( 'assunto' , 'assunto' , 'trim|required' );
			$this->form_validation->set_rules ( 'mensagem' , 'mensagem' , 'trim|required' );

			if ( $this->form_validation->run () == FALSE ) {
				$this->session->set_flashdata ( 'alerta' , 'Todos os campos são obrigatórios!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
			else {
				$session = $this->session->userdata ( 'logged_in' );
				$emailto = trim($this->input->post ( 'emailto' ));

				$result = $this->model_professor->verifica ( $emailto );
				if ( isset( $result ) ) {
					$data = date ( 'd-m-Y' );
					$hora = date ( 'H:i' );
					$id = $session[ 'user_id' ];
					$dados = $this->model_professor->busca ( $id );

					foreach ($result as $res) {
						$r = array(
							'user_id' => $res->user_id ,
							'user_name' => $res->user_name ,
							'user_email' => $res->user_email
						);
					}


					foreach ($dados as $d) {
						$e = array(
							'user_id' => $d->user_id ,
							'user_name' => $d->user_name ,
							'user_email' => $d->user_email
						);
					}

					$enviado = array(
						'email_assunto' => $this->input->post ( 'assunto' ) ,
						'email_conteudo' => $this->input->post ( 'mensagem' ) ,
						'user_id_enviado' => $e[ 'user_id' ] ,
						'user_name_enviado' => $e[ 'user_name' ] ,
						'user_email_enviado' => $e[ 'user_email' ] ,
						'user_id_recebido' => $r[ 'user_id' ] ,
						'user_name_recebido' => $r[ 'user_name' ] ,
						'user_email_recebido' => $r[ 'user_email' ] ,
						'data' => $data ,
						'hora' => $hora
					);


					$recebido = array(
						'email_assunto' => $this->input->post ( 'assunto' ) ,
						'email_conteudo' => $this->input->post ( 'mensagem' ) ,
						'user_id_enviado' => $e[ 'user_id' ] ,
						'user_name_enviado' => $e[ 'user_name' ] ,
						'user_email_enviado' => $e[ 'user_email' ] ,
						'user_id_recebido' => $r[ 'user_id' ] ,
						'user_name_recebido' => $r[ 'user_name' ] ,
						'user_email_recebido' => $r[ 'user_email' ] ,
						'data' => $data ,
						'hora' => $hora
					);


					$this->db->insert ( 'email_enviado' , $enviado );
					$this->db->insert ( 'email_recebido' , $recebido );


					$this->load->model ( "model_user" );
					$session = $this->session->userdata ( 'logged_in' );
					foreach ($session as $s) {
						$id = $s[ 'user_id' ];
					}
					$data = date ( 'd-m-Y' );
					$hora = date ( 'H:i' );
					$assunto = $this->input->post ( 'assunto' );
					$emailr = $this->input->post ( 'emailto' );
					$log = array(
						'log_name' => 'Envio de mensagem' ,
						'log_descricao' => "O usuário do id registrado enviou uma mensagem de assunto " . $assunto . " para o usuario " . $emailr . " de id " . $recebido[ 'user_id_recebido' ] ,
						'user_id' => $id ,
						'data' => $data ,
						'hora' => $hora
					);
					$this->model_professor->log ( $log );

					$this->session->set_flashdata ( 'sucesso' , 'Mensagem enviada com sucesso!' );
					redirect ( $_SERVER[ 'HTTP_REFERER' ] );

				}
				else {
					$this->session->set_flashdata ( 'erro' , 'Usuário não existe no banco de dados!' );
					redirect ( $_SERVER[ 'HTTP_REFERER' ] );
				}

			}

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function perfil ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$dados[ 'tela' ] = 'view_perfil_p';
			$this->load->model ( 'model_professor' );
			$id = $session[ 'user_id' ];
			$result = $this->model_professor->busca ( $id );
			$dados[ 'user' ] = $result;
			$this->load->view ( 'view_home_prof' , $dados );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}

	}

	public
	function alterar ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );

			$dados[ 'user' ] = $this->session->userdata ( 'logged_in' );
			$dados[ 'celular' ] = $session[ 'user_celular' ];
			$dados[ 'tela' ] = 'view_alterar_p';

			$this->load->view ( 'view_home_prof' , $dados );

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function foto ()
	{
		$session = $this->session->userdata ( 'logged_in' );
		if ( $this->session->userdata ( 'logged_in' ) ) {

			$nome_arq = str_replace ( " " , "_" , $_FILES[ 'foto' ][ 'name' ] );

			$configuracao = array(
				'upload_path' => realpath ( APPPATH . '../assets/upload/profile_img/' ) ,
				'allowed_types' => 'jpg|jpeg|png' ,
				'max_size' => '52428800' ,
				'file_name' => $nome_arq
			);

			$this->load->library ( 'upload' );
			$this->upload->initialize ( $configuracao );
			if ( $this->upload->do_upload ( 'foto' ) ) {
				$nome_arq = str_replace ( " " , "_" , $_FILES[ 'foto' ][ 'name' ] );
				$img = array(
					'user_img' => $nome_arq
				);

				$id = $session[ 'user_id' ];

				$this->load->model ( 'model_professor' );
				$this->model_professor->perfil ( $id , $img );

				array('upload_data' => $this->upload->data ());

				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Imagem de perfil' ,
					'log_descricao' => 'O usuario de id registrado realizou a alteração de imagem de perfil.' ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
			else {
				$this->session->set_flashdata ( 'erro' , 'Favor verificar o tamanho da imagem, não pode ser maior que 50mb e deve ser dos formatos: PNG, JPEG e JPG!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function apagar_enviado ( $email_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			if ( $email_id != null ) {
				$this->load->model ( "model_professor" );
				$email = array(
					'email_id' => $email_id
				);


				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Apagou a mensagem enviada' ,
					'log_descricao' => 'O usuario de id registrado apagou a mensagem enviada de id ' . $email_id ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );
				$this->session->set_flashdata ( 'sucesso' , 'Apagado com sucesso!' );
				$this->model_professor->apagar_enviada ( $email );

				echo '<script>window.setTimeout("history.back(-2)");</script>';
				//redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
			else {
				$this->session->set_flashdata ( 'erro' , 'Não foi possível apagar a mensagem!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function apagar_recebido ( $email_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			if ( $email_id != null ) {
				$this->load->model ( "model_professor" );
				$email = array(
					'email_id' => $email_id
				);

				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Apagou a mensagem recebida' ,
					'log_descricao' => 'O usuario de id registrado apagou a mensagem recebida de id ' . $email_id ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				$this->session->set_flashdata ( 'sucesso' , 'Apagado com sucesso!' );
				$this->model_professor->apagar_recebida ( $email );


				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
			else {
				$this->session->set_flashdata ( 'erro' , 'Não foi possível apagar a mensagem!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function enviadas ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$this->load->model ( "model_professor" );
			$id = $session[ "user_id" ];

			$total_emails = $this->model_professor->enviados_l ( $id );

			$this->load->library ( 'pagination' );

			$maximo = 10;
			$inicio = ( !$this->uri->segment ( "3" ) ) ? 0 : $this->uri->segment ( "3" );
			$config[ 'base_url' ] = base_url ( 'professor/enviadas' );
			$config[ 'total_rows' ] = $total_emails;
			$config[ 'per_page' ] = $maximo;
			$config[ 'display_pages' ] = FALSE;


			$config[ 'full_tag_open' ] = '<div class="btn-group"><nav aria-label="..."><ul class="pager">';
			$config[ 'full_tag_close' ] = '</ul></nav></div>';


			$config[ 'next_link' ] = '&gt;';
			$config[ 'next_tag_open' ] = '<li>';
			$config[ 'next_tag_close' ] = '</li>';

			$config[ 'num_tag_open' ] = '<div class="hidden">';
			$config[ 'num_tag_close' ] = '</div>';
			$config[ 'prev_link' ] = '&lt;';
			$config[ 'prev_tag_open' ] = '<li>';
			$config[ 'prev_tag_close' ] = '</li>';
			$config[ 'first_link' ] = 'Primeiro';
			$config[ 'first_tag_open' ] = '<li>';
			$config[ 'first_tag_close' ] = '</li>';
			$config[ 'last_link' ] = 'Último';
			$config[ 'last_tag_open' ] = '<li>';
			$config[ 'last_tag_close' ] = '</li>';


			$this->pagination->initialize ( $config );

			$dados[ 'paginacao' ] = $this->pagination->create_links ();
			$dados[ "emails" ] = $this->model_professor->enviados_d ( $id , $maximo , $inicio );

			$resultado = $this->model_professor->busca ( $id );

			$dados[ 'requisicao' ] = $resultado;

			$dados[ 'tela' ] = 'view_enviadas_p';

			$this->load->view ( 'view_home_prof' , $dados );

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function responder ( $email_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			if ( $email_id != null ) {
				$dados[ 'tela' ] = 'view_responder_p';

				$this->load->model ( 'model_professor' );
				$dados[ 'emails' ] = $this->model_professor->mail_responder ( $email_id );

				$this->load->view ( 'view_home_prof' , $dados );
			}
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function resposta ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {

			$this->load->model ( 'model_professor' );

			$this->form_validation->set_message ( 'required' , 'Campo %s é obrigatório!' );
			$this->form_validation->set_rules ( 'emailto' , 'emailto' , 'trim|required' );
			$this->form_validation->set_rules ( 'assunto' , 'assunto' , 'trim|required' );
			$this->form_validation->set_rules ( 'mensagem' , 'mensagem' , 'trim|required' );

			if ( $this->form_validation->run () == FALSE ) {
				$this->session->set_flashdata ( 'erro' , 'Todos os campos são obrigatórios!' );
				redirect ( 'professor/mensagens' , 'refresh' );
			}
			else {
				$session = $this->session->userdata ( 'logged_in' );
				$emailto = $this->input->post ( 'emailto' );
				$result = $this->model_professor->verifica ( $emailto );
				if ( isset( $result ) ) {
					$data = date ( 'd-m-Y' );
					$hora = date ( 'H:i' );
					$id = $session[ 'user_id' ];
					$dados = $this->model_professor->busca ( $id );

					foreach ($result as $res) {
						$r = array(
							'user_id' => $res->user_id ,
							'user_name' => $res->user_name ,
							'user_email' => $res->user_email
						);
					}


					foreach ($dados as $d) {
						$e = array(
							'user_id' => $d->user_id ,
							'user_name' => $d->user_name ,
							'user_email' => $d->user_email
						);
					}

					$enviado = array(
						'email_assunto' => $this->input->post ( 'assunto' ) ,
						'email_conteudo' => $this->input->post ( 'mensagem' ) ,
						'user_id_enviado' => $e[ 'user_id' ] ,
						'user_name_enviado' => $e[ 'user_name' ] ,
						'user_email_enviado' => $e[ 'user_email' ] ,
						'user_id_recebido' => $r[ 'user_id' ] ,
						'user_name_recebido' => $r[ 'user_name' ] ,
						'user_email_recebido' => $r[ 'user_email' ] ,
						'data' => $data ,
						'hora' => $hora
					);


					$recebido = array(
						'email_assunto' => $this->input->post ( 'assunto' ) ,
						'email_conteudo' => $this->input->post ( 'mensagem' ) ,
						'user_id_enviado' => $e[ 'user_id' ] ,
						'user_name_enviado' => $e[ 'user_name' ] ,
						'user_email_enviado' => $e[ 'user_email' ] ,
						'user_id_recebido' => $r[ 'user_id' ] ,
						'user_name_recebido' => $r[ 'user_name' ] ,
						'user_email_recebido' => $r[ 'user_email' ] ,
						'data' => $data ,
						'hora' => $hora
					);

					$this->db->insert ( 'email_enviado' , $enviado );
					$this->db->insert ( 'email_recebido' , $recebido );

					$this->load->model ( "model_professor" );
					$session = $this->session->userdata ( 'logged_in' );
					$id = $session[ 'user_id' ];
					$data = date ( 'd-m-Y' );
					$hora = date ( 'H:i' );
					$assunto = $this->input->post ( 'assunto' );
					$recebido = $this->input->post ( 'emailto' );
					$log = array(
						'log_name' => 'Resposta de mensagem' ,
						'log_descricao' => 'O usuário do id registrado respondeu a mensagem de assunto ' . $assunto . ' para o usuario ' . $recebido ,
						'user_id' => $id ,
						'data' => $data ,
						'hora' => $hora
					);
					$this->model_user->log ( $log );

					$this->session->set_flashdata ( 'sucesso' , 'Enviado com sucesso!' );
					redirect ( $_SERVER[ 'HTTP_REFERER' ] );

				}
				else {
					$this->session->set_flashdata ( 'erro' , 'Email não existe no banco de dados!' );
					redirect ( $_SERVER[ 'HTTP_REFERER' ] );
				}

			}

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function curtir ( $p_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->model ( 'model_professor' );
			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];

			$verifica = $this->model_professor->ver_like ( $id , $p_id );

			if ( empty( $verifica ) ) {

				$this->model_professor->curtir ( $id , $p_id );

				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Curtiu publicação' ,
					'log_descricao' => 'O usuário de id registrado curtiu a publicação ' . $p_id ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				//redirect ( $_SERVER[ 'HTTP_REFERER' ] );
				echo '<script>window.history.back();</script>';
			}
			else {
				$this->model_professor->descurtir ( $id , $p_id );

				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Descurtiu publicação' ,
					'log_descricao' => 'O usuário de id registrado descurtiu a publicação ' . $p_id ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				//redirect ( $_SERVER[ 'HTTP_REFERER' ] );
				echo '<script>window.history.back();</script>';
			}
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function comentar ( $p_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->model ( 'model_professor' );
			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];


			$this->form_validation->set_message ( 'required' , 'Campo %s é obrigatório!' );
			$this->form_validation->set_rules ( 'comentario' , 'comentario' , 'required' );

			if ( $this->form_validation->run () == FALSE ) {
				$this->session->set_flashdata ( 'alerta' , 'Você precisa digitar algo para comentar!' );
			}
			else {
				$comentario = trim ( $this->input->post ( 'comentario' ) );
				$this->model_professor->comentar ( $id , $p_id , $comentario );

				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Comentou uma publicação' ,
					'log_descricao' => 'O usuário de id registrado comentou a publicação ' . $p_id . ': ' . $comentario ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
				//echo '<script>window.history.back();</script>';
			}
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function publicacao ( $p_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {


			$dados[ 'p_id' ] = $p_id;

			//die();
			$this->load->view ( 'template/prof/header' );
			$this->load->view ( 'template/prof/topbar' );
			$this->load->view ( 'template/prof/sidebar' );
			$this->load->view ( 'template/prof/configbar' );

			$this->load->view ( 'telas/professor/view_publicacao_p' , $dados );

			$this->load->view ( 'template/prof/footer' );
			$this->load->view ( 'template/prof/controlbar' );
			$this->load->view ( 'template/prof/js' );

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function responder_c ( $p_id , $c_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];
			$data = date ( 'd-m-Y' );
			$hora = date ( 'H:i' );
			$resposta = array(
				'resposta' => trim ( $this->input->post ( 'resposta_c' ) ) ,
				'user_id' => $id ,
				'publicacao_id' => $p_id ,
				'comentario_id ' => $c_id ,
				'data' => $data ,
				'hora' => $hora
			);

			$this->load->model ( 'model_user' );
			$this->model_professor->responder_c ( $resposta );

			$log = array(
				'log_name' => 'Respondeu um comentário' ,
				'log_descricao' => 'Usuário de id registrado respondeu ao comentário de id: ' . $c_id . ' - ' . trim ( $this->input->post ( 'resposta_c' ) ) ,
				'tipo' => 'Comentário' ,
				'user_id' => $id ,
				'data' => $data ,
				'hora' => $hora
			);
			$this->model_user->log ( $log );
			$this->session->set_flashdata ( 'sucesso' , 'Enviado com sucesso!' );
			redirect ( $_SERVER[ 'HTTP_REFERER' ] );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function reportar ( $e_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->model ( "model_professor" );
			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];
			$data = date ( 'd-m-Y' );
			$hora = date ( 'H:i' );
			$log = array(
				'log_name' => 'Reportação' ,
				'log_descricao' => 'O usuário de id registrado reportou a mensagem de id: ' . $e_id ,
				'user_id' => $id ,
				'tipo' => 'Reportação' ,
				'data' => $data ,
				'hora' => $hora
			);
			$this->model_professor->log ( $log );


			$this->session->set_flashdata ( 'sucesso' , 'A mensagem foi reportada, aguarde o retorno da nossa equipe!' );
			//redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			echo '<script>window.setTimeout("history.back(-2)");</script>';

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function download ( $p_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->helper ( 'download' );

			$this->load->model ( 'model_professor' );
			$dados = $this->model_professor->arquivo ( $p_id );
			foreach ($dados as $d) {
				$arquivo = array(
					'arquivo' => $d->arquivo
				);
			}

			$data = file_get_contents ( base_url ( 'assets/upload/files/' . $arquivo[ 'arquivo' ] ) ); // Read the file's contents
			$name = $arquivo[ 'arquivo' ];

			$this->load->model ( "model_professor" );
			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];
			$date = date ( 'd-m-Y' );
			$hora = date ( 'H:i' );
			$log = array(
				'log_name' => 'Download de arquivo' ,
				'log_descricao' => 'O usuário de id registrado realizou o download da publicação: ' . $p_id ,
				'tipo' => 'Download' ,
				'user_id' => $id ,
				'data' => $date ,
				'hora' => $hora
			);
			$this->model_professor->log ( $log );

			force_download ( $name , $data );


			echo '<script>window.setTimeout("history.back(-2)");</script>';
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function termos ()
	{
		$this->load->helper ( 'download' );
		$data = file_get_contents ( base_url ( "assets/upload/Termos.pdf" ) ); // Read the file's contents
		$name = "Termos_EDC.pdf";
		$this->load->model ( "model_user" );

		if ( $this->session->userdata ( 'logged_in' ) ) {
			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];
		}

		$date = date ( 'd-m-Y' );
		$hora = date ( 'H:i' );

		if ( isset( $_SERVER[ 'HTTP_CLIENT_IP' ] ) ) {
			$ip = $_SERVER[ 'HTTP_CLIENT_IP' ];
		}
		else if ( isset( $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] ) ) {
			$ip = $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
		}
		else if ( isset( $_SERVER[ 'HTTP_X_FORWARDED' ] ) ) {
			$ip = $_SERVER[ 'HTTP_X_FORWARDED' ];
		}
		else if ( isset( $_SERVER[ 'HTTP_FORWARDED_FOR' ] ) ) {
			$ip = $_SERVER[ 'HTTP_FORWARDED_FOR' ];
		}
		else if ( isset( $_SERVER[ 'HTTP_FORWARDED' ] ) ) {
			$ipa = $_SERVER[ 'HTTP_FORWARDED' ];
		}
		else if ( isset( $_SERVER[ 'REMOTE_ADDR' ] ) ) {
			$ip = $_SERVER[ 'REMOTE_ADDR' ];
		}
		else {
			$ip = 'UNKNOWN';
		}

		if ( !empty( $id ) ) {
			$id = $id;
		}
		else {
			$id = '0';
		}

		$log = array(
			'log_name' => 'Termos baixados' ,
			'log_descricao' => 'Os termos de usuário foram baixados pelo ip: ' . $ip ,
			'tipo' => 'Download de termos.' ,
			'user_id' => $id ,
			'data' => $date ,
			'hora' => $hora
		);
		$this->model_user->log ( $log );

		force_download ( $name , $data );

		echo '<script>window.setTimeout("history.back(-2)");</script>';
	}

	public
	function pesquisar ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->model ( "model_user" );
			$pesquisa = trim ( $this->input->post ( 'pesquisar' ) );
			$resultado = $this->model_user->pesquisa ( $pesquisa );


			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];
			$data = date ( 'd-m-Y' );
			$hora = date ( 'H:i' );
			$log = array(
				'log_name' => 'Pesquisou' ,
				'log_descricao' => 'Usuário de id registrado realizou a pesquisa de: ' . $pesquisa ,
				'tipo' => 'Pesquisa' ,
				'user_id' => $id ,
				'data' => $data ,
				'hora' => $hora
			);
			$this->model_user->log ( $log );

			$pesquisa = trim ( $this->input->post ( 'pesquisar' ) );

			$total_pesquisa = $this->model_user->pesquisa_l ( $pesquisa );

			$this->load->library ( 'pagination' );

			$maximo = 10;
			$inicio = ( !$this->uri->segment ( "3" ) ) ? 0 : $this->uri->segment ( "3" );
			$config[ 'base_url' ] = base_url ( 'usuario/pesquisa' );
			$config[ 'total_rows' ] = $total_pesquisa;
			$config[ 'per_page' ] = $maximo;
			$config[ 'display_pages' ] = FALSE;


			$config[ 'full_tag_open' ] = '<div class="btn-group"><nav aria-label="..."><ul class="pager">';
			$config[ 'full_tag_close' ] = '</ul></nav></div>';


			$config[ 'next_link' ] = '&gt;';
			$config[ 'next_tag_open' ] = '<li>';
			$config[ 'next_tag_close' ] = '</li>';

			$config[ 'num_tag_open' ] = '<div class="hidden">';
			$config[ 'num_tag_close' ] = '</div>';
			$config[ 'prev_link' ] = '&lt;';
			$config[ 'prev_tag_open' ] = '<li>';
			$config[ 'prev_tag_close' ] = '</li>';
			$config[ 'first_link' ] = 'Primeiro';
			$config[ 'first_tag_open' ] = '<li>';
			$config[ 'first_tag_close' ] = '</li>';
			$config[ 'last_link' ] = 'Último';
			$config[ 'last_tag_open' ] = '<li>';
			$config[ 'last_tag_close' ] = '</li>';


			$this->pagination->initialize ( $config );

			$dados[ 'paginacao' ] = $this->pagination->create_links ();
			$dados[ "pesquisa" ] = $this->model_user->pesquisa_d ( $pesquisa , $maximo , $inicio );

			//$dados['pesquisa'] = $resultado;

			$this->load->model ( "model_user" );
			$this->load->view ( 'template/user/header' );
			$this->load->view ( 'template/user/topbar' );
			$this->load->view ( 'template/user/sidebar' );
			$this->load->view ( 'template/user/configbar' );

			$this->load->view ( 'telas/user/view_resultado_p' , $dados );

			$this->load->view ( 'template/user/footer' );
			$this->load->view ( 'template/user/controlbar' );
			$this->load->view ( 'template/user/js' );

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}

	}

	public
	function bloquear ( $p_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->model ( 'model_professor' );

			$this->load->model ( 'model_professor' );

			$status = $this->model_professor->p_dados ( $p_id );

			foreach ($status as $s) {
				$st = array(
					'status' => $s->status
				);
			}

			if ( $st[ 'status' ] === 'bloqueado' ) {

				$this->model_professor->ativar_publi ( $p_id );

				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Liberou conteúdo' ,
					'log_descricao' => 'A publicação de id:' . $p_id . ', foi liberada pelo usuario de id registrado.' ,
					'tipo' => 'Ativação' ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				$this->session->set_flashdata ( 'sucesso' , 'A publicação foi ativada!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );

			}
			else {

				$this->model_professor->bloquear ( $p_id );


				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Bloqueio de conteúdo' ,
					'log_descricao' => 'A publicação de id:' . $p_id . ', foi bloqueada pelo usuario de id registrado.' ,
					'tipo' => 'Bloqueio' ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				$this->session->set_flashdata ( 'sucesso' , 'O conteúdo foi bloqueado!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function excluir ( $p_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->model ( 'model_professor' );


			$this->model_professor->excluir ( $p_id );


			$this->load->model ( "model_professor" );
			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];
			$data = date ( 'd-m-Y' );
			$hora = date ( 'H:i' );
			$log = array(
				'log_name' => 'Exclusão de conteúdo' ,
				'log_descricao' => 'A publicação de id:' . $p_id . ', foi excluida pelo usuario de id registrado.' ,
				'tipo' => 'Exclusão' ,
				'user_id' => $id ,
				'data' => $data ,
				'hora' => $hora
			);
			$this->model_professor->log ( $log );

			$this->session->set_flashdata ( 'sucesso' , 'O conteúdo foi excluído!' );
			//redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			redirect ( 'professor/feed' , 'refresh' );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function ocultar ( $p_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->model ( 'model_professor' );

			$status = $this->model_professor->p_dados ( $p_id );

			foreach ($status as $s) {
				$st = array(
					'status' => $s->status
				);
			}

			if ( $st[ 'status' ] === 'oculto' ) {

				$this->model_professor->ativar_publi ( $p_id );

				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Liberou conteúdo' ,
					'log_descricao' => 'A publicação de id:' . $p_id . ', foi liberada pelo usuario de id registrado.' ,
					'tipo' => 'Ativação' ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				$this->session->set_flashdata ( 'sucesso' , 'A publicação foi ativada!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );

			}
			else {


				$this->model_professor->ocultar ( $p_id );


				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Ocultação de conteúdo' ,
					'log_descricao' => 'A publicação de id:' . $p_id . ', foi ocultada pelo usuario de id registrado.' ,
					'tipo' => 'Ocultação' ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				$this->session->set_flashdata ( 'sucesso' , 'O conteúdo foi oculto!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function conteudo ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {

			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];

			$this->load->model ( 'model_professor' );
			$disciplinas[ 'disciplinas' ] = $this->model_professor->disciplinas ( $id );

			$this->load->view ( 'template/prof/header' );
			$this->load->view ( 'template/prof/topbar' );
			$this->load->view ( 'template/prof/sidebar' );
			$this->load->view ( 'template/prof/configbar' );

			$this->load->view ( 'telas/professor/view_meu_conteudo' , $disciplinas );

			$this->load->view ( 'template/prof/footer' );
			$this->load->view ( 'template/prof/controlbar' );
			$this->load->view ( 'template/prof/js' );

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function nova_disciplina ()
	{

		if ( $this->session->userdata ( 'logged_in' ) ) {

			$disciplina = trim ( $this->input->post ( 'disciplina' ) );

			if ( empty( $disciplina ) ) {
				$this->session->flashdata ( 'alerta' , 'Você precisa digitar o nome da disciplina para poder adiciona-la!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
				//echo '<script>window.setTimeout("history.back(-2)");</script>';

			}
			else {
				$this->load->model ( 'model_professor' );

				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Nova Disciplina' ,
					'log_descricao' => 'O professor de id registrado adicionou uma nova disciplina com o nome de: ' . $disciplina ,
					'tipo' => 'Disciplina' ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);

				$dados = array(
					'disciplina' => $disciplina ,
					'professor_id' => $id
				);


				$this->model_professor->nova_disciplina ( $dados );
				$this->model_professor->log ( $log );

				$this->session->flashdata ( 'sucesso' , 'Disciplina adicionada com sucesso!' );

				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}

	}

	public
	function disciplina ( $d_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {

			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];

			$this->load->model ( 'model_professor' );
			$disciplinas[ 'disciplinas' ] = $this->model_professor->disciplinas ( $id );

			//$disciplinas['conteudo'] = $this->model_professor->conteudo($d_id);

			$disciplinas[ 'd_id' ] = $d_id;


			$total_emails = $this->model_professor->conteudo_l ( $d_id );

			$this->load->library ( 'pagination' );

			$maximo = 15;
			$inicio = ( !$this->uri->segment ( "4" ) ) ? 0 : $this->uri->segment ( "4" );
			$config[ "uri_segment" ] = 4;
			$config[ 'base_url' ] = base_url ( 'p/disciplina/' . $d_id . '/' );
			$config[ 'total_rows' ] = $total_emails;
			$config[ 'per_page' ] = $maximo;
			$config[ 'display_pages' ] = FALSE;

			//$config['use_page_numbers'] = FALSE;

			$config[ 'full_tag_open' ] = '<div class="btn-group"><nav aria-label="..."><ul class="pager">';
			$config[ 'full_tag_close' ] = '</ul></nav></div>';


			$config[ 'next_link' ] = '&gt;';
			$config[ 'next_tag_open' ] = '<li>';
			$config[ 'next_tag_close' ] = '</li>';

			$config[ 'num_tag_open' ] = '<div class="hidden">';
			$config[ 'num_tag_close' ] = '</div>';
			$config[ 'prev_link' ] = '&lt;';
			$config[ 'prev_tag_open' ] = '<li>';
			$config[ 'prev_tag_close' ] = '</li>';
			$config[ 'first_link' ] = 'Primeiro';
			$config[ 'first_tag_open' ] = '<li>';
			$config[ 'first_tag_close' ] = '</li>';
			$config[ 'last_link' ] = 'Último';
			$config[ 'last_tag_open' ] = '<li>';
			$config[ 'last_tag_close' ] = '</li>';


			$this->pagination->initialize ( $config );

			$disciplinas[ 'paginacao' ] = $this->pagination->create_links ();
			$disciplinas[ "conteudo" ] = $this->model_professor->conteudo_d ( $d_id , $maximo , $inicio );

			$this->load->view ( 'template/prof/header' );
			$this->load->view ( 'template/prof/topbar' );
			$this->load->view ( 'template/prof/sidebar' );
			$this->load->view ( 'template/prof/configbar' );

			$this->load->view ( 'telas/professor/view_meu_conteudo' , $disciplinas );

//			$arr_footer['arr_js'] = ['professor.js'];

			$this->load->view ( 'template/prof/footer' /*,$arr_footer*/ );
			$this->load->view ( 'template/prof/controlbar' );
			$this->load->view ( 'template/prof/js' );

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function novo_conteudo ( $d_id )
	{

		if ( $this->session->userdata ( 'logged_in' ) ) {

			$title = $this->input->post ( 'titulo' );
			$desc = $this->input->post ( 'sobre' );

			if ( empty( $title ) or empty( $desc ) ) {
				$this->session->set_flashdata ( 'alerta' , 'Favor preencher todos os campos!' );
				redirect ( 'p/n/disciplina' , 'refresh' );
			}

			$i = str_replace ( " " , "_" , $_FILES[ 'arquivo' ][ 'name' ] );


			$configuracao = array(
				'upload_path' => realpath ( APPPATH . '../assets/upload/prof_files/' ) ,
				'allowed_types' => "jpg|png|jpeg|pdf|rar|zip|docx|pptx" ,
				'overwrite' => FALSE ,
				'max_size' => "52428800" ,
				'file_name' => $i
			);
			$this->load->library ( 'upload' );
			$this->upload->initialize ( $configuracao );
			if ( $this->upload->do_upload ( 'arquivo' ) ) {
				date_default_timezone_set ( 'America/Sao_Paulo' );
				$date = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$i = str_replace ( " " , "_" , $_FILES[ 'arquivo' ][ 'name' ] );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$dados = array(
					'arquivo' => $i ,
					'conteudo_nome' => $title ,
					'conteudo_desc' => $desc ,
					'status' => 'ativo' ,
					'disciplina_id' => $d_id ,
					'professor_id' => $id ,
					'data' => $date ,
					'hora' => $hora
				);

				$this->load->model ( 'model_professor' );
				$this->model_professor->upar_conteudo ( $dados );

				array('upload_data' => $this->upload->data ());

				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Upload de conteúdo' ,
					'log_descricao' => 'O professor de id registrado realizou o upload de conteúdo' ,
					'user_id' => $id ,
					'tipo' => 'Conteúdo' ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );
				$this->session->set_flashdata ( 'sucesso' , 'Seu conteúdo foi compartilhado com sucesso!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
			else {
				$this->session->set_flashdata ( 'erro' , 'Tem algo de errado com o arquivo, favor tentar novamente. <br> O limite de tamanho é de 50mb e os arquivos permitidos são: jpg|png|jpeg|pdf|rar|zip|docx|pptx.' );
				redirect ( 'p/n/disciplina' , 'refresh' );
			}

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}

	}

	public
	function excluir_conteudo ( $c_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->model ( 'model_professor' );

			$this->model_professor->excluir_conteudo ( $c_id );


			$this->load->model ( "model_professor" );
			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];
			$data = date ( 'd-m-Y' );
			$hora = date ( 'H:i' );
			$log = array(
				'log_name' => 'Exclusão de conteúdo' ,
				'log_descricao' => 'O arquivo de id:' . $c_id . ', foi excluida pelo usuario de id registrado.' ,
				'tipo' => 'Exclusão' ,
				'user_id' => $id ,
				'data' => $data ,
				'hora' => $hora
			);
			$this->model_professor->log ( $log );

			$this->session->set_flashdata ( 'sucesso' , 'O conteúdo foi excluído!' );
			redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			//redirect ( 'professor/feed' , 'refresh' );
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function ocultar_conteudo ( $c_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->model ( 'model_professor' );

			$conteudo_dados = $this->model_professor->c_arquivo ( $c_id );

			foreach ($conteudo_dados as $c_dados) {
				$c = array(
					'status' => $c_dados->status
				);
			}
			if ( $c[ 'status' ] === 'oculto' ) {

				$this->model_professor->ativar_conteudo ( $c_id );

				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Liberou conteúdo' ,
					'log_descricao' => 'O arquivo de id:' . $c_id . ', foi liberado pelo usuario de id registrado.' ,
					'tipo' => 'Ocultação' ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				$this->session->set_flashdata ( 'sucesso' , 'O conteúdo foi ativado!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );

			}
			else {
				$this->model_professor->ocultar_conteudo ( $c_id );


				$this->load->model ( "model_professor" );
				$session = $this->session->userdata ( 'logged_in' );
				$id = $session[ 'user_id' ];
				$data = date ( 'd-m-Y' );
				$hora = date ( 'H:i' );
				$log = array(
					'log_name' => 'Ocultação de conteúdo' ,
					'log_descricao' => 'O arquivo de id:' . $c_id . ', foi oculto pelo usuario de id registrado.' ,
					'tipo' => 'Ocultação' ,
					'user_id' => $id ,
					'data' => $data ,
					'hora' => $hora
				);
				$this->model_professor->log ( $log );

				$this->session->set_flashdata ( 'sucesso' , 'O conteúdo foi oculto!' );
				redirect ( $_SERVER[ 'HTTP_REFERER' ] );
			}
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function c_download ( $c_id )
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->helper ( 'download' );

			$this->load->model ( 'model_professor' );
			$dados = $this->model_professor->c_arquivo ( $c_id );
			foreach ($dados as $d) {
				$arquivo = array(
					'arquivo' => $d->arquivo
				);
			}

			$data = file_get_contents ( base_url ( 'assets/upload/prof_files/' . $arquivo[ 'arquivo' ] ) ); // Read the file's contents
			$name = $arquivo[ 'arquivo' ];

			$this->load->model ( "model_professor" );
			$session = $this->session->userdata ( 'logged_in' );
			$id = $session[ 'user_id' ];
			$date = date ( 'd-m-Y' );
			$hora = date ( 'H:i' );
			$log = array(
				'log_name' => 'Download de arquivo' ,
				'log_descricao' => 'O usuário de id registrado realizou o download de conteúdo: ' . $c_id ,
				'tipo' => 'Download' ,
				'user_id' => $id ,
				'data' => $date ,
				'hora' => $hora
			);
			$this->model_professor->log ( $log );

			force_download ( $name , $data );


			echo '<script>window.setTimeout("history.back(-2)");</script>';
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	public
	function evento ()
	{
		if ( $this->session->userdata ( 'logged_in' ) ) {
			$this->load->helper ( array('form' , 'url') );

			$this->form_validation->set_message ( 'required' , 'Campo %s é obrigatório!' );
			$this->form_validation->set_rules ( 'titulo' , 'Titulo' , 'trim|required' );
			$this->form_validation->set_rules ( 'dia' , 'dia' , 'trim|required|max_length[2]' );
			$this->form_validation->set_rules ( 'mes' , 'mês' , 'trim|required|max_length[2]' );
			$this->form_validation->set_error_delimiters ( '<center><div class="form-group has-error">' , '</div></center>' );

			if ( $this->form_validation->run () == FALSE ) {
				$dados[ 'tela' ] = 'view_calendario_p';
				$this->load->view ( 'view_home_prof' , $dados );
			}
			else {
				$session = $this->session->userdata ( 'logged_in' );

				$id = $session[ 'user_id' ];
				$titulo = $this->input->post ( 'titulo' );
				$dia = $this->input->post ( 'dia' );
				$mes = $this->input->post ( 'mes' );
				$ano = date ( 'Y' );

				$cmd = array(
					'calendar_day' => $dia ,
					'calendar_month' => $mes ,
					'calendar_year' => $ano ,
					'calendar_name' => $titulo ,
					'user_id' => $id
				);

				$this->db->insert ( 'calendar' , $cmd );

				redirect ( 'p/calendario' , 'refresh' );

			}
		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}
	}

	/*

----------------------------------------------------------------------------------------------------------------------



		$this->load->model("model_professor");
		$session = $this->session->userdata('logged_in');
		$id = $session['user_id'];
		$data = date ('d-m-Y');
		$hora = date ('H:i');
		$log = array(
			'log_name' => '',
			'log_descricao' => '',
			'tipo' => '',
			'user_id' => $id,
			'data' => $data,
			'hora' => $hora
		);
		$this->model_professor->log($log);





----------------------------------------------------------------------------------------------------------------------



	$this->session->set_flashdata('sucesso','Seu conteúdo foi compartilhado com sucesso!');




----------------------------------------------------------------------------------------------------------------------


	 echo '<script>window.setTimeout("history.back(-2)");</script>';
	  redirect ( $_SERVER[ 'HTTP_REFERER' ] );



----------------------------------------------------------------------------------------------------------------------



		if ( $this->session->userdata ( 'logged_in' ) ) {

		}
		else {
			redirect ( 'login' , 'refresh' );
			session_destroy ();
			die();
		}



----------------------------------------------------------------------------------------------------------------------

	$session = $this->session->userdata ( 'logged_in' );

		$id = $session['user_id'];
		$this->load->model('model_user');
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




	*/

}




