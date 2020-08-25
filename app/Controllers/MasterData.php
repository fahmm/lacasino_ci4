<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\DokterModel;
use App\Models\MemberModel;

class MasterData extends BaseController
{
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->dokterModel = new DokterModel();
        $this->memberModel = new MemberModel();
        helper(['form']);
    }

    public function dokter()
    {
        $data = [
            'title' => 'Dokter',
            'user' => $this->usersModel->where('email', session()->get('email'))->first(),
            'dokter' => $this->dokterModel->get()->getResultArray(),
        ];
        return view('masterData/dokter', $data);
    }

    public function tambahDokter()
    {

        $data = [
            'title' => 'Tambah Dokter',
            'user' => $this->usersModel->where('email', session()->get('email'))
                ->first(),
            'dokter' => $this->dokterModel->get()->getResultArray(),
            'validation' => \Config\Services::validation()
        ];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                'nama_dokter' => 'required'
            ])) {
                $data['validation'] = $this->validator;
            } else {
                $newData = [
                    'nama_dokter' => $this->request->getVar('nama_dokter'),
                    'nip' => $this->request->getVar('nip'),
                    'spesialis' => $this->request->getVar('spesialis'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'jadwal' => $this->request->getVar('jadwal'),
                ];

                $this->dokterModel->save($newData);
                session()->setFlashdata([
                    'msg' => 'Successfull Added',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->to('/masterData/dokter');
            }
        }
        return view('/masterData/addDokter', $data);
    }

    public function deleteDokter($id)
    {
        $this->dokterModel->delete($id);
        session()->setFlashdata([
            'msg' => 'Successfull Deleted',
            'msg_alert' => 'alert-danger'
        ]);
        return redirect()->to('/masterData/dokter');
    }

    public function editDktr($id)
    {
        $data = [
            'title' => 'Edit Dokter',
            'user' => $this->usersModel->where('email', session()->get('email'))
                ->first(),
            'dokter' => $this->dokterModel->getDokterById($id),
            'validation' => \Config\Services::validation()
        ];
        helper(['form']);
        return view('masterData/editDokter', $data);;
    }

    public function editDokter($id)
    {
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                'nama_dokter' => 'required'
            ])) {
                return redirect()->to('/masterData/editDktr/' . $this->request->getVar('id'))->withInput();
                // $data['validation'] = $this->validator;
            } else {
                $newData = [
                    'id' => $id,
                    'nama_dokter' => $this->request->getVar('nama_dokter'),
                    'nip' => $this->request->getVar('nip'),
                    'spesialis' => $this->request->getVar('spesialis'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'jadwal' => $this->request->getVar('jadwal'),
                ];

                $this->dokterModel->save($newData);
                session()->setFlashdata([
                    'msg' => 'Successfull Edited',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->to('/masterData/dokter');
            }
        }
    }

    public function memberConfirm($id)
    {
        $this->memberModel->updateMemberStatus($id);
        session()->setFlashdata([
            'msg' => 'Sukses dikonfirmasi',
            'msg_alert' => 'alert-success'
        ]);
        return redirect()->to('/masterData/member');
    }

    public function member()
    {
        // $member = $this->memberModel->get()->getResultArray();
        // $status_member = 'aktif';
        // $role_id = $member['role_id'];

        // $statusMember = if ($member['role_id'] == 5) {
        // $this->memberModel->set('status_member', $status_member);
        // $this->memberModel->where('email', $email);
        // $this->memberModel->update();
        // }
        $data = [
            'title' => 'Member',
            'user' => $this->usersModel->where('email', session()->get('email'))->first(),
            'member' => $this->memberModel->get()->getResultArray(),
        ];
        return view('masterData/member', $data);
    }

    public function tambahMember()
    {
        $member = $this->memberModel->orderBy('no_member', 'DESC')->first();
        $kodeawal = substr($member['no_member'], 3, 4) + 1;
        if ($kodeawal < 10) {
            $kode = 'MKL000' . $kodeawal;
        } elseif ($kodeawal > 9 && $kodeawal <= 99) {
            $kode = 'MKL00' . $kodeawal;
        } else {
            $kode = 'MKL0' . $kodeawal;
        }
        $data = [
            'title' => 'Tambah Member',
            'user' => $this->usersModel->where('email', session()->get('email'))
                ->first(),
            'no_member' => $kode,
            'validation' => \Config\Services::validation()
        ];

        helper(['form']);

        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                'nama_member' => 'required',
                'username' => 'required',
                'password' => 'required|min_length[3]|max_length[255]',
            ])) {
                $data['validation'] = $this->validator;
            } else {

                $newData = [
                    'nama_member' => $this->request->getVar('nama_member'),
                    'no_member' => $kode,
                    'alamat' => $this->request->getVar('alamat'),
                    'jenkel' => $this->request->getVar('jenkel'),
                    'usia' => $this->request->getVar('usia'),
                    'pekerjaan' => $this->request->getVar('pekerjaan'),
                    'status' => $this->request->getVar('status'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'status_member' => 'Aktif',
                    'username' => $this->request->getVar('username'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'status_login' => 'login',
                    'role_id' => 5
                ];

                $this->memberModel->save($newData);
                session()->setFlashdata([
                    'msg' => 'Successfull Added',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->to('/masterData/member');
            }
        }
        return view('/masterData/addmember', $data);
    }

    public function deleteMember($id)
    {
        $this->memberModel->delete($id);
        session()->setFlashdata([
            'msg' => 'Successfull Deleted',
            'msg_alert' => 'alert-danger'
        ]);
        return redirect()->to('/masterData/member');
    }

    public function editMmbr($id)
    {
        $data = [
            'title' => 'Edit Member',
            'user' => $this->usersModel->where('email', session()->get('email'))
                ->first(),
            'member' => $this->memberModel->getmemberById($id),
            'validation' => \Config\Services::validation()
        ];
        helper(['form']);
        return view('masterData/editMember', $data);;
    }

    public function editMember($id)
    {
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                'nama_member' => 'required'
            ])) {
                return redirect()->to('/masterData/editMmbr/' . $this->request->getVar('id'))->withInput();
                // $data['validation'] = $this->validator;
            } else {
                $newData = [
                    'id' => $id,
                    'nama_member' => $this->request->getVar('nama_member'),
                    'nip' => $this->request->getVar('nip'),
                    'spesialis' => $this->request->getVar('spesialis'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'jadwal' => $this->request->getVar('jadwal'),
                    'nama_member' => $this->request->getVar('nama_member'),
                    'no_member' => $this->request->getVar('no_member'),
                    'alamat' => $this->request->getVar('alamat'),
                    'jenkel' => $this->request->getVar('jenkel'),
                    'usia' => $this->request->getVar('usia'),
                    'pekerjaan' => $this->request->getVar('pekerjaan'),
                    'status' => $this->request->getVar('status'),
                    'no_hp' => $this->request->getVar('no_hp'),
                    'status_member' => 'aktif',
                    'status_login' => 'login',
                    'role_id' => 5
                ];
                if ($this->request->getPost('password') != '') {
                    $newData = [
                        'username' => $this->request->getVar('username'),
                        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    ];
                }

                $this->memberModel->save($newData);
                session()->setFlashdata([
                    'msg' => 'Successfull Edited',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->to('/masterData/member');
            }
        }
    }
}
