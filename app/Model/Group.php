<?php
App::uses('AppModel', 'Model');

/**
 * Group Model
 *
 * @property User $User
 */
class Group extends AppModel {

/**
 * Behaviors
 */
	// public $actsAs = array('Acl' => array('type' => 'requester')); // ARO

	public $recursive = -1; 

/**
 * Regras de validação
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
	);

/**
 * Group hasMany...
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
			'fields' => array('id','nome'),
			'dependent' => true,
		)
	);

/**
 * Grupos não têm nó pai
 */
	// public function parentNode() {
	// 	return null;
	// }

}
