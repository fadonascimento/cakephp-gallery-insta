<?php 


/**
 * Classe que gerencia as mensagens configuraveis 
 * do sistema
 * 
 * 
 */

/*
 * Mensagem para recuperação de senha
				'Você solicitou a recuperação se senha no site '. NOME_PROJETO .'<br>
					Clique no link '. $link .' para criar sua nova senha.<br>
					Este link pode ser usado uma única vez para entrar no site e vai levar você para uma página onde você pode trocar a sua senha.<br>
					Ela expira depois de um dia e nada vai acontecer se não for usado.<br>
					Para a sua segurança, não revele sua senha a ninguém.<br>
					Se você não solicitou sua senha, não se preocupe. Essa mensagem foi enviada somente para o seu e-mail e só você tem acesso a ela.<br>'
 */

class TemaComponent extends Component {


	private $Tema=null;

	/**
	 * Inicializador
	 * @see Component::initialize()
	 */
	public function initialize(Controller $controller) {
		$this->Controller = $controller;
	}

	/**
	 * Monta a mensagem baseado no tema personalizado 
	 * gravado no banco
	 * 
	 * 
	 * @param int $mensagemId id do tema
	 * @param array $valores para replace na mensagem no formato array('campo'=>'valor')
	 * @return array titulo e corpo da mensagem
	 */
	public function gerar($mensagemId, $valores = null) {

		if (is_null($valores)) {
			$valores = array();
		}
		if ($this->Tema===null) {
			$this->Tema = ClassRegistry::init('Manager.Tema');
		}

		// obter mensagem salva

		//$tema = $this->Tema->findById($mensagemId);

		$tema = $this->Tema->find('first', array('conditions' => array('id' => $mensagemId)));

		// caso não exista o tema
		if (!$tema || !isset($tema['Tema']['TEM_TITULO']) || !isset($tema['Tema']['TEM_CORPO'])) {
			return false;
		}

		// alguns valores padrão do sistema
		$valoresPadrao = array(
			'FULL_BASE_URL' => FULL_BASE_URL,
			'NOME_LOJA'		=> Config::getNomeLoja()
		);
		$valores = array_merge($valoresPadrao, $valores);
		
		// simplificando tema
		$tema = $tema['Tema'];
		$retorno['titulo'] = (isset($tema['TEM_TITULO']))?$tema['TEM_TITULO']:'';
		$retorno['corpo'] = (isset($tema['TEM_CORPO']))?$tema['TEM_CORPO']:'';

		foreach ($valores as $campo=>$valor) {
			$valor = (!empty($valor)) ? $valor : '';
			$campoR = '{{' . $campo . '}}';
			$retorno['titulo']	= str_ireplace($campoR, "$valor", $retorno['titulo']);
			$retorno['corpo'] 	= str_ireplace($campoR, "$valor", $retorno['corpo']);
		}
		return $retorno;
	}
}