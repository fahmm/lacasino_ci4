<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\UserToken;

class Auth extends BaseController
{
	public function __construct()
	{
		$this->usersModel = new UsersModel();
		$this->userToken = new UserToken();
	}

	private function setUserSession($user)
	{
		$data = [
			'id' => $user['id'],
			'name' => $user['name'],
			'email' => $user['email'],
			'role_id' => $user['role_id'],
			'isLoggedIn' => true
		];

		session()->set($data);
		return true;
	}

	public function index()
	{
		$data = [
			'title' => 'Login'
		];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {

			if (!$this->validate([
				'email' => 'required|min_length[7]|max_length[50]|valid_email',
				'password1' => 'required|min_length[8]|max_length[255]',
			])) {
				$data['validation'] = $this->validator;
			} else {
				$password = $this->request->getVar('password1');
				$user = $this->usersModel->where('email', $this->request->getVar('email'))
					->first();
				// jika usernya ada
				if ($user) {
					// jika usernya aktif
					if ($user['is_active'] == 1) {
						//cek password
						if (password_verify($password, $user['password'])) {
							$this->setUserSession($user);

							if ($user['role_id'] == 1) {
								return redirect()->to('/admin');
								$this->userToken->table('user_token')->delete('email', session()->get('email'));
							} else {
								return redirect()->to('/user');
								$this->userToken->table('user_token')->delete('email', session()->get('email'));
							}
						} else {
							session()->setFlashdata([
								'msg' => 'Email or Password do not match',
								'msg_alert' => 'alert-danger'
							]);
						}
					} else {
						session()->setFlashdata([
							'msg' => 'This email has not been activated!',
							'msg_alert' => 'alert-danger'
						]);
					}
				} else {
					session()->setFlashdata([
						'msg' => 'Email is not registered!',
						'msg_alert' => 'alert-danger'
					]);
				}
			}
		}

		return view('auth/login', $data);
	}

