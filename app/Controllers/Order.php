<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourcePresenter;
use App\Models\OrderModel;
use App\Models\MenuModel;
use App\Models\DetailOrderM;
use App\Models\TransaksiModel;

class Order extends ResourcePresenter
{
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */

     public function __construct(){
         $this->order = new OrderModel();
         $this->menu = new MenuModel();
         $this->detail = new DetailOrderM();
         $this->transaksi = new TransaksiModel();
     }

    public function index()
    {

        $data = [
            'title' => 'Data Order',
            'order' => $this->order->getAllData(),
            'menu' => $this->menu->findAll(),
            'det' => $this->detail = new DetailOrderM()
        ];
        return view('order/index', $data);
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
            'order' => $this->order->getAllData(),
            'validation' => \Config\Services::validation()
        ];
        return view('order/create', $data);
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
            'nama_pelanggan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Field nama pelanggan harus diisi!'
                ]
            ]
        ])) {
          return redirect()->to(site_url('/order/new'))->withInput();
        }

        $nama_pelanggan = $this->request->getVar('nama_pelanggan');
        $meja = $this->request->getVar('no_meja');
        $user = $this->request->getVar('id_user');

        $data = [
            'nama_pelanggan' => $nama_pelanggan,
            'id_user' => $user,
            'no_meja' => $meja,
            'status_order' => 'Belum Bayar'
        ];

        $insert = $this->order->insert($data);

        if ($insert) {
            return redirect()->to(site_url('/order'))->with('success', 'Order Berhasil ditambah!');
        } else {
            return redirect()->to(site_url('/order'))->with('error', 'Data Gagal ditambah!');
        }
    }

    public function detail()
    {   
        $data = [
            'id_order' => $this->request->getVar('id_order'),
            'id_menu' => $this->request->getVar('id_menu'),
            'qty' => $this->request->getVar('qty')
            
        ];

        $insert = $this->detail->insert($data);

        if ($insert) {
            return redirect()->to(site_url('/order'))->with('success', 'Data Berhasil ditambah!');
        } else {
            return redirect()->to(site_url('/order'))->with('danger', 'Data gagal ditambah!');
        }
    }

    public function bayar(){
        $id_order = $this->request->getVar('id_order');
        $data = [
            'id_user' => $this->request->getVar('id_user'),
            'id_order' => $id_order,
            'total_bayar' => $this->request->getVar('total_bayar')
        ];

        $insert = $this->transaksi->insert($data);

        if ($insert) {

            $status = [
                'id_order' => $id_order,
                'status_order' => 'Sudah_Bayar'
            ];
            $this->order->save($status);
         
            return redirect()->to(site_url('/order'))->with('success', 'Data Berhasil ditambah!');
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
        //
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
        //
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
        $this->order->delete($id);
        $this->detail->where('id_order',$id)->delete();
        return redirect()->to(site_url('/order'))->with('success','Data Berhasil diHapus!');
       
    }

    public function deletedetail($id_order = null,$id_menu = null)
    {

        $this->detail->where(['id_order'=>$id_order,'id_menu'=>$id_menu])->delete();
        return redirect()->to(site_url('/order'));
    }
}
