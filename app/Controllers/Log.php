<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogModel;

class Log extends BaseController
{
    public function __construct(){
        $this->log = new LogModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Data log',
            'log' => $this->log->getAllData()
        ];
        return view('log/index',$data);
    }
}
