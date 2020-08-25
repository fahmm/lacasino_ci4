<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\MenuModel;
use App\Models\SubmenuModel;

class Menu extends BaseController
{
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Menu Management',
            'user' => $this->usersModel->where('email', session()->get('email'))
                ->first(),
            'menus' => $this->menuModel->table('user_menu')->get()
                ->getResultArray(),
            'menu' => $this->menuModel->table('user_menu')->first()
        ];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                'menu' => 'required|is_unique[user_menu.menu]'
            ])) {
                $data['validation'] = $this->validator;
            } else {
                $newData = [
                    'menu' => $this->request->getVar('menu'),
                ];

                $this->menuModel->save($newData);
                session()->setFlashdata([
                    'msg' => 'Successfull Added',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->to('/menu');
            }
        }
        return view('menu/index', $data);
    }

    public function deleteMenu($id)
    {
        $this->menuModel->delete($id);
        session()->setFlashdata([
            'msg' => 'Successfull Deleted',
            'msg_alert' => 'alert-danger'
        ]);
        return redirect()->to('/menu');
    }

    public function editM($id)
    {
        $data = [
            'title' => 'Submenu Management',
            'user' => $this->usersModel->where('email', session()->get('email'))
                ->first(),
            'menus' => $this->menuModel->table('user_menu')->get()
                ->getResultArray(),
            'menu' => $this->menuModel->getMenuById($id),
            'validation' => \Config\Services::validation()
        ];
        helper(['form']);
        return view('menu/editMenu', $data);;
    }

    public function editMenu($id)
    {
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                'menu' => 'required'
            ])) {
                return redirect()->to('/menu/editM/' . $this->request->getVar('id'))->withInput();
                // $data['validation'] = $this->validator;
            } else {
                $newData = [
                    'id' => $id,
                    'menu' => $this->request->getVar('menu'),
                ];

                $this->menuModel->save($newData);
                session()->setFlashdata([
                    'msg' => 'Successfull Edited',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->to('/menu');
            }
        }
    }


    public function submenu()
    {
        $data = [
            'title' => 'Submenu Management',
            'user' => $this->usersModel->where('email', session()->get('email'))
                ->first(),
            'menus' => $this->menuModel->table('user_menu')->get()
                ->getResultArray(),
            'menu' => $this->menuModel->table('user_menu')->first(),
            'subMenu' => $this->submenuModel->getsubMenu()
        ];

        // dd($data);
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                'title' => 'required|is_unique[user_sub_menu.title]',
                'menu_id' => 'required',
                'url' => 'required',
                'icon' => 'required',
                // 'is_active' => 'required'
            ])) {
                $data['validation'] = $this->validator;
            } else {
                $newData = [
                    'title' => $this->request->getVar('title'),
                    'menu_id' => $this->request->getVar('menu_id'),
                    'url' => $this->request->getVar('url'),
                    'icon' => $this->request->getVar('icon'),
                    'is_active' => $this->request->getVar('is_active'),
                ];

                $this->submenuModel->save($newData);
                session()->setFlashdata([
                    'msg' => 'Successfull Added',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->back();
            }
        }
        return view('menu/submenu', $data);
    }

    public function deleteSubmenu($id)
    {
        $this->submenuModel->delete($id);
        session()->setFlashdata([
            'msg' => 'Successfull Deleted',
            'msg_alert' => 'alert-danger'
        ]);
        return redirect()->back();
    }

    public function editSm($id)
    {
        $data = [
            'title' => 'Submenu Management',
            'user' => $this->usersModel->where('email', session()->get('email'))
                ->first(),
            'menus' => $this->menuModel->table('user_menu')->get()
                ->getResultArray(),
            'menu' => $this->menuModel->table('user_menu')->first(),
            'subMenu' => $this->submenuModel->getSubmenuById($id),
            'validation' => \Config\Services::validation()
        ];
        helper(['form']);
        return view('menu/editSubmenu', $data);;
    }

    public function editSubmenu($id)
    {
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                'title' => 'required',
                'menu_id' => 'required',
                'url' => 'required',
                'icon' => 'required',
                // 'is_active' => 'required'
            ])) {
                return redirect()->to('/menu/editSm/' . $this->request->getVar('id'))->withInput();
                // $data['validation'] = $this->validator;
            } else {
                $newData = [
                    'id' => $id,
                    'title' => $this->request->getVar('title'),
                    'menu_id' => $this->request->getVar('menu_id'),
                    'url' => $this->request->getVar('url'),
                    'icon' => $this->request->getVar('icon'),
                    'is_active' => $this->request->getVar('is_active'),
                ];

                $this->submenuModel->save($newData);
                session()->setFlashdata([
                    'msg' => 'Successfull Edited',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->to('/menu/submenu');
            }
        }
    }
}
