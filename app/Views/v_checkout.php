<?= $this->extend('navbar') ?>
<?= $this->section('content') ?>

<div class="untree_co-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
            </div>
        </div>

        <form action="/order" method="post">
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border bg-white">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_fname" class="text-black">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Street address">
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-12">
                                <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Phone Number">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subtotal = 0;
                                        foreach ($cart as $item):
                                            $subtotal += $item['harga'] * $item['kuantitas'];
                                            ?>
                                            <tr>
                                                <td><?= $item['nama_barang'] ?><strong
                                                        class="mx-2">x</strong><?= $item['kuantitas'] ?></td>
                                                <td>Rp <?= number_format($item['harga'] * $item['kuantitas'], 2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                            <td class="text-black">Rp. <?= number_format($subtotal, 2); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                            <td class="text-black font-weight-bold"><strong>Rp.
                                                    <?= number_format($subtotal, 2); ?></strong></td>
                                        </tr>
                                    </tbody>

                                </table>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-black btn-lg py-3 btn-block">Place
                                        Order</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </form>

        <!-- </form> -->
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>
<?= $this->endSection() ?>
</body>

</html>