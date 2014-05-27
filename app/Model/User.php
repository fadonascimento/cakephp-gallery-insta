<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * User Model
 *
 * @property Group $Group
 */
class User extends AppModel {

	//public $useTable = 'users';
	public $displayField = 'name';


/**
 * Behaviors
 */
	// public $actsAs = array('Acl' => array('type' => 'requester')); // ARO

/**
 * Regras de validação
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'on' => 'create',
			),
		),
	);


/**
 * User belongsTo...
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
		)
	);

/**
 * Antes de salvar o registro
 */
	public function beforeSave($options = array()) {
		// Está salvando com senha..
		if (isset($this->data[$this->alias]['password'])) {
			// .. e a password não está vazia
			if (!empty($this->data[$this->alias]['password'])) {
				// Gera o hash da password
				$password = &$this->data[$this->alias]['password'];
				$password = AuthComponent::password($password);
			} else {
				unset($this->data[$this->alias]['password']);	
			}
		}
		return parent::beforeSave($options);
	}


	

/**
 * Informa pro ACL quem é o nó pai (grupo)
 */
	// public function parentNode() {
	// 	if (!$this->id && empty($this->data))
	// 		return null;

	// 	// Usa o $this->data ou busca a informação no banco
	// 	if (isset($this->data[$this->alias]['group_id'])) {
	// 		$groupId = $this->data[$this->alias]['group_id'];
	// 	} else {
	// 		$groupId = $this->field('group_id');
	// 	}

	// 	// Retorna as informações pro ACL
	// 	return $groupId ? array('Group' => array('id' => (int)$groupId)) : null;
	// }

/**
 * Vincula as permissões do usuário ao seu grupo
 */
	// public function bindNode($user) {
	// 	return array(
	// 		'model' => 'Group',
	// 		'foreign_key' => $user[$this->alias]['group_id']
	// 	);
	// }
}
