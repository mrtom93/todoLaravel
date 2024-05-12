<?php

namespace App\Http\Controllers\Halo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HaloController extends Controller
//buat function untuk controler return langsung
{
    public function index(){
        $nama = "Joko";
        $data = ['nama' => $nama];
        return view('coba.halo', $data);
    }
};


