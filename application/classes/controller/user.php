<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Template {

	public function action_index()
	{
		$this->template->content = View::factory('user/info')
			->bind('user', $user);
		
		// Load the user information
		$user = Auth::instance()->get_user();
		
		// if a user is not logged in, redirect to login page
		if (!$user)
		{
			Request::current()->redirect('user/login');
		}
	}

	public function action_create() 
	{
		$user = Auth::instance()->get_user();
		$roles = array();
		if($user) {
			foreach (ORM::factory('user', $user->id)->roles->find_all() as $role) {
				array_push($roles, $role->name);
			}
		}


		if(in_array('admin', $roles)) {
			if (HTTP_Request::POST == $this->request->method()) 
			{			
				try {
			
					// Create the user using form values
					$user = ORM::factory('user')->create_user($this->request->post(), array(
						'username',
						'password',
						'email',
						'common_note',
						'eviction_note'			
					));
					
					// Grant user login role
					if(isset($_POST['role_login']) && $_POST['role_login'] == 1) {
						$user->add('roles', ORM::factory('role', array('name' => 'login')));
					}
					// Grant user admin role
					if(isset($_POST['role_admin']) && $_POST['role_admin'] == 1) {
						$user->add('roles', ORM::factory('role', array('name' => 'admin')));
					}
					
					// Reset values so form is not sticky
					$_POST = array();
					
					// Set success message
					$message = "You have added user '{$user->username}' to the database";
					
				} catch (ORM_Validation_Exception $e) {
					
					// Set failure message
					$message = 'There were errors, please see form below.';
					
					// Set errors using custom messages
					$errors = $e->errors('models');
				}
			}
			$users = ORM::factory('user')->find_all();
			$this->template->content = View::factory('user/create')
				->bind('errors', $errors)
				->bind('message', $message)
				->bind('users', $users);
		}
		else {
			Request::current()->redirect('user/login');
		}
	}

	/**
	 * /user/update/<user->id> POST
	 */
	public function action_update()
	{

		$user = Auth::instance()->get_user();
		$roles = array();
		if($user) {
			foreach (ORM::factory('user', $user->id)->roles->find_all() as $role) {
				array_push($roles, $role->name);
			}
		}


		if(in_array('admin', $roles)) {

			$id = $this->request->param('id');
			$the_user = ORM::factory('user', $id);

			$this->template->content = View::factory('user/update')
				->bind('errors', $errors)
				->bind('message', $message)
				->bind('user', $the_user);

			if (HTTP_Request::POST == $this->request->method()) 
			{			
				try {

					$data = $this->request->post();
					$data['common_note'] = (isset($data['common_note'])) ? 1 : 0;
					$data['eviction_note'] = (isset($data['eviction_note'])) ? 1 : 0;
			
					// Create the user using form values
					$user = $the_user->update_user($data, array(
						'username',
						'password',
						'email',
						'common_note',
						'eviction_note'			
					));
					
					// Grant user login role
					if(isset($_POST['role_login']) && $_POST['role_login'] == 1) {
						if(!$user->has('roles', ORM::factory('role', array('name' => 'login')))) {
							$user->add('roles', ORM::factory('role', array('name' => 'login')));
						}
					}
					else {
						if($user->has('roles', ORM::factory('role', array('name' => 'login')))) {
							$user->remove('roles', ORM::factory('role', array('name' => 'login')));
						}
					}
					// Grant user admin role
					if(isset($_POST['role_admin']) && $_POST['role_admin'] == 1) {
						if(!$user->has('roles', ORM::factory('role', array('name' => 'admin')))) {
							$user->add('roles', ORM::factory('role', array('name' => 'admin')));
						}
					}
					else {
						if($user->has('roles', ORM::factory('role', array('name' => 'admin')))) {
							$user->remove('roles', ORM::factory('role', array('name' => 'admin')));
						}
					}
					
					// Reset values so form is not sticky
					$_POST = array();
					
					// Set success message
					$message = "You have updated user '{$user->username}'";

					Request::current()->redirect('user/create');
					
				} catch (ORM_Validation_Exception $e) {
					
					// Set failure message
					$message = 'There were errors, please see form below.';
					
					// Set errors using custom messages
					$errors = $e->errors('models');
				}
			}
		}
		else {
			Request::current()->redirect('user/login');
		}
	}

	/**
	 * /case/show/<case->id> GET
	 */
	public function action_delete()
	{
		$id = $this->request->param('id');
			
		$the_user = ORM::factory('user', $id);
		$the_user->delete();
		
		// Redirect to create page
		Request::current()->redirect('user/create');
	}
	
	public function action_login() 
	{
		$this->template->content = View::factory('user/login')
			->bind('message', $message);
			
		if (HTTP_Request::POST == $this->request->method()) 
		{
			// Attempt to login user
			$remember = array_key_exists('remember', $this->request->post()) ? (bool) $this->request->post('remember') : FALSE;
			$user = Auth::instance()->login($this->request->post('username'), $this->request->post('password'), $remember);
			
			// If successful, redirect user
			if ($user) 
			{
				Request::current()->redirect('/');
			} 
			else 
			{
				$message = 'Login failed';
			}
		}
	}
	
	public function action_logout() 
	{
		// Log user out
		Auth::instance()->logout();
		
		// Redirect to login page
		Request::current()->redirect('user/login');
	}

}
