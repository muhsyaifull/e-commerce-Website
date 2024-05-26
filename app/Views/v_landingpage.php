<?= $this->extend('navbar') ?>
<?= $this->section('content') ?>

<body>
    <div class="untree_co-section product-section before-footer-section">
        <!-- Start Product Section -->
        <div class="container">
            <div class="row">
                <?php foreach ($databarang as $barang): ?>
                    <div class="col-12 col-md-4 col-lg-3 mb-5">
                        <a class="product-item" href="<?= base_url('/cart/add/' . $barang['id_barang']) ?>">
                            <img src="<?= base_url('/images/' . $barang['gambar']) ?>" class="img-fluid product-thumbnail">
                            <h3 class="product-title"><?= $barang['namaBarang'] ?></h3>
                            <strong class="product-price">Rp <?= $barang['harga'] ?></strong>
                            <h3 class="product-stock"><?= $barang['stok'] ?></h3>
                            <span class="icon-cross">
                                <img src="images/cross.svg" class="img-fluid">
                            </span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- End Product Section -->
    </div>

    <?= $this->endSection() ?>