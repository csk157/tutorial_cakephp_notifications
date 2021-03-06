<?php
App::uses('AppController', 'Controller');
class NotificationsController extends AppController {
	public function index() {
		$this->Notification->recursive = 0;
		$this->set('notifications', $this->paginate());
	}

	public function view($id = null) {
		$this->Notification->id = $id;
		if (!$this->Notification->exists()) {
			throw new NotFoundException(__('Invalid notification'));
		}
		$this->set('notification', $this->Notification->read(null, $id));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Notification->create();
			if ($this->Notification->save($this->request->data)) {
				$this->Session->setFlash(__('The notification has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notification could not be saved. Please, try again.'));
			}
		}
		$users = $this->Notification->User->find('list');
		$this->set(compact('users'));
	}

	public function edit($id = null) {
		$this->Notification->id = $id;
		if (!$this->Notification->exists()) {
			throw new NotFoundException(__('Invalid notification'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Notification->save($this->request->data)) {
				$this->Session->setFlash(__('The notification has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The notification could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Notification->read(null, $id);
		}
		$users = $this->Notification->User->find('list');
		$this->set(compact('users'));
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Notification->id = $id;
		if (!$this->Notification->exists()) {
			throw new NotFoundException(__('Invalid notification'));
		}
		if ($this->Notification->delete()) {
			$this->Session->setFlash(__('Notification deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Notification was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}