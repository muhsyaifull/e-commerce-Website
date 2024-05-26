<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\m_barang;
use App\Models\m_jual;
use App\Models\m_penjualan;
use CodeIgniter\HTTP\RequestInterface;

class c_cart extends BaseController
{
    protected $db;

    public function __construct()
    {
        // Inisialisasi database
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];
        return view('v_cart', ['cart' => $cart]);
    }

    public function addToCart($barangId)
    {
        $session = session();
        $barangModel = new m_barang();
        $barang = $barangModel->find($barangId);

        if (!$barang) {
            return redirect()->back()->with('error', 'barang tidak ditemukan');
        }

        $cart = $session->get('cart') ?? [];
        if (isset($cart[$barangId])) {
            $cart[$barangId]['kuantitas'] += 1;
        } else {
            $cart[$barangId] = [
                'id_barang' => $barang['id_barang'],
                'nama_barang' => $barang['namaBarang'],
                'harga' => $barang['harga'],
                'kuantitas' => 1,
                'gambar' => $barang['gambar']
            ];
        }

        $session->set('cart', $cart);

        return redirect()->to('/shop');
    }

    public function tambahbarang($id_barang)
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        if (isset($cart[$id_barang])) {
            $cart[$id_barang]['kuantitas']++;
        } else {
            // Retrieve barang details from the database
            $itemModel = new m_barang();
            $barang = $itemModel->find($id_barang);
            if ($barang) {
                $cart[$id_barang] = [
                    'id_barang' => $barang['id_barang'],
                    'nama_barang' => $barang['namaBarang'],
                    'price' => $barang['harga'],
                    'kuantitas' => 1,
                    'gambar' => $barang['gambar']
                ];
            }
        }

        $session->set('cart', $cart);
        return redirect()->to('/cart');
    }

    public function kurangiBarang($id_barang)
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        if (isset($cart[$id_barang])) {
            if ($cart[$id_barang]['kuantitas'] > 1) {
                $cart[$id_barang]['kuantitas']--;
            } else {
                unset($cart[$id_barang]);
            }
        }

        $session->set('cart', $cart);
        return redirect()->to('/cart');
    }

    public function deleteFromCart($barangId)
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        if (isset($cart[$barangId])) {
            unset($cart[$barangId]);
            $session->set('cart', $cart);
        }

        return redirect()->to('/cart');
    }

    public function checkout()
    {
        $session = session();
        $cart = $session->get('cart', []);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['harga'] * $item['kuantitas'];
        }
        $data['cart'] = $cart;
        $data['subtotal'] = $subtotal;
        $data['total'] = $subtotal;
        return view('v_checkout', $data);
    }

    public function order()
    {
        $request = \Config\Services::request();

        // Nonaktifkan pemeriksaan kunci asing
        $this->db->query('SET FOREIGN_KEY_CHECKS=0;');

        $jualModel = new m_jual();
        $penjualanModel = new m_penjualan();
        $barangModel = new m_barang();

        // Ambil data dari POST
        $nama = $request->getPost('name');
        $alamat = $request->getPost('address');
        $hp = $request->getPost('phone');

        // Hitung total order
        $cart = session()->get('cart');
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['harga'] * $item['kuantitas'];
        }

        // Simpan data ke tabel penjualan
        $dataPenjualan = [
            'nama' => $nama,
            'alamat' => $alamat,
            'no_hp' => $hp,
        ];

        // Insert data and get insertID
        if ($penjualanModel->insert($dataPenjualan)) {
            $idPenjualan = $penjualanModel->insertID();
            // dd($idPenjualan);
            log_message('debug', 'Insert ID: ' . $idPenjualan); // Debugging line

            // Simpan data detail penjualan
            foreach ($cart as $item) {
                $barang = $barangModel->find($item['id_barang']);
                $total_harga = $item['harga'] * $item['kuantitas'];
                if ($barang) {
                    // Data yang akan disimpan ke tabel jual
                    $dataJual = [
                        'id_penjualan' => $idPenjualan,
                        'id_barang' => $item['id_barang'],
                        'harga' => $item['harga'],
                        'jumlah' => $item['kuantitas'],
                        'total_harga' => $total_harga
                    ];
                    log_message('debug', 'Data Jual: ' . json_encode($dataJual)); // Debugging line
                    $jualModel->save($dataJual);

                    // Kurangi stok barang
                    $barang['stok'] -= $item['kuantitas'];
                    $barangModel->save($barang);
                }
            }

            // Aktifkan kembali pemeriksaan kunci asing
            $this->db->query('SET FOREIGN_KEY_CHECKS=1;');

            // Hapus keranjang dari sesi setelah checkout selesai
            session()->remove('cart');

            // Redirect ke halaman sukses atau yang lainnya
            return redirect()->to('berhasil')->with('message', 'Order berhasil disimpan!');
        } else {
            // Aktifkan kembali pemeriksaan kunci asing jika insert gagal
            $this->db->query('SET FOREIGN_KEY_CHECKS=1;');

            // Redirect atau menampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Gagal menyimpan data penjualan.');
        }
    }



    public function berhasil()
    {
        return view('message');
    }

}

































// }
//     $request = \Config\Services::request();
//     $session = session();
//     $cart = $session->get('cart', []);

//     $nama = $request->getPost('name');
//     $alamat = $request->getPost('address');
//     $hp = $request->getPost('phone');

//     // Buat instance dari model
//     $jualModel = new m_jual();
//     $penjualanModel = new m_penjualan();
//     $barangModel = new m_barang();

//     // Data yang akan disimpan
//     $dataPenjualan = [
//         'nama' => $nama,
//         'alamat' => $alamat,
//         'no_hp' => $hp,
//     ];

//     // Simpan data ke dalam database dan dapatkan id_penjualan
//     if ($penjualanModel->insert($dataPenjualan)) {
//         $idPenjualan = $penjualanModel->insertID();

//         // Debugging: cek nilai idPenjualan
//         if (!$idPenjualan) {
//             return redirect()->back()->with('error', 'Gagal mendapatkan ID Penjualan.');
//         }

//         // Loop melalui keranjang dan simpan data ke dalam tabel jual
//         foreach ($cart as $item) {
//             $barang = $barangModel->find($item['id_barang']);

//             if ($barang) {
//                 // Data yang akan disimpan ke tabel jual
//                 $dataJual = [
//                     'id_penjualan' => $idPenjualan,
//                     'id_barang' => $item['id_barang'],
//                     'harga' => $item['harga'],
//                     'jumlah' => $item['kuantitas']
//                 ];

//                 // Debugging: pastikan dataJual benar
//                 log_message('debug', 'dataJual: ' . json_encode($dataJual));

//                 $barang['stok'] -= $item['kuantitas'];
//                 $jualModel->save($dataJual);
//                 $barangModel->save($barang);
//             }
//         }

//         // Kosongkan keranjang setelah order disimpan
//         $session->remove('cart');

//         // Tampilkan pesan sukses atau redirect ke halaman lain
//         return redirect()->to('berhasil')->with('message', 'Order berhasil disimpan!');
//     } else {
//         // Handle error jika data penjualan gagal disimpan
//         return redirect()->back()->with('error', 'Gagal menyimpan data penjualan.');
//     }