<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\MenuModel;

class Menu extends ResourcePresenter
{
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function __construct()
    {
        $this->menu = new MenuModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data menu',
            'menu' => $this->menu->findAll()
        ];
        return view('menu/index', $data);
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
            'title' => 'Tambah Menu',
            'validation' => \Config\Services::validation()
        ];
        return view('menu/create', $data);
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
            'nama_menu' => [
                'rules' => 'required|is_unique[menu.nama_menu]',
                'errors' => [
                    'required' => 'Nama Menu tidak boleh kosong!',
                    'is_unique' => 'Menu ini telah terdaftar!'
                ]
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Menu Harus dipilih!'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field Harga tidak boleh kosong!'
                ]
            ],
            'status_masakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Menu Harus dipilih!'
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|is_image[gambar]|ext_in[gambar,jpg,jpeg,png]|max_size[gambar,5024]',
                'errors' => [
                    'uploaded' => 'Menu harus memiliki gambar!',
                    'is_image' => 'File yang diupload harus gambar!',
                    'ext_in' => 'Ekstensi gambar harus jpg/jpeg/png',
                    'max_size' => 'Ukuran gambar terlalu besar (Max 5mb)'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to(site_url('/menu/new'))->withInput()->with('validation', $validation);
            return redirect()->to(site_url('/menu/new'))->withInput();
        }

        $getFile = $this->request->getFile('gambar');
        $namaFile = $getFile->getRandomName();
        $moveFile = $getFile->move('template/assets/img/menu', $namaFile);

        $nama_menu = $this->request->getVar('nama_menu');
        $jenis = $this->request->getVar('jenis');
        $harga = $this->request->getVar('harga');
        $status = $this->request->getVar('status_masakan');

        $data = [
            'nama_menu' => $nama_menu,
            'jenis' => $jenis,
            'harga' => $harga,
            'status_masakan' => $status,
            'gambar' => $namaFile
        ];

        $insert = $this->menu->insert($data);

        if ($insert) {
            return redirect()->to(site_url('/menu'))->with('success', 'Data Berhasil ditambah!');
        } else {
            return redirect()->to(site_url('/menu'))->with('error', 'Data Berhasil ditambah!');
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

        $menu = $this->menu->where('id_menu', $id)->first();
        if (is_object($menu)) {
            $data = [
                'title' => 'Edit',
                'menu' => $menu,
                'validation' => \Config\Services::validation(),
            ];

            return view('menu/edit', $data);
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
        $currData = $this->menu->find($id, 'id_menu');
        $cek = $currData->nama_menu;

        if (!$this->validate([
            'nama_menu' => [
                'rules' => "required|is_unique[menu.nama_menu,nama_menu,{$cek}]",
                'errors' => [
                    'required' => 'Nama Menu tidak boleh kosong!',
                    'is_unique' => 'Menu ini telah terdaftar!'
                ]
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Menu Harus dipilih!'
                ]
            ],
            'harga' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field Harga tidak boleh kosong!'
                ]
            ],
            'status_masakan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Menu Harus dipilih!'
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|is_image[gambar]|ext_in[gambar,jpg,jpeg,png]|max_size[gambar,5024]',
                'errors' => [
                    'uploaded' => 'Menu harus memiliki gambar!',
                    'is_image' => 'File yang diupload harus gambar!',
                    'ext_in' => 'Ekstensi gambar harus jpg/jpeg/png',
                    'max_size' => 'Ukuran gambar terlalu besar (Max 5mb)'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to(site_url('/menu/new'))->withInput()->with('validation', $validation);
            return redirect()->to(site_url('/menu/edit/' . $id))->withInput();
        }

        $getFile = $this->request->getFile('gambar');
        $namaFile = $getFile->getRandomName();
        $moveFile = $getFile->move('template/assets/img/menu', $namaFile);

        $nama_menu = $this->request->getVar('nama_menu');
        $jenis = $this->request->getVar('jenis');
        $harga = $this->request->getVar('harga');
        $status = $this->request->getVar('status_masakan');

        $data = [
            'nama_menu' => $nama_menu,
            'jenis' => $jenis,
            'harga' => $harga,
            'status_masakan' => $status,
            'gambar' => $namaFile

        ];

        $update = $this->menu->update($id, $data);

        if ($update) {
            return redirect()->to(site_url('/menu'))->with('success', 'Data Berhasil diubah!');
        } else {
            return redirect()->to(site_url('/menu'))->with('error', 'Data Gagal diubah!');
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
        $menu = $this->menu->find($id);
        $hapusGambar = $menu->gambar;

        if ($hapusGambar != NULL) {
            $this->menu->delete($id);
            return redirect()->to(site_url('/menu'))->with('success', 'Data Berhasil diHapus!');
        } else {
            unlink('assets/img/menu/' . $hapusGambar);
            $this->menu->delete($id);
            return redirect()->to(site_url('/menu'))->with('success', 'Data Berhasil diHapus!');
        }
    }
}
