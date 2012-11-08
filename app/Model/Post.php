<?php
App::uses('AppModel', 'Model');
class Post extends AppModel {
	public $displayField = 'content';
	public $actsAs = array('Notifiable');

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
