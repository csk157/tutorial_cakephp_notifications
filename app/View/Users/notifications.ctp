<div>
	<?php foreach ($users as $user): ?>
		<div>
			<h3><?php echo $user['User']['username']; ?></h3>
			<?php echo $this->element('notifications', array('notifications' => $user['Notification'])); ?>
		</div>
	<?php endforeach; ?>
</div>