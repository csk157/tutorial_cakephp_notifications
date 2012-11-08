<?php
class NotifiableBehavior extends ModelBehavior{
	// this function will be called after model is saved (in our case after Post is saved)
	public function afterSave(Model $model, $created) {
		parent::afterSave($model, $created); // parent method

		// Importing models that we need - User and Notification
		App::import('Model', 'Notification');
		App::import('Model', 'User');

		// Initializing models
		$notification = new Notification();
		$user = new User();

		// Prefilling the shared data for notification object, user_id will vary on followers
		$notifData = array();
		$notifData['Notification']['type'] = $model->name;
		$notifData['Notification']['type_id'] = $model->data[$model->name]['id'];

		// Getting post author so we can use list of his follwers
		// Note: good place for optimization as it gets a lot of irrelevant information
		$author = $user->read(null, $model->data[$model->name]['user_id']);

		// Creating notification for each follower
		foreach ($author['Followed'] as $follower){
			$notifData['Notification']['user_id'] = $follower['id'];
			$notification->create();
			$notification->save($notifData);
		}
	}
}
?>
