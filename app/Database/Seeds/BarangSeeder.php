<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'namaBarang' => 'Product 1',
                'harga' => '100',
                'stok' => 10,
                'gambar' => 'product-1.png',
            ],
            [
                'namaBarang' => 'Product 2',
                'harga' => '150',
                'stok' => 20,
                'gambar' => 'product-2.png',
            ],
            [
                'namaBarang' => 'Product 3',
                'harga' => '200',
                'stok' => 15,
                'gambar' => 'product-3.png',
            ],
            [
                'namaBarang' => 'Product 4',
                'harga' => '120',
                'stok' => 8,
                'gambar' => 'product-1.png',
            ],
            [
                'namaBarang' => 'Product 5',
                'harga' => '180',
                'stok' => 12,
                'gambar' => 'product-2.png',
            ],
        ];

        // Insert data to table 'Databarang'
        $this->db->table('barang')->insertBatch($data);
    }
}
