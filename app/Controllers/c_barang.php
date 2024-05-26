<?php

namespace App\Controllers;

use App\Models\m_barang;
use App\Models\m_jual;
use CodeIgniter\Controller;

class c_barang extends Controller
{
    public function index()
    {
        $barangModel = new m_barang();
        $data['databarang'] = $barangModel->getAllBarang();
        return view("v_landingpage", $data);
    }
}
