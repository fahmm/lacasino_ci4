<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\RoleModel;
use App\Models\MenuModel;
use App\Models\KantorModel;


class Admin extends BaseController
{
	public function __construct()
	{
		$this->usersModel = new UsersModel();
		$this->roleModel = new RoleModel();
		$this->menuModel = new MenuModel();
		$this->kantorModel = new KantorModel();
		helper(['form']);
	}
	public function index()
	{
		// if (!session()->get('isLoggedIn'))
		// 	return redirect()->to('/');
		$data = [
			'title' => 'Dashboard',
			'user' => $this->usersModel->where('email', session()->get('email'))
				->first()
		];
		return view('admin/index', $data);
	}

	public function role()
	{
		$data = [
			'title' => 'Role',
			'user' => $this->usersModel->where('email', session()->get('email'))
				->first(),
			'role' => $this->roleModel->get()
				->getResultArray(),

		];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {

			if (!$this->validate([
				'role' => 'required|is_unique[user_role.role]'
			])) {
				$data['validation'] = $this->validator;
			} else {
				$newData = [
					'role' => $this->request->getVar('role'),
				];

				$this->roleModel->table('user_role')->save($newData);
				session()->setFlashdata([
					'msg' => 'Successfull Added',
					'msg_alert' => 'alert-success'
				]);
				return redirect()->back();
			}
		}
		return view('admin/role', $data);
	}


	public function deleteRole($id)
	{
		$this->roleModel->table('user_role')->delete($id);
		session()->setFlashdata([
			'msg' => 'Successfull Deleted',
			'msg_alert' => 'alert-danger'
		]);
		return redirect()->back();
	}

	public function editR($id)
	{
		$data = [
			'title' => 'Submenu Management',
			'user' => $this->usersModel->where('email', session()->get('email'))
				->first(),
			'roles' => $this->roleModel->table('user_role')->get()
				->getResultArray(),
			'role' => $this->roleModel->getRoleById($id),
			'validation' => \Config\Services::validation()
		];
		helper(['form']);
		return view('admin/editRole', $data);;
	}

	public function editRole($id)
	{
		if ($this->request->getMethod() == 'post') {

			if (!$this->validate([
				'role' => 'required'
			])) {
				return redirect()->to('/admin/EdiR/' . $this->request->getVar('id'))->withInput();
				// $data['validation'] = $this->validator;
			} else {
				$newData = [
					'id' => $id,
					'role' => $this->request->getVar('role'),
				];

				$this->roleModel->save($newData);
				session()->setFlashdata([
					'msg' => 'Successfull Edited',
					'msg_alert' => 'alert-success'
				]);
				return redirect()->to('/admin/role');
			}
		}
	}

	public function roleAccess($role_id)
	{
		$data = [
			'title' => 'Role Access',
			'user' => $this->usersModel->where('email', session()->get('email'))
				->first(),
			'role' => $this->roleModel->where(['id' => $role_id])->first(),


			'menus' => $this->menuModel->table('user_menu')->where('id !=', 1)->get()
				->getResultArray(),
		];
		return view('admin/role-access', $data);
	}

	public function changeAccess()
	{
		$db      = \Config\Database::connect();

		$menu_id = $this->request->getPost('menuId');
		$role_id = $this->request->getPost('roleId');

		// dd($menu_id);
		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id,
		];

		$result = $db->table('user_access_menu')->where($data)->get();

		if ($result->getRowArray() < 1) {
			$db->table('user_access_menu')->insert($data);
		} else {
			$db->table('user_access_menu')->delete($data);
		}
		session()->setFlashdata([
			'msg' => 'Successfull Changed',
			'msg_alert' => 'alert-success'
		]);
	}

	public function editOfficeProfiles()
	{
		$data = [
			'title' => 'Profile Klinik Management',
			'user' => $this->usersModel->where('email', session()->get('email'))
				->first(),
			'kantor' => $this->kantorModel
				->first(),
		];
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'nama_kantor' => 'required|min_length[3]|max_length[20]',
				'direktur' => 'required|min_length[3]|max_length[20]',
				'nip_direktur' => 'required|min_length[3]|max_length[20]',
				'alamat' => 'required|min_length[3]|max_length[20]',
				'tlp' => 'required|min_length[3]|max_length[20]',
				'kode_pos' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|min_length[3]|max_length[20]',

			];
			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				$newData = [
					'id' => $this->request->getPost('id'),
					'nama_kantor' => $this->request->getPost('nama_kantor'),
					'direktur' => $this->request->getPost('direktur'),
					'nip_direktur' => $this->request->getPost('nip_direktur'),
					'alamat' => $this->request->getPost('alamat'),
					'tlp' => $this->request->getPost('tlp'),
					'fax' => $this->request->getPost('fax'),
					'kode_pos' => $this->request->getPost('kode_pos'),
					'email' => $this->request->getPost('email'),
				];

				$this->kantorModel->save($newData);
				session()->setFlashdata([
					'msg' => 'Successfull Updated!',
					'msg_alert' => 'alert-success'
				]);
				return redirect()->back();
			}
		}
		return view('admin/editOffice', $data);
	}


	public function editOfficeProfile()
	{
		$data = [
			'title' => 'Profile Klinik Management',
			'user' => $this->usersModel->where('email', session()->get('email'))
				->first(),
			'kantor' => $this->kantorModel
				->first(),
		];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {

			if (!$this->validate([
				'nama_kantor' => 'required|min_length[3]|max_length[20]',
				'direktur' => 'required|min_length[3]|max_length[20]',
				'nip_direktur' => 'required|min_length[3]|max_length[20]',
				'alamat' => 'required|min_length[3]|max_length[20]',
				'tlp' => 'required|min_length[3]|max_length[20]',
				'kode_pos' => 'required|min_length[3]|max_length[20]',
				'email' => 'required|min_length[3]|max_length[20]'
			])) {
				$data['validation'] = $this->validator;
			} else {
				$newData = [
					'id' => $this->request->getPost('id'),
					'nama_kantor' => $this->request->getPost('nama_kantor'),
					'direktur' => $this->request->getPost('direktur'),
					'nip_direktur' => $this->request->getPost('nip_direktur'),
					'alamat' => $this->request->getPost('alamat'),
					'tlp' => $this->request->getPost('tlp'),
					'fax' => $this->request->getPost('fax'),
					'kode_pos' => $this->request->getPost('kode_pos'),
					'email' => $this->request->getPost('email'),
				];
				// dd($this->request->getVar('password1'));
				// $password = $this->request->getVar('password1');
				// $email = session()->get('reset_email');
				$this->kantorModel->save($newData);
				session()->setFlashdata([
					'msg' => 'Successfull Updated!',
					'msg_alert' => 'alert-success'
				]);
				return redirect()->back();
			}
		}
		return view('admin/editOffice', $data);
	}
}
