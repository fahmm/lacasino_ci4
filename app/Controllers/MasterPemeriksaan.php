<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\KantorModel;
use App\Models\DokterModel;
use App\Models\MemberModel;
use App\Models\PendaftaranPemeriksaanModel;
use App\Models\KonfirmasiModel;
use App\Models\DataPemeriksaanModel;
use CodeIgniter\I18n\Time;

class MasterPemeriksaan extends BaseController
{
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->kantorModel = new KantorModel();
        $this->dokterModel = new DokterModel();
        $this->memberModel = new MemberModel();
        $this->pendaftaranPemeriksaanModel = new PendaftaranPemeriksaanModel();
        $this->konfirmasiModel = new KonfirmasiModel();
        $this->dataPemeriksaanModel = new DataPemeriksaanModel();

        helper(['form']);
    }

    public function index()
    {
        $konfirmasi = $this->konfirmasiModel->orderBy('id_pemeriksaan', 'DESC')->first();
        if ($konfirmasi) {
            $id_pemeriksaan = $konfirmasi['id_pemeriksaan'] + 1;
        } else {
            $id_pemeriksaan = 1;
        }
        $db = db_connect();
        $queryJoin = "SELECT a.*, b.nama_dokter, b.id as id_dokter, c.nama_member, d.file from tbl_pendaftaran_pemeriksaan a
            INNER JOIN tbl_dokter b
            ON a.id_dokter = b.id
            JOIN tbl_member c
            ON a.no_member = c.no_member
            JOIN tbl_konfirmasi d
            ON a.id_pemeriksaan = d.id_pemeriksaan
            where a.tgl_periksa = CURDATE()
            ";
        $data = [
            'title' => 'Pendaftaran Pemeriksaan',
            'user' => $this->usersModel->where('email', session()->get('email'))->first(),
            'dokter' => $this->dokterModel->get()->getResultArray(),
            'member' => $this->memberModel->get()->getResultArray(),
            'pendaftaranPemeriksaan' =>  $db->query($queryJoin)->getResultArray(),
            'validation' => \Config\Services::validation()
        ];

        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                'tgl_periksa' => 'required',
            ])) {
                $data['validation'] = $this->validator;
            } else {
                $newData = [
                    'no_member' => $this->request->getVar('no_member'),
                    'id_dokter' => $this->request->getVar('id_dokter'),
                    'tgl_periksa' => $this->request->getVar('tgl_periksa'),
                    'biaya' => 50000,
                    'no_antrian' => 0,
                    'status_pemeriksaan' => 'ok',
                    'id_pemeriksaan' => $id_pemeriksaan
                ];
                $newData2 = [
                    'no_member' => $this->request->getVar('no_member'),
                    'id_pemeriksaan' => $id_pemeriksaan,
                    'file' => 'default.png'
                ];
                $this->pendaftaranPemeriksaanModel->save($newData);
                $this->konfirmasiModel->save($newData2);
                session()->setFlashdata([
                    'msg' => 'Successfull Registered',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->to('/masterPemeriksaan');
            }
        }
        return view('/masterPemeriksaan/pendaftaranPemeriksaan', $data);
    }

    function pageImg($id)
    {
        $db = db_connect();

        $queryJoin = "SELECT * FROM tbl_pendaftaran_pemeriksaan a
        LEFT JOIN tbl_konfirmasi b
        ON a.id_pemeriksaan = b.id_pemeriksaan
        WHERE a.id_pemeriksaan = " . $id . "";
        $data = [
            'title' => 'File Konfirmasi',
            'fileKonfirmasi' => $this->konfirmasiModel->getWhere(['id_pemeriksaan' => $id])->getRowArray(),
            'fileKonfirmasi2' => $db->query($queryJoin)->getResultArray()
        ];

        return view('/masterPemeriksaan/pageImg', $data);
    }

    function setuju($id_pemeriksaan, $id_dokter, $tgl_periksa)
    {
        $kondisi = ['tgl_periksa' => $tgl_periksa, 'id_dokter' => $id_dokter];
        $antrian = $this->pendaftaranPemeriksaanModel->orderBy('no_antrian', 'DESC')->getWhere($kondisi)->getRowArray();
        if ($antrian) {
            $no_antrian = $antrian['no_antrian'] + 1;
        } else {
            $no_antrian = 1;
        }
        $this->pendaftaranPemeriksaanModel->updateNoAntrian($id_pemeriksaan, $no_antrian);
        session()->setFlashdata([
            'msg' => 'Berhasil mendapatkan nomor antrian',
            'msg_alert' => 'alert-success'
        ]);
        return redirect()->back();
    }

    public function dataPemeriksaan()
    {
        $db = db_connect();
        $keyword = $this->request->getVar('keyword');
        // if ($keyword) {
        //     $dataPemeriksaan = $this->dataPemeriksaanModel->search($keyword)->get()->getRowArray();
        // } else {
        //     $myTime = Time::now('Asia/Singapore');
        //     $keyword = $myTime->toDateString();
        //     $dataPemeriksaan = $this->dataPemeriksaanModel->search($keyword)->get()->getRowArray();
        // }
        if ($keyword) {
            $keyword = $keyword;
        } else {
            $myTime = Time::now('Asia/Singapore');
            $keyword = $myTime->toDateString();
        }

        $show = "SELECT * FROM tbl_pemeriksaan a
        LEFT JOIN tbl_pendaftaran_pemeriksaan b
        ON a.id_dokter = b.id_dokter AND a.tgl_periksa = b.tgl_periksa
        INNER JOIN tbl_dokter c
        ON a.id_dokter = c.id
        INNER JOIN tbl_member d
        ON b.no_member = d.no_member
        WHERE a.tgl_periksa = '" . $keyword . "'
        -- GROUP BY a.id_dokter
        ORDER BY a.id_dokter asc,  b.no_antrian asc
        ";

        $data = [
            'dokter' => $this->dokterModel->get()->getResultArray(),
            'title' => 'Data Pemeriksaan',
            'user' => $this->usersModel->where('email', session()->get('email'))->first(),
            'pendaftaranPemeriksaan' =>  $db->query($show)->getResultArray(),
            'validation' => \Config\Services::validation()
        ];


        // dd($data);
        if ($this->request->getMethod() == 'post') {

            if (!$this->validate([
                'tgl_periksa' => 'required',
            ])) {
                $data['validation'] = $this->validator;
            } else {
                $newData = [
                    'id_dokter' => $this->request->getVar('id_dokter'),
                    'tgl_periksa' => $this->request->getVar('tgl_periksa'),
                    'status_pemeriksaan' => 'ok',
                ];
                $newData2 = [
                    'no_member' => $this->request->getVar('no_member'),
                    'file' => 'default.png'
                ];
                $this->dataPemeriksaanModel->save($newData);
                // $this->konfirmasiModel->save($newData2);
                session()->setFlashdata([
                    'msg' => 'Successfull Registered',
                    'msg_alert' => 'alert-success'
                ]);
                return redirect()->to('/masterPemeriksaan/dataPemeriksaan');
            }
        }
        return view('/masterPemeriksaan/dataPemeriksaan', $data);
    }
}
