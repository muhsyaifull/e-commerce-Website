<?php

namespace App\Models;

use CodeIgniter\Model;

class m_jual extends Model
{
    protected $table = 'jual';
    protected $primaryKey = 'id_jual';
    protected $allowedFields = ['id_penjualan', 'id_barang', 'jumlah', 'harga', 'total_harga'];
}
