<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\UserModel;

class User extends ResourcePresenter
{
    public function __construct()
    {
        $this->user = new UserModel();
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'title' => 'Data User',
            'user' => $this->user->getAllData()
        ];
        return view('user/index', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        session();
        $data = [
            'title' => 'Tambah Data',
            'user' => $this->user->getAllData(),
            'validation' => \Config\Services::validation()
        ];
        return view('user/create', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {

        if (!$this->validate([
            'nama' => 'required',
            'username' => 'required|is_unique[user.username]',
            'password' => 'required|min_length[7]|max_length[16]',
            'confirmpass' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password tidak boleh kosong'
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|is_image[gambar]|ext_in[gambar,jpg,jpeg,png]|max_size[gambar,5024]',
                'errors' => [
                    'uploaded' => 'User harus memiliki gambar!',
                    'is_image' => 'File yang diupload harus gambar!',
                    'ext_in' => 'Ekstensi gambar harus jpg/jpeg/png',
                    'max_size' => 'Ukuran gambar terlalu besar (Max 5mb)'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/user/new'))->withInput();
        }

        $getFile = $this->request->getFile('gambar');
        $namaFile = $getFile->getRandomName();
        $moveFile = $getFile->move('template/assets/img/profile', $namaFile);

    
        $nama = $this->request->getVar('nama');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $role = $this->request->getVar('id_level');

        $data = [
            'nama' => $nama,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'id_level' => $role,
            'gambar' => $namaFile
        ];

        $insert = $this->user->insert($data);
        
        if ($insert) {
            return redirect()->to(site_url('/user'))->with('success', 'Data Berhasil ditambah!');
        } else {
            return redirect()->to(site_url('/user'))->with('error', 'Data Gagal ditambah!');
        }
        
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        session();
        $user = $this->user->where('id_user', $id)->first();

        if (is_object($user)) {
            $data = [
                'title' => 'Edit User',
                'user' => $user,
                'validation' => \Config\Services::validation(),
            ];
            return view('user/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //validasi untuk password lama
        $currData = $this->user->find($id);
        $oldpass = $this->request->getVar('oldpass');
        $cekUser = $currData->password;

        //validasi username
        $currData = $this->user->find($id, 'id_user');
        $user = $currData->username;

        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong!'
                ]
            ],
            'username' => [
                'rules' => "required|is_unique[user.username,username,{$user}]",
                'errors' => [
                    'required' => 'Username tidak boleh kosong!',
                    'is_unique' => 'Username telah terdaftar!'
                ]
            ],
            'oldpass' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field Password lama tidak boleh kosong!'
                    
                ]
            ],
            'newpass' => [
                'rules' => 'required|min_length[7]',
                'errors' => [
                    'required' => 'Field Password Baru tidak boleh kosong!',
                    'min_length' => 'Password harus lebih dari 7 karakter!'
                ]
            ],
            'confirmpass' => [
                'rules' => 'required|matches[newpass]',
                'errors' => [
                    'required' => 'Field Password lama tidak boleh kosong!',
                    'matches' => 'Konfirmasi Password salah!'
                ]
            ],
            'gambar' => [
                'rules' => 'is_image[gambar]|ext_in[gambar,jpg,jpeg,png]|max_size[gambar,5024]',
                'errors' => [
                    'is_image' => 'File yang diupload harus gambar!',
                    'ext_in' => 'Ekstensi gambar harus jpg/jpeg/png',
                    'max_size' => 'Ukuran gambar terlalu besar (Max 5mb)'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to(site_url('/user/edit/' . $id))->withInput();
        }

        if ( password_verify($oldpass,$cekUser)) {

            $getFile = $this->request->getFile('gambar');
            
            //cek gambar
            if ($getFile->getError() == 4 ) {
               $namaFile = $this->request->getVar('gambarOld');

               if ($namaFile == NULL) {
                return redirect()->back()->with('error',"Data ini tidak memiliki gambar! upload terlebih dahulu!");
               }
            } else {
                $namaFile = $getFile->getRandomName();
                $moveFile = $getFile->move('template/assets/img/profile', $namaFile);
                
                unlink('assets/img/menu/' . $this->request->getVar('gambarOld'));
            }

          
            $nama = $this->request->getVar('nama');
            $username = $this->request->getVar('username');
            $newpass = $this->request->getVar('newpass');
            $id_level = $this->request->getVar('id_level');
    
            $data = [
                'nama' => $nama,
                'username' => $username,
                'password' => password_hash($newpass, PASSWORD_BCRYPT),
                'id_level' => $id_level,
                'gambar' => $namaFile
            ];
            $this->user->update($id, $data);
            return redirect()->to(site_url('/user'))->with('success', 'Data Berhasil diubah!');
        } else {
            return redirect()->back()->with('error',"Password lama tidak sesuai!");
        }
        
        
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id = null)
    {
        //
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $user = $this->user->find($id);
        $hapusGambar = $user->gambar;

        if ($hapusGambar == NULL) {
            $this->user->delete($id);
            return redirect()->to(site_url('/user'))->with('success', 'Data Berhasil diHapus!');
        } else {
            unlink('assets/img/profile/' . $hapusGambar);
            $this->user->delete($id);
            return redirect()->to(site_url('/user'))->with('success', 'Data Berhasil diHapus!');
        }
    }
}
