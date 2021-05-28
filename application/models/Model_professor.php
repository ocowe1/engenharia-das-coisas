<?php
defined ( 'BASEPATH' ) OR exit( 'No direct script access allowed' );


class Model_professor extends CI_Model
{

	function login ( $email , $senha )
	{
		$this->db->select ( '*' );
		$this->db->from ( 'users' );
		$this->db->where ( 'user_email' , $email );
		$this->db->where ( 'user_senha' , $senha );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		if ( $query->num_rows () == 1 ) {
			return $query->result ();
		}
		else {
			return false;
		}
	}

	function busca ( $id )
	{

		$this->db->select ( '*' );
		$this->db->from ( 'users' );
		$this->db->where ( 'user_id' , $id );
		$query = $this->db->get ();
		if ( $query->num_rows () == 1 ) {
			return $query->result ();
		}
		else {
			return false;
		}

	}

	function cadastrar ( $user_data )
	{
		$this->db->insert ( 'users' , $user_data );
		return true;

	}

	function verificar ( $email )
	{
		$this->db->select ( '*' );
		$this->db->from ( 'users' );
		$this->db->where ( 'user_email' , $email );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		if ( $query->num_rows () == 1 ) {
			return true;
		}
	}

	function verifica ( $email )
	{
		$this->db->select ( '*' );
		$this->db->from ( 'users' );
		$this->db->where ( 'user_email' , $email );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		if ( $query->num_rows () == 1 ) {
			return $query->result ();
		}
	}

