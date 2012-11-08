<div class="notifications">
	<?php foreach($notifications as $notification): ?>
		<div>
			<?php echo $this->Notification->parseNotification($notification); ?>
		</div>
	<?php endforeach; ?>
</div>