<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJualTable extends Migration
{
    // public function up()
    // {
    //     // Pastikan tabel dan kolom referensi sudah ada dan benar

    //     // Definisikan tabel Jual
    //     $this->forge->addField([
    //         'id_penjualan' => [
    //             'type' => 'INT',
    //             'constraint' => 10,
    //             'unsigned' => true,
    //         ],
    //         'id_barang' => [
    //             'type' => 'INT',
    //             'constraint' => 10,
    //             'unsigned' => true,
    //         ],
    //         'jumlah' => [
    //             'type' => 'INT',
    //             'constraint' => 10,
    //         ],
    //         'harga' => [
    //             'type' => 'VARCHAR',
    //             'constraint' => 100,
    //         ],
    //     ]);
    //     $this->forge->addKey(['id_penjualan', 'id_barang'], true);
    //     $this->forge->addForeignKey('id_penjualan', 'penjualan', 'id_penjualan', 'CASCADE', 'CASCADE');
    //     $this->forge->addForeignKey('id_barang', 'barang', 'id_barang', 'CASCADE', 'CASCADE');
    //     $this->forge->createTable('jual');
    // }

    // public function down()
    // {
    //     // Kemudian hapus tabel
    //     $this->forge->dropTable('jual');
    // }
    public function up()
    {
        $this->forge->addField([
            'id_jual' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_penjualan' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'id_barang' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'total_harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);

        $this->forge->addPrimaryKey('id_jual');
        $this->forge->addForeignKey('id_penjualan', 'penjualan', 'id_penjualan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_barang', 'barang', 'id_barang', 'CASCADE', 'CASCADE');
        $this->forge->createTable('jual');
    }

    public function down()
    {
        $this->forge->dropTable('jual');
    }
}