	public function registration()
	{
		$data = [
			'title' => 'Register'
		];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {

			if (!$this->validate([
				'name' => 'required|min_length[4]|max_length[50]|trim',
				'email' => 'required|min_length[7]|max_length[50]|valid_email|is_unique[user.email]',
				'password1' => 'required|min_length[8]|max_length[255]',
				'password2' => 'required|matches[password1]'
			])) {
				$data['validation'] = $this->validator;
			} else {
				$newData = [
					'name' => $this->request->getVar('name'),
					'email' => $this->request->getVar('email'),
					'image' => 'default.jpg',
					'password' => $this->request->getVar('password1'),
					// 'password' => password_hash($this->request->getVar('password1'), PASSWORD_DEFAULT),
					'role_id' => 2,
					'is_active' => 0,
					'created_at' => time()
				];

				//siapkan token
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $this->request->getVar('email'),
					'token' => $token,
					'date_created' => time()

				];

				$this->usersModel->save($newData);
				$this->userToken->insert($user_token);

				$this->_sendEmail($token, 'verify');

				session()->setFlashdata([
					'msg' => 'Successfull registration, Please activate your account',
					'msg_alert' => 'alert-success'
				]);
				return redirect()->to('/');
			}
		}
		return view('auth/registration', $data);
	}

	private function _sendEmail($token, $type)
	{
		$email = \Config\Services::email();
		$email->setFrom('muhfahmimajidmks@gmail.com', 'Fahmi');
		$email->setTo($this->request->getVar('email'));

		if ($type == 'verify') {
			$email->setSubject('Account Verification');
			$email->setMessage('Clik this link below, to verify your account <a href="' . base_url() . '/auth/verify?email=' . $this->request->getVar('email') . '&token=' . urlencode($token) . '">Activate</a>');
		} else if ($type == 'forgot') {
			$email->setSubject('Reset Password');
			$email->setMessage('Clik this link below, to reset your password <a href="' . base_url() . '/auth/resetPassword?email=' . $this->request->getVar('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
		}

		if ($email->send()) {
			return true;
		} else {
			echo $email->printDebugger();
			die;
		}
	}

	public function verify()
	{
		$email = $this->request->getGet('email');
		$token = $this->request->getGet('token');

		$user = $this->usersModel->table('user')->getWhere(['email' => $email])->getResultArray();

		if ($user) {
			$user_token = $this->userToken->table('user_token')->getWhere(['token' => $token])->getRowArray();
			if ($user_token) {
				if ($user_token['created_at'] < date("Y-m-d", time() + 86400)) {

					$this->usersModel->table('user')->set('is_active', 1);
					$this->usersModel->table('user')->where('email', $email);
					$this->usersModel->table('user')->update();
					$this->userToken->table('user_token')->where('email', $email)->delete();

					session()->setFlashdata([
						'msg' => $email . ' has been activated, please Login',
						'msg_alert' => 'alert-success'
					]);
					return redirect()->to('/');
				} else {
					$this->usersModel->table('user')->where('email', $email)->delete();
					$this->userToken->table('user_token')->where('email', $email)->delete();

					session()->setFlashdata([
						'msg' => 'token expired',
						'msg_alert' => 'alert-success'
					]);
					return redirect()->to('/');
				}
			} else {
				session()->setFlashdata([
					'msg' => 'Account Activation failed! wrong token',
					'msg_alert' => 'alert-danger'
				]);
				return redirect()->to('/');
			}
		} else {
			session()->setFlashdata([
				'msg' => 'Account Activation failed! wrong email',
				'msg_alert' => 'alert-danger'
			]);
			return redirect()->to('/');
		}
	}

	public function logout()
	{
		// session()->destroy();

		session()->remove(['id', 'name', 'email', 'role_id', 'isLoggedIn']);

		session()->setFlashdata([
			'msg' => 'You have been logout',
			'msg_alert' => 'alert-success'
		]);
		return redirect()->to('/');
	}

	public function blocked()
	{
		$data = [
			'title' => 'Page Not Found',
		];
		helper(['form']);
		return view('auth/403', $data);;
	}

	public function forgotPassword()
	{
		$data = [
			'title' => 'Forgot Password',
		];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {

			if (!$this->validate([
				'email' => 'required|min_length[7]|max_length[50]|valid_email'
			])) {
				$data['validation'] = $this->validator;
			} else {
				$email = $this->request->getVar('email');
				$user = $this->usersModel->table('user')->getWhere(['email' => $email, 'is_active' => 1])->getResultArray();

				if ($user) {
					$token = base64_encode(random_bytes(32));
					$user_token = [
						'email' => $this->request->getVar('email'),
						'token' => $token,
						'date_created' => time()
					];
					$this->userToken->insert($user_token);

					$this->_sendEmail($token, 'forgot');
					session()->setFlashdata([
						'msg' => 'Please check your email to reset',
						'msg_alert' => 'alert-success'
					]);
					return redirect()->back();
				} else {
					session()->setFlashdata([
						'msg' => 'Email is not registered or activated your account',
						'msg_alert' => 'alert-danger'
					]);
					return redirect()->back();
				}
			}
		}

		return view('auth/forgot-password', $data);
	}

	public function resetPassword()
	{
		$email = $this->request->getGet('email');
		$token = $this->request->getGet('token');

		$user = $this->usersModel->table('user')->getWhere(['email' => $email])->getResultArray();

		if ($user) {
			$user_token = $this->userToken->table('user_token')->getWhere(['token' => $token])->getRowArray();
			if ($user_token) {
				if ($user_token['created_at'] < date("Y-m-d", time() + 86400)) {

					session()->set('reset_email', $email);
					$this->changePassword();

					session()->setFlashdata([
						'msg' => 'Password has been reset',
						'msg_alert' => 'alert-success'
					]);
					return redirect()->to('/auth/changePassword');
				} else {
					$this->usersModel->table('user')->where('email', $email)->delete();
					$this->userToken->table('user_token')->where('email', $email)->delete();

					session()->setFlashdata([
						'msg' => 'token expired',
						'msg_alert' => 'alert-success'
					]);
					return redirect()->to('/');
				}
			} else {
				session()->setFlashdata([
					'msg' => 'Reset Password failed! wrong token',
					'msg_alert' => 'alert-danger'
				]);
				return redirect()->to('/');
			}
		} else {
			session()->setFlashdata([
				'msg' => 'Reset Password failed! wrong email',
				'msg_alert' => 'alert-danger'
			]);
			return redirect()->to('/');
		}
	}

	public function changePassword()
	{
		$data = [
			'title' => 'Change Password'
		];
		helper(['form']);

		if (!session()->get('reset_email')) {
			return redirect()->to('/');
		}
		if ($this->request->getMethod() == 'post') {

			if (!$this->validate([
				'password1' => 'required|min_length[8]|max_length[255]',
				'password2' => 'required|matches[password1]'
			])) {
				$data['validation'] = $this->validator;
			} else {
				// dd($this->request->getVar('password1'));
				$password = $this->request->getVar('password1');
				$email = session()->get('reset_email');
				$this->usersModel->table('user')->set('password', $password);
				$this->usersModel->table('user')->where('email', $email);
				$this->usersModel->table('user')->update();

				$this->userToken->table('user_token')->where('email', $email)->delete();
				session()->setFlashdata([
					'msg' => 'Successfull Changed',
					'msg_alert' => 'alert-success'
				]);

				session()->remove('reset_email');
				return redirect()->to('/');
			}
		}
		return view('auth/change-password', $data);
	}
}
