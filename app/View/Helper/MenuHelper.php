<?php
App::uses('AclComponent', 'Controller/Component');
App::uses('HtmlHelper', 'View/Helper');
App::uses('ComponentCollection', 'Controller');

/**
 * Extendendo as funcionalidades do HtmlHelper
 * Para toda a aplicação deveremos utilizar somente
 * essa classe ao invés de utilizar o HtmlHelper
 * 
 */
class MenuHelper extends Helper {

	var $helpers = array('Form','Image','Html');

	public $menu;

	function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
		
		$ComponentCollection = new ComponentCollection();
		$this->Acl = new AclComponent($ComponentCollection);
	}

/**
*  Verifica se o usuario autenticado tem permissão a action
*  caso tenha exibe o  menu, senão retorna null
*/
	public function link($title, $url = null, $options = array(), $confirmMessage = false)
	{
		if (!isset($url['controller'])) {
			$controller = array('controller' => $this->params['controller']);
			$url = array_merge($controller,$url);
		}
		
		$menuUrl = 'controllers/'.join('/',$url);
		
		if (!$this->Acl->check(AuthComponent::user(),$menuUrl)) {
			return false;
		}
		
		return $this->Html->link($title, $url, $options, $confirmMessage);
	}

/**
*  Verifica se o usuario autenticado tem permissão a action
*  caso tenha exibe o  menu, senão retorna null
* 
* 	PRECISA TESTAR
*/
	public function postLink($title, $url = null, $options = array(), $confirmMessage = false)
	{
		
		if (!isset($url['controller'])) {
			$controller = array('controller' => $this->params['controller']);
			$url = array_merge($controller,$url);
		}
		
		$menuUrl = 'controllers/'.join('/',$url);
		
		if (!$this->Acl->check(AuthComponent::user(),$menuUrl)) {
			return false;
		}

		return $this->Form->postLink($title, $url, $options, $confirmMessage);
	}


	public function view($title, $url = null, $options = array(), $confirmMessage = false)
	{
		$optionsDefault = array('class'=>'glyphicon glyphicon-eye-open','Title'=>'Visualizar');
		$options = array_merge_recursive($optionsDefault, $options);
		$title = null;
		return $this->link($title, $url, $options, $confirmMessage);
	}

	public function edit($title, $url = null, $options = array(), $confirmMessage = false)
	{
		$optionsDefault = array('class'=>'glyphicon glyphicon-pencil','Title'=>'Editar');
		$options = array_merge_recursive($optionsDefault, $options);
		$title = null;
		return $this->link($title, $url, $options, $confirmMessage);
	}

	public function delete($title, $url = null, $options = array(), $confirmMessage = false)
	{
		if (is_null($options)) {
			$options = array();
		}
		$title = null;
		$optionsDefault = array('class'=>'glyphicon glyphicon-trash','Title'=>'Deletar');
		$options = array_merge_recursive($optionsDefault, $options);

		return $this->postLink($title, $url, $options, $confirmMessage);
	}

/**
*	Monta o menu conforme a permissão do Usuário
*
**/
	public function geraMenuAcl() {
		
		
		$menus = $this->_getMenuPrincipal();;
		$html = null;
		$class = null;
		
		foreach ($menus as $key => $menu) {
			$adiciona = false;
			$menuPrincipal = null;
			
			if (isset($menu['itens'])) {
				$url = 'controllers/'.join('/',$menu['url']);
				if ($this->Acl->check(AuthComponent::user(),$url)) {
					$menuPrincipal .= $this->Html->link($key,$menu['url'],
						array('class'=>'dropdown-toggle','escape'=>false));
					$subMenu = null;
					foreach ($menu['itens'] as $m) {
						$menuUrl = 'controllers/'.join('/',$m['url']);
						if ($this->Acl->check(AuthComponent::user(),$menuUrl)) {
							$linkFilho = $this->Html->link($m['titulo'],$m['url']);
							$subMenu .= $this->Html->tag('li', $linkFilho);
						}
					}
					$adiciona = true;
					//$class = 'dropdown';
					if (!empty($subMenu)) {
						$menuPrincipal .= $this->Html->tag('ul', $subMenu, array('class'=>''));
					}
				}
			
			} else {
				$url = 'controllers/'.join('/',$menu['url']);
				if ($this->Acl->check(AuthComponent::user(),$url)) {
					$adiciona = true;
					$menuPrincipal .= $this->Html->link($key, $menu['url']);
				}
			}

			if ($adiciona) {
				$html .= $this->Html->tag('li',$menuPrincipal,array('class'=>$class));
			}
		}
		return $html;
	}

/**
*	Menu principal(navBar), depois colocaremos no banco de dados
*/
	protected function _getMenuPrincipal()
	{	
		
		return array(
				'Cadastros' => array(
					'url' => array(
									'controller' => 'funcionarios',
									'action' => 'index'
								),
						'itens'=> array(
									array(
										'titulo' => 'Grupos',
										'url' => array(
											'controller' => 'groups',
											'action' => 'add'
										),
									),
									array(
										'titulo' => 'Usuários',
										'url' => array(
											'controller' => 'users',
											'action' => 'add'
										),
									),
									array(
										'titulo' => 'Empresas',
										'url' => array(
											'controller' => 'empresas',
											'action' => 'add'
										),
									),
									array(
										'titulo' => 'Funcionários',
										'url' => array(
											'controller' => 'funcionarios',
											'action' => 'add'
										),
									),
									array(
										'titulo' => 'Anamnese',
										'url' => array(
											'controller' => 'documentos',
											'action' => 'add',
											'1'
										),
									),
									array(
										'titulo' => 'Medicina do Trabalho - Exame Médico',
										'url' => array(
											'controller' => 'documentos',
											'action' => 'add',
											'2'
										),
									),
									// array(
									// 	'titulo' => 'Atestado de Saúde Ocupacional (ASO)',
									// 	'url' => array(
									// 		'controller' => 'documentos',
									// 		'action' => 'add',
									// 		'3'
									// 	),
									// ),
								),
							
				),
				'Relatórios' => array(
						'url' => array(
									'controller' => 'empresas',
									'action' => 'selecionarEmpresa'
								),
				),
			);

	}
	
	


}