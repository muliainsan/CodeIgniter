<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <form action="/Order/save" method="POST">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="inputOrderName" class="col-sm-2 col-form-label">Order Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('inputOrderName')) ? 'is-invalid' : ''; ?>" id="inputOrderName" name="inputOrderName" value="<?= old('inputOrderName'); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputOrderName'); ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h1>Order Data</h1>
                        <p class="card-text"> Create, Read, Update, Delete (CRUD) for Order datas</p>
                    </div>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
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
                                            <div class="input-group" style="width: 150px; margin: 5px auto;">
                                                <span class="input-group-btn">
                                                    <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="quant[<?= $c['Id']; ?>]">
                                                        <b>-</b>
                                                    </button>
                                                </span>
                                                <input type="text" name="quant[<?= $c['Id']; ?>]" class="form-control input-number" value="0" min="0" max="100" size="31">

                                                <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[<?= $c['Id']; ?>]">
                                                    <b>+</b>
                                                </button>
                                            </div>
                                            <input hidden name="id[<?= $c['Id']; ?>]" value="<?= $c['Id']; ?>">
                                            <input hidden name="price[<?= $c['Id']; ?>]" value="<?= $c['Price']; ?>">
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

                <button type="submit" class="btn btn-primary">Add</button>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>