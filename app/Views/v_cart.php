<?= $this->extend('navbar') ?>
<?= $this->section('content') ?>
<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">
            <form class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <?php if (empty($cart)): ?>
                        <p class="text-center">Tidak ada barang di cart</p>
                    <?php else: ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Gambar</th>
                                    <th class="product-nama_barang">Barang</th>
                                    <th class="product-harga">Harga</th>
                                    <th class="product-stok">Jumlah Barang</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart as $item): ?>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <img src="<?= base_url('images/' . $item['gambar']) ?>" alt="gambar"
                                                class="img-fluid">
                                        </td>
                                        <td class="product-nama_barang">
                                            <h2 class="h5 text-black"><?= $item['nama_barang'] ?></h2>
                                        </td>
                                        <td>Rp <?= number_format($item['harga'], 2); ?></td>
                                        <td>
                                            <div class="input-group mb-3 d-flex align-items-center quantity-container"
                                                style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <a href="<?= base_url('cart/kurangi-barang/' . $item['id_barang']) ?>"
                                                        class="btn btn-outline-black decrease" type="button">&minus;</a>
                                                </div>
                                                <input type="text" class="form-control text-center quantity-amount"
                                                    value="<?= $item['kuantitas'] ?>" readonly>
                                                <div class="input-group-append">
                                                    <a href="<?= base_url('cart/tambah-barang/' . $item['id_barang']) ?>"
                                                        class="btn btn-outline-black increase" type="button">&plus;</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rp. <?= number_format($item['harga'] * $item['kuantitas'], 2); ?></td>
                                        <td><a href="<?= base_url('/cart/delete/' . $item['id_barang']) ?>"
                                                class="btn btn-black btn-sm">X</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <?php if (!empty($cart)): ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-black btn-sm btn-block">Update Cart</button>
                        </div>
                        <div class="col-md-6">
                            <a href="<?= base_url('shop') ?>" class="btn btn-outline-black btn-sm btn-block">Continue
                                Shopping</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">Rp. <?= number_format(array_sum(array_map(function ($item) {
                                        return $item['harga'] * $item['kuantitas'];
                                    }, $cart)), 2); ?></strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="/checkout"><button class="btn btn-black btn-lg py-3 btn-block">Proceed To
                                            Checkout</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>
<?= $this->endSection() ?>