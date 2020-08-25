<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\KantorModel;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->kantorModel = new KantorModel();
        helper(['form']);
    }

    public function officeProfile()
    {
        $data = [
            'title' => 'Profile Klinik',
            'user' => $this->usersModel->where('email', session()->get('email'))
                ->first(),
            'kantor' => $this->kantorModel
                ->first(),
        ];
        return view('profile/officeProfile', $data);
    }
}
