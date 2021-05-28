<?php
defined ( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route[ 'default_controller' ] = 'Home';
$route[ '404_override' ] = 'Erro404';
$route[ 'translate_uri_dashes' ] = FALSE;
$route['retorno'] = 'Autentica/logado';
$route['error_404'] = 'Erro404/tela';
//----------------DIRECIONAL PRINCIPAL--------------------
$route[ 'autentica' ] = 'autentica';


//----------------- CADASTRO AREA --------------------
$route[ 'confirma/email/(:any)' ] = "email/validar/$1";
$route[ 'cadastro' ] = 'cadastro';

//------------------LOGOUT---------------------------
$route[ 'logout' ] = "home/logout";

//-----------------------USER AREA-------------------------

$route['u/perfil'] = "usuario/perfil";
$route['u/membros'] = "usuario/membros";
$route['u/contato'] = "usuario/contato";
$route['u/info'] = "usuario/info";
$route[ 'u/contatar' ] = "usuario/contatar";
$route[ 'u/ler/(:any)' ] = "usuario/ler/$1";
$route['u/a/recebido/(:any)'] = "usuario/apagar_recebido/$1";
$route['u/a/enviado/(:any)'] = "usuario/apagar_enviado/$1";
$route['u/responder/(:any)'] = "usuario/responder/$1";
$route['u/m/recebido/(:any)'] = "usuario/ler_recebido/$1";
$route['u/m/enviado/(:any)'] = "usuario/ler_enviado/$1";
$route['u/m/escrever'] = "usuario/escrever";
$route['u/e/arquivo'] = "usuario/enviar_arquivo";
$route['u/e/texto'] = "usuario/enviar_texto";
$route['u/e/upload'] = "usuario/upload";
$route['u/usuario/p/(:any)/curtir'] = "usuario/curtir/$1";
$route['u/usuario/p/(:any)/comentar'] = "usuario/comentar/$1";
$route['u/p/(:any)'] = "usuario/publicacao/$1";
$route['u/usuario/p/(:any)/(:any)/r/comentario'] = "usuario/responder_c/$1/$2";
$route['u/usuario/inicio'] = "usuario/feed";
$route['u/reportar/(:any)'] = 'usuario/reportar/$1';
$route['u/usuario/download/(:any)'] = "usuario/download/$1";
$route['u/termos'] = "usuario/termos";
$route['u/enviadas'] = "usuario/enviadas";
$route['u/mensagens'] = "usuario/mensagens";
$route['u/curso'] = "usuario/curso";
$route['u/calendario'] = "usuario/calendario";
$route['u/feed'] = "usuario/inicio";
$route['u/pesquisar'] = "usuario/pesquisar";
$route['u/m/envio'] = "usuario/envio";

//------------------------------PROFESSOR AREA------------------------------------

$route['p/perfil'] = "professor/perfil";
$route['p/membros'] = "professor/membros";
$route['p/contato'] = "professor/contato";
$route['p/info'] = "professor/info";
$route[ 'p/contatar' ] = "professor/contatar";
$route[ 'p/ler/(:any)' ] = "professor/ler/$1";
$route['p/a/recebido/(:num)'] = "professor/apagar_recebido/$1";
$route['p/a/enviado/(:num)'] = "professor/apagar_enviado/$1";
$route['p/responder/(:any)'] = "professor/responder/$1";
$route['p/m/recebido/(:any)'] = "professor/ler_recebido/$1";
$route['p/m/enviado/(:any)'] = "professor/ler_enviado/$1";
$route['p/m/escrever'] = "professor/escrever";
$route['p/e/arquivo'] = "professor/enviar_arquivo";
$route['p/e/texto'] = "professor/enviar_texto";
$route['p/e/upload'] = "professor/upload";
$route['p/professor/upload_texto'] = 'professor/upload_texto';
$route['professor/p/(:any)/curtir'] = "professor/curtir/$1";
$route['professor/p/(:any)/comentar'] = "professor/comentar/$1";
$route['p/p/(:num)'] = "professor/publicacao/$1";
$route['professor/p/(:any)/(:any)/r/comentario'] = "professor/responder_c/$1/$2";
$route['p/professor/inicio'] = "professor/feed";
$route['p/reportar/(:any)'] = 'professor/reportar/$1';
$route['professor/download/(:any)'] = "professor/download/$1";
$route['p/termos'] = "professor/termos";
$route['p/enviadas'] = "professor/enviadas";
$route['p/mensagens'] = "professor/mensagens";
$route['p/curso'] = "professor/curso";
$route['p/calendario'] = "professor/calendario";
$route['p/feed'] = "professor/inicio";
$route['p/pesquisar'] = "professor/pesquisar";
$route['p/bloquear/(:any)'] = "professor/bloquear/$1";
$route['p/excluir/(:any)'] = "professor/excluir/$1";
$route['p/ocultar/(:any)'] = "professor/ocultar/$1";
$route['p/m/conteudo'] = "professor/conteudo";
$route['p/n/disciplina'] = "professor/nova_disciplina";
$route['p/disciplina/(:any)'] = 'professor/disciplina/$1';
$route['p/disciplina/(:any)/(:any)'] = 'professor/disciplina/$1/$2'; //em analise
$route['p/n/conteudo/(:any)'] = 'professor/novo_conteudo/$1';
$route['excluir/c/(:any)'] = "professor/excluir_conteudo/$1";
$route['ocultar/c/(:any)'] = "professor/ocultar_conteudo/$1";
//$route['desocultar/c/(:num)'] = "professor/desocultar_conteudo/$1";
$route['download/c/(:any)'] = 'professor/c_download/$1';
$route['bloquear'] = 'home/bloquear';
$route['bloqueado'] = 'home/bloqueado';
$route['p/apagar_evento/(:any)'] = 'professor/apagar_evento/$1';
$route['p/autorizacao/verificar/(:any)'] = 'autentica/nao_autorizado/$1';
$route['u/autorizacao/verificar/(:any)'] = 'autentica/nao_autorizado/$1';
$route['p/m/envio'] = "professor/envio";

//--------------------------------------------------------------------


$route['g/perfil'] = "gestor/perfil";
$route['g/membros'] = "gestor/membros";
$route['g/contato'] = "gestor/contato";
$route['g/info'] = "gestor/info";
$route[ 'g/contatar' ] = "gestor/contatar";
$route[ 'g/ler/(:any)' ] = "gestor/ler/$1";
$route['g/a/recebido/(:num)'] = "gestor/apagar_recebido/$1";
$route['g/a/enviado/(:num)'] = "gestor/apagar_enviado/$1";
$route['g/responder/(:any)'] = "gestor/responder/$1";
$route['g/m/recebido/(:any)'] = "gestor/ler_recebido/$1";
$route['g/m/enviado/(:any)'] = "gestor/ler_enviado/$1";
$route['g/m/escrever'] = "gestor/escrever";
$route['g/e/arquivo'] = "gestor/enviar_arquivo";
$route['g/e/texto'] = "gestor/enviar_texto";
$route['g/e/upload'] = "gestor/upload";
$route['g/gestor/upload_texto'] = 'gestor/upload_texto';
$route['gestor/p/(:any)/curtir'] = "gestor/curtir/$1";
$route['gestor/p/(:any)/comentar'] = "gestor/comentar/$1";
$route['g/p/(:num)'] = "gestor/publicacao/$1";
$route['gestor/p/(:any)/(:any)/r/comentario'] = "gestor/responder_c/$1/$2";
$route['g/gestor/inicio'] = "gestor/feed";
$route['g/reportar/(:any)'] = 'gestor/reportar/$1';
$route['gestor/download/(:any)'] = "gestor/download/$1";
$route['g/termos'] = "gestor/termos";
$route['g/enviadas'] = "gestor/enviadas";
$route['g/mensagens'] = "gestor/mensagens";
$route['g/curso'] = "gestor/curso";
$route['g/calendario'] = "gestor/calendario";
$route['g/feed'] = "gestor/inicio";
$route['g/pesquisar'] = "gestor/pesquisar";
$route['g/bloquear/(:any)'] = "gestor/bloquear/$1";
$route['g/excluir/(:any)'] = "gestor/excluir/$1";
$route['g/ocultar/(:any)'] = "gestor/ocultar/$1";
$route['g/m/conteudo'] = "gestor/conteudo";
$route['g/n/disciplina'] = "gestor/nova_disciplina";
$route['g/disciplina/(:any)'] = 'gestor/disciplina/$1';
$route['g/disciplina/(:any)/(:any)'] = 'gestor/disciplina/$1/$2'; //em analise
$route['g/n/conteudo/(:any)'] = 'gestor/novo_conteudo/$1';
$route['excluir/c/(:any)'] = "gestor/excluir_conteudo/$1";
$route['ocultar/c/(:any)'] = "gestor/ocultar_conteudo/$1";
$route['download/c/(:any)'] = 'gestor/c_download/$1';
$route['bloquear'] = 'home/bloquear';
$route['bloqueado'] = 'home/bloqueado';
$route['g/apagar_evento/(:any)'] = 'gestor/apagar_evento/$1';
$route['g/autorizacao/verificar/(:any)'] = 'autentica/nao_autorizado/$1';
$route['g/m/envio'] = "gestor/envio";
