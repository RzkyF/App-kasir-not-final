<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        return redirect()->to(site_url('login'));
    }

    public function login()
    {
        if (session('id_user')) {
            return redirect()->to(site_url('/home'));
           } 
    
           return view('auth/index');
    }

    public function do_login()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('user')->getWhere(['username' => $post['username'] ]);
        $user = $query->getRow();

        if ($user) {
            if (password_verify($post['password'], $user->password)) {
                $params = [
                    'id_user' => $user->id_user,
                    'nama' => $user->nama,
                    'role' => $user->id_level,
                    'gambar' => $user->gambar
            ];
                session()->set($params);
                return redirect()->to(site_url('/home'));
            } else {
                return redirect()->back()->withInput()->with('error','Password Tidak Valid!');
            }
        } else {
            return redirect()->back()->withInput()->with('error','Username Tidak Valid!');
        }
    }

    public function logout(){
        session()->remove('id_user');

        return redirect()->to(site_url('login'));
    }
}
