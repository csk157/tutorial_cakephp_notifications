<?php

class NotificationHelper extends AppHelper {

	public function parseNotification($notification) {
		$message = '';
		// I suppose different types would have different messages, so we switching
		switch ($notification['type']) {
			case 'Post':
				App::import('Model', 'Post');
				$post = new Post();
				// Finding the post we have to deal with
				$p = $post->find('first', array('conditions' => array('Post.id' => $notification['type_id'])));

				// If there is one - we write a message
				if($p){
					$message = $p['User']['username']." has posted '".$p['Post']['content']."'";
				}

				break;

			default:
				// We could have added user from which we receive id to notification, so we could change
				// someone to user name
				$message = "Someone has done something you should be notified about";
				break;
		}

		return $message;
	}

}
