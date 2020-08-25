<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\KantorModel;
use App\Models\DokterModel;
use App\Models\MemberModel;
use App\Models\KonfirmasiModel;
use App\Models\PendaftaranPemeriksaanModel;


class Landing extends BaseController
{
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->kantorModel = new KantorModel();
        $this->dokterModel = new DokterModel();
        $this->memberModel = new MemberModel();
        $this->konfirmasiModel = new KonfirmasiModel();
        $this->pendaftaranPemeriksaanModel = new PendaftaranPemeriksaanModel();

        helper(['form']);
    }

    private function setUserSession($members)
    {
        $data = [
            'id' => $members['id'],
            'nama_member' => $members['nama_member'],
            'no_member' => $members['no_member'],
            'username' => $members['username'],
            'memberIsLoggedIn' => true,
            'role_id' => $members['role_id'],
        ];

        session()->set($data);
        return true;
    }

    public function index()
    {
        $konfirmasi = $this->konfirmasiModel->orderBy('id_pemeriksaan', 'DESC')->first();
        if ($konfirmasi) {
            $id_pemeriksaan = $konfirmasi['id_pemeriksaan'] + 1;
        } else {
            $id_pemeriksaan = 1;
        }
        $sesNoMember = session()->get('no_member');
        $db = db_connect();
        $queryJoin = "select a.*, b.nama_dokter, b.nip , b.id as id_dokter, c.nama_member, c.id as id_member from tbl_pendaftaran_pemeriksaan a
            INNER JOIN tbl_dokter b
            ON a.id_dokter = b.id
            JOIN tbl_member c
            ON a.no_member = c.no_member
           where a.no_member ='" . $sesNoMember . "'";
        $data = [
            'title' => 'Klinik Lacasino',
            'dokter' => $this->dokterModel->get()->getResultArray(),
            'member' => $this->memberModel->get()->getResultArray(),
            'member_' => $this->memberModel->first(),
            'kantor' => $this->kantorModel->get()->getResultArray(),
            'validation' => \Config\Services::validation(),
            'pendaftaranPemeriksaan' => $db->query($queryJoin)->getResultArray(),
            'id_pemeriksaan' => $id_pemeriksaan

        ];
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                'username' => 'required',
                'password' => 'required|min_length[3]|max_length[255]',
            ])) {
                $data['validation'] = $this->validator;
            } else {
                $password = $this->request->getVar('password');
                $members = $this->memberModel->where('username', $this->request->getVar('username'))
                    ->first();
                // jika usernya ada
                if ($members) {

                    //cek password
                    if (password_verify($password, $members['password'])) {
                        $this->setUserSession($members);
                        // dd($members);
                        return redirect()->back();
                    } else {
                        session()->setFlashdata([
                            'msg' => 'Email or Password do not match',
                            'msg_alert' => 'alert-danger'
                        ]);
                    }
                } else {
                    session()->setFlashdata([
                        'msg' => 'Username is not registered!',
                        'msg_alert' => 'alert-danger'
                    ]);
                }
            }
        }

        return view('/home/index', $data);
    }

    public function memberRegister()
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
            'title' => 'Member Registration',
            'no_member' => $kode,
            'validation' => \Config\Services::validation()
        ];
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
                    'status_member' => 'Tidak Aktif',
                    'username' => $this->request->getVar('username'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'status_login' => 'login',
                    'role_id' => 0,
                ];

                $this->memberModel->save($newData);
                session()->setFlashdata([
                    'msg' => 'Pendaftaran Berhasil, silahkan tunggu pengaktifan akun anda, terima kasih',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->to('/landing/pendaftaranPemeriksaan');
            }
        }
        return view('/home/register', $data);
    }

    public function logout()
    {
        // session()->destroy();

        session()->remove(['id', 'nama_member', 'username', 'memberIsLoggedIn', 'role_id']);

        session()->setFlashdata([
            'msg' => 'You have been logout',
            'msg_alert' => 'alert-danger'
        ]);
        return redirect()->to('/landing');
    }

    public function pendaftaranPemeriksaan()
    {
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                'tgl_periksa' => 'required',
            ])) {
                $data['validation'] = $this->validator;
                return redirect()->back()->withInput();
            } else {
                $newData = [
                    'no_member' => session()->get('no_member'),
                    'id_dokter' => $this->request->getVar('id_dokter'),
                    'tgl_periksa' => $this->request->getVar('tgl_periksa'),
                    'biaya' => 50000,
                    'no_antrian' => 0,
                    'status_pemeriksaan' => 'BELUM MEMBAYAR',
                    'id_pemeriksaan' => 0,
                ];

                $this->pendaftaranPemeriksaanModel->save($newData);
                session()->setFlashdata([
                    'msg' => 'Successfull Registered',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->to('/landing');
            }
        }
    }

    public function memberConfirm()
    {

        $konfirmasi = $this->konfirmasiModel->orderBy('id_pemeriksaan', 'DESC')->first();
        if ($konfirmasi) {
            $id_pemeriksaan = $konfirmasi['id_pemeriksaan'] + 1;
        } else {
            $id_pemeriksaan = 1;
        }
        $sesNoMember = session()->get('no_member');
        $db = db_connect();
        $queryJoin = "select a.*, b.nama_dokter, b.nip , b.id as id_dokter, c.nama_member, c.id as id_member from tbl_pendaftaran_pemeriksaan a
            INNER JOIN tbl_dokter b
            ON a.id_dokter = b.id
            JOIN tbl_member c
            ON a.no_member = c.no_member
           where a.no_member ='" . $sesNoMember . "'";
        $data = [
            'title' => 'Klinik Lacasino',
            'dokter' => $this->dokterModel->get()->getResultArray(),
            'member' => $this->memberModel->get()->getResultArray(),
            'member_' => $this->memberModel->first(),
            'kantor' => $this->kantorModel->get()->getResultArray(),
            'validation' => \Config\Services::validation(),
            'pendaftaranPemeriksaan' => $db->query($queryJoin)->getResultArray(),
            'id_pemeriksaan' => $id_pemeriksaan
        ];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'imgKonfirmasi' => 'max_size[imgKonfirmasi,1024]|is_image[imgKonfirmasi]|mime_in[imgKonfirmasi,image/jpg,image/jpeg,image/png]'
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $fileImage = $this->request->getFile('imgKonfirmasi');
                if ($fileImage->getError() == 4) {
                    $namaImage = 'default.png';
                } else {
                    $namaImage = $fileImage->getRandomName();
                    // pindahkan gambar 
                    $fileImage->move('img/konfirmasi', $namaImage);
                }
                $newData = [
                    'no_member' => session()->get('no_member'),
                    'id_pemeriksaan' => $id_pemeriksaan,
                    'file' => $namaImage
                ];
                $id = $this->request->getPost('callId');
                $this->konfirmasiModel->save($newData);
                $this->konfirmasiModel->updateKonfirmasiStatus($id, $id_pemeriksaan);
                session()->setFlashdata([
                    'msg' => 'Konfirmasi Berhasil',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->back();
            }
            return view('/home/index', $data);
        }
    }
}