	function validar ( $token , $validar )
	{
		$this->db->select ( '*' );
		$this->db->from ( 'users' );
		$this->db->where ( 'user_token' , $token );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		if ( $query->num_rows () == 1 ) {
			$this->db->set ( $validar );
			$this->db->where ( 'user_token' , $token );
			$done = $this->db->update ( 'users' );

			if ( $done == TRUE ) {
				return $query->result ();
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}

	}

	function contatar ( $user_data )
	{
		if ( $this->db->insert ( 'contato' , $user_data ) == TRUE ) {
			return true;
		}
		else {
			return false;
		}
	}

	function users ()
	{
		$this->db->select ( '*' );
		$this->db->from ( 'users' );
		$query = $this->db->get ();
		return $query->result ();
	}

	function calendar ()
	{
		$this->db->select ( '*' );
		$this->db->from ( 'calendar' );
		$query = $this->db->get ();
		return $query->result ();
	}

	function mail_get ( $mail_id )
	{
		$this->db->select ( '*' );
		$this->db->from ( 'email_enviado' );
		$this->db->where ( 'email_id' , $mail_id );
		$query = $this->db->get ();
		return $query->result ();
	}

	function mail_enviado ( $mail_id )
	{
		$this->db->select ( '*' );
		$this->db->from ( 'email_enviado' );
		$this->db->where ( 'email_id' , $mail_id );
		$query = $this->db->get ();
		return $query->result ();
	}

	function mail_recebido ( $mail_id )
	{
		$this->db->select ( '*' );
		$this->db->from ( 'email_recebido' );
		$this->db->where ( 'email_id' , $mail_id );
		$query = $this->db->get ();
		return $query->result ();
	}

	function mail_responder ( $mail_id )
	{
		$this->db->select ( '*' );
		$this->db->from ( 'email_recebido' );
		$this->db->where ( 'email_id' , $mail_id );
		$query = $this->db->get ();
		return $query->result ();
	}


	function recebidos ( $id , $qtde = null , $inicio = null )
	{

		$this->db->select ( '*' );
		$this->db->from ( 'email_recebido' );
		$this->db->where ( 'user_id_recebido' , $id );
		$this->db->limit ( $qtde , $inicio );
		$query = $this->db->get ();
		return $query->result ();

	}

	public
	function recebidos_l ( $id )
	{
		$this->db->where ( 'user_id_recebido' , $id );
		return $this->db->count_all_results ( 'email_recebido' );
	}

	public
	function recebidos_d ( $id , $maximo , $inicio )
	{
		$this->db->order_by ( "email_id" , "desc" );
		$query = $this->db->get_where ( 'email_recebido' , array('user_id_recebido' => $id) , $maximo , $inicio );
		return $query->result ();
	}


	public
	function enviadas ( $id )
	{
		$this->db->select ( '*' );
		$this->db->from ( 'email_enviado' );
		$this->db->where ( 'user_id_enviado' , $id );
		$query = $this->db->get ();
		return $query->result ();
	}

	public
	function enviados_l ( $id )
	{
		$this->db->where ( 'user_id_recebido' , $id );
		return $this->db->count_all_results ( 'email_recebido' );
	}

	public
	function total_posts ()
	{

		return $this->db->count_all_results ( 'publicacoes' );
	}

	public
	function enviados_d ( $id , $maximo , $inicio )
	{
		$this->db->order_by ( "email_id" , "desc" );
		$query = $this->db->get_where ( 'email_enviado' , array('user_id_enviado' => $id) , $maximo , $inicio );
		return $query->result ();
	}

	public
	function trazer_posts ( $maximo , $inicio )
	{
		$this->db->order_by ( "publicacao_id" , "desc" );
		$this->db->where ( 'status !=' , 'inativo' );
		$this->db->where ( 'status !=' , 'excluido' );
		$query = $this->db->get ( 'publicacoes' , $maximo , $inicio );
		return $query->result ();
	}


	public
	function perfil ( $id , $img )
	{
		$this->db->where ( 'user_id' , $id );
		$this->db->update ( 'users' , $img );
		return true;
	}

	public
	function upar ( $dados )
	{
		$this->db->insert ( 'publicacoes' , $dados );
		return true;
	}

	public
	function apagar_enviada ( $email )
	{
		$this->db->delete ( 'email_enviado' , $email );
		redirect ( 'usuario/mensagens' );
		return true;
	}

	public
	function apagar_recebida ( $email )
	{
		$this->db->delete ( 'email_recebido' , $email );
		redirect ( 'usuario/mensagens' );
		return true;
	}

	public
	function log ( $log )
	{
		$this->db->insert ( 'log' , $log );
		return true;
	}

	public
	function posts ()
	{
		$query = $this->db->query ( 'select * from publicacoes order by publicacao_id desc' );
		return $query->result ();
	}

	public
	function curtir ( $id , $p_id )
	{
		date_default_timezone_set ( 'America/Sao_Paulo' );
		$date = date ( 'd-m-Y' );
		$hora = date ( 'H:i' );
		$query = array(
			'user_id' => $id ,
			'publicacao_id' => $p_id ,
			'data' => $date ,
			'hora' => $hora
		);
		$this->db->insert ( 'curtidas' , $query );
		return true;
	}

	public
	function descurtir ( $id , $p_id )
	{
		$this->db->query ( "delete from curtidas where user_id = '$id' and publicacao_id = '$p_id'" );
		return true;
	}

	public
	function ver_like ( $id , $p_id )
	{
		$query = $this->db->query ( "select * from curtidas where user_id = '$id' and publicacao_id = '$p_id'" );
		return $query->result ();
		//return $this->db->count_all_results ();
	}

	public
	function l_contagem ( $p_id )
	{
		$this->db->select ( '*' );
		$this->db->from ( 'curtidas' );
		$this->db->where ( 'publicacao_id' , $p_id );
		return $this->db->count_all_results ();
	}

	public
	function c_contagem ( $p_id )
	{
		$this->db->select ( '*' );
		$this->db->from ( 'comentarios' );
		$this->db->where ( 'publicacao_id' , $p_id );
		return $this->db->count_all_results ();
	}

	public
	function comentar ( $id , $p_id , $comentario )
	{
		date_default_timezone_set ( 'America/Sao_Paulo' );
		$date = date ( 'd-m-Y' );
		$hora = date ( 'H:i' );
		$query = array(
			'user_id' => $id ,
			'publicacao_id' => $p_id ,
			'comentario' => $comentario ,
			'data' => $date ,
			'hora' => $hora
		);
		$this->db->insert ( 'comentarios' , $query );
		return true;
	}

	public
	function c_destaque ( $p_id )
	{
		$query = $this->db->query ( "select * from comentarios where publicacao_id = '$p_id' order by comentario_id desc limit 1" );
		return $query->result ();
	}

	public
	function post ( $p_id )
	{
		$query = $this->db->query ( "select * from publicacoes where publicacao_id = '$p_id' " );
		return $query->result ();
	}

	public
	function all_comentarios ( $p_id )
	{
		$query = $this->db->query ( "select * from comentarios where publicacao_id = '$p_id' order by comentario_id asc" );
		return $query->result ();
	}

	public
	function resposta ( $p_id , $c_id )
	{
		$query = $this->db->query ( "select * from resp_comentario where publicacao_id = '$p_id' and comentario_id = '$c_id' order by resp_id asc" );
		return $query->result ();
	}

	public
	function responder_c ( $resposta )
	{
		$this->db->insert ( 'resp_comentario' , $resposta );
		return true;
	}

	public
	function arquivo ( $p_id )
	{
		$query = $this->db->query ( "select arquivo from publicacoes where publicacao_id = '$p_id'" );
		return $query->result ();
	}

	public
	function trazer_p_c ( $maximo , $inicio , $curso )
	{
		$this->db->order_by ( "publicacao_id" , "desc" );
		//$this->db->where('direcionado', $curso);
		//$query = $this->db->get ( 'publicacoes' , $maximo , $inicio );
		$query = $this->db->get_where ( 'publicacoes' , array('direcionado' => $curso) , $maximo , $inicio );
		return $query->result ();
	}

	public
	function total_p_c ( $curso )
	{
		$this->db->where ( 'direcionado' , $curso );
		return $this->db->count_all_results ( 'publicacoes' );
		//$query = $this->db->query("select direcionado count(where direcionado = '$curso')");
	}

	public
	function pesquisa ( $pesquisa )
	{

		$query = $this->db->query ( "select * from publicacoes where titulo like '%' '$pesquisa' '%' and conteudo like '%' '$pesquisa' '%'" );
		return $query->result ();
	}

	public
	function pesquisa_l ( $pesquisa )
	{
		//$query = $this->db->get_where ( 'publicacoes' , array('titulo' => '%'.$pesquisa.'%'));

		$this->db->query ( "select * from publicacoes where titulo like '%' '$pesquisa' '%' and conteudo like '%' '$pesquisa' '%'" );
		return $this->db->count_all_results ( 'publicacoes' );


		//  // Produces an integer, like 25
		//$this->db->count_all_results('publicacoes');
		//$this->db->like('titulo', $pesquisa, 'both');
		//$this->db->like('conteudo', $pesquisa, 'both');
		//$this->db->from('publicacoes');
		//return $this->db->count_all_results('publicacoes');


		//$this->db->like('conteudo', $pesquisa, 'both');
		//return $this->db->count_all_results ('publicacoes');


	}

	public
	function pesquisa_d ( $pesquisa , $maximo , $inicio )
	{
		$this->db->order_by ( 'publicacao_id' , 'DESC' );
		$this->db->like ( 'titulo' , $pesquisa , 'both' );
		$this->db->like ( 'conteudo' , $pesquisa , 'both' );
		$this->db->limit ( $maximo , $inicio );
		$this->db->from ( 'publicacoes' );
		$query = $this->db->get ();
		return $query->result ();


		//$this->db->order_by ( "publicacao_id" , "desc" );
		//$query = $this->db->get_where ( 'publicacoes' , array('titulo' => '%'.$pesquisa.'%', 'conteudo' => '%'.$pesquisa.'%') , $maximo , $inicio );
		//return $query->result ();
	}

	public
	function bloquear ( $p_id )
	{
		$this->db->query ( "update publicacoes set status = 'bloqueado' where publicacao_id = '$p_id'" );
		return true;
	}

	public
	function excluir ( $p_id )
	{
		$this->db->query ( "update publicacoes set status = 'excluido' where publicacao_id = '$p_id'" );
		return true;
	}

	public
	function ocultar ( $p_id )
	{
		$this->db->query ( "update publicacoes set status = 'oculto' where publicacao_id = '$p_id'" );
		return true;
	}

	public
	function p_dados ( $p_id )
	{
		$query = $this->db->query ( "select status from publicacoes where publicacao_id = '$p_id'" );
		return $query->result ();
	}

	public
	function nova_disciplina ( $dados )
	{
		$this->db->insert ( 'disciplinas' , $dados );
		return true;
	}

	public
	function disciplinas ( $id )
	{
		$query = $this->db->query ( "select * from disciplinas where professor_id = '$id'" );
		return $query->result ();
	}

	public
	function disciplina ( $id )
	{
		$query = $this->db->query ( "select * from disciplinas where disciplina_id = '$id'" );
		return $query->result ();
	}

	public
	function conteudo ( $d_id )
	{
		$query = $this->db->query ( "select * from conteudo_disciplina where disciplina_id = '$d_id'" );
		return $query->result ();
	}

	public
	function upar_conteudo ( $dados )
	{
		$this->db->insert ( 'conteudo_disciplina' , $dados );
		return true;
	}

	public
	function excluir_conteudo ( $c_id )
	{
		$this->db->query ( "delete from conteudo_disciplina where conteudo_id = '$c_id'" );
		return true;
	}

	public
	function ocultar_conteudo ( $c_id )
	{
		$this->db->query ( "update conteudo_disciplina set status = 'oculto' where conteudo_id = '$c_id'" );
		return true;
	}

	public
	function ativar_conteudo ( $c_id )
	{
		$this->db->query ( "update conteudo_disciplina set status = 'ativo' where conteudo_id = '$c_id'" );
		return true;
	}

	public
	function ativar_publi ( $p_id )
	{
		$this->db->query ( "update publicacoes set status = 'ativo' where publicacao_id = '$p_id'" );
		return true;
	}

	public
	function c_arquivo ( $p_id )
	{
		$query = $this->db->query ( "select * from conteudo_disciplina where conteudo_id = '$p_id'" );
		return $query->result ();
	}

	public
	function conteudo_l ( $id )
	{
		$this->db->where ( 'disciplina_id' , $id );
		return $this->db->count_all_results ( 'conteudo_disciplina' );
	}

	public
	function conteudo_d ( $id , $maximo , $inicio )
	{
		$this->db->order_by ( "conteudo_id" , "desc" );
		$query = $this->db->get_where ( 'conteudo_disciplina' , array('disciplina_id' => $id) , $maximo , $inicio );
		return $query->result ();
	}

	public
	function meus_eventos ( $id )
	{
		$ano = date ('Y');
		$mes = date ('m');
		$query = $this->db->query ( "select * from calendar where user_id = '$id' and calendar_year = '$ano' and calendar_month >= '$mes'" );
		return $query->result ();
	}

	public function apagar_evento($e_id){
		$this->db->query("delete from calendar where calendar_id = '$e_id'");
		return true;
	}
}
