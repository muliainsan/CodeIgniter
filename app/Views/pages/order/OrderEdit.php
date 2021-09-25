<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <form action="/Order/update/<?= $OrderData['Id']; ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="card">
                    <div class="card-header">

                        <h3>Update Order</h3>
                        <div class="row mb-2">
                            <input type="hidden" name="Id" value="<?= $OrderData['Id']; ?>">
                            <label for="inputOrderName" class="col-sm-2 col-form-label">Order Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= ($validation->hasError('inputOrderName')) ? 'is-invalid' : ''; ?>" id="inputOrderName" name="inputOrderName" value="<?= (old('inputOrderName')) ? old('inputOrderName') : $OrderData['OrderName']; ?>" autofocus>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('inputOrderName'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-hover text-nowrap ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Menu Name</th>
                                    <th>Price Menu</th>
                                    <th>Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($MenuData as $c) : ?>
                                    <tr>
                                        <td><?php echo $i++ ?></th>
                                        <td><?php echo $c['MenuName']; ?></th>
                                        <td><?php echo $c['Price']; ?></th>
                                        <td>
                                            <p>
                                            <div class="input-group center" style="width: 150px; margin: 10px auto;">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="quant[<?= $c['Id']; ?>]">
                                                        <b>-</b>
                                                    </button>
                                                </span>
                                                <input type="text" name="quant[<?= $c['Id']; ?>]" class="form-control input-number" value="<?php if (old('quant[' . $c['Id'] . ']')) {
                                                                                                                                                echo old('quant[' . $c['Id'] . ']');
                                                                                                                                            } elseif (array_search($c['Id'], array_column($OrderEntryData, 'MenuId')) !== false) {
                                                                                                                                                echo $OrderEntryData[array_search($c['Id'], array_column($OrderEntryData, 'MenuId'))]['Quantity'];
                                                                                                                                            } else {
                                                                                                                                                echo 0;
                                                                                                                                            }
                                                                                                                                            ?>" min="0" max="100">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?= $c['Id']; ?>]">
                                                        <b>+</b>
                                                    </button>
                                                </span>
                                            </div>
                                            <input hidden name="ids[<?= $c['Id']; ?>]" value="<?= $c['Id']; ?>">
                                            <input hidden name="price[<?= $c['Id']; ?>]" value="<?= $c['Price']; ?>">
                                            </p>
                                        </td>
                                    </tr>
                                <?php
                                endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>