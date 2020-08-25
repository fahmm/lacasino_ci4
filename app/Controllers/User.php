<?php

namespace App\Controllers;

use App\Models\UsersModel;

class User extends BaseController
{
	public function __construct()
	{
		$this->usersModel = new UsersModel();
	}

	public function index()
	{
		$data = [
			'title' => 'My Profile',
			'user' => $this->usersModel->where('email', session()->get('email'))
				->first()
		];
		return view('user/index', $data);
	}

	public function editProfile()
	{
		helper(['form']);
		$data = [
			'title' => 'Edit Profile',
			'user' => $this->usersModel->where('email', session()->get('email'))
				->first()
		];
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'name' => 'required|min_length[3]|max_length[20]',
				'image' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
			];

			if ($this->request->getPost('password') != '') {
				// $rules['currentPassword'] = 'required';
				$rules['password'] = 'required|min_length[8]|max_length[255]';
				$rules['confirm_password'] = 'matches[password]';
			}

			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {

				$fileImage = $this->request->getFile('image');
				// dd($fileImage);
				// cek gambar, apakah msih sama atau berubah
				if ($fileImage->getError() == 4) {
					$namaImage = $this->request->getVar('imageLama');
				} else {
					$namaImage = $fileImage->getRandomName();
					// pindahkan gambar 
					$fileImage->move('assets/img/user', $namaImage);
					// hapus file lama 
					if ($this->request->getVar('imageLama') != 'default.jpg') {
						unlink('assets/img/user/' .  $this->request->getVar('imageLama'));
					}
				}
				$newData = [
					'id' => session()->get('id'),
					'name' => $this->request->getPost('name'),
					'image' => $namaImage
				];

				if ($this->request->getPost('password') != '') {
					$currentPassword = $this->request->getPost('currentPassword');
					$password = $this->request->getPost('password');
					if (!password_verify($currentPassword, $data['user']['password'])) {
						session()->setFlashdata([
							'msg' => 'Wrong Current Password!',
							'msg_alert' => 'alert-danger'
						]);
						return redirect()->back();
					} else {
						if ($currentPassword == $password) {
							session()->setFlashdata([
								'msg' => 'New password can not be same as current password!',
								'msg_alert' => 'alert-danger'
							]);
							return redirect()->back();
						} else {
							$newData['password'] = $this->request->getPost('password');
						}
					}
				}

				$this->usersModel->save($newData);
				session()->setFlashdata([
					'msg' => 'Successfull Updated!',
					'msg_alert' => 'alert-success'
				]);
				return redirect()->back();
			}
		}
		$data['user'] = $this->usersModel->where('id', session()->get('id'))->first();

		return view('user/editProfile', $data);
	}
}
