<?= $this->extend('layout/wrapper'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1>Order Detail</h1>
                    <p class="card-text"> </p>
                    <p class="card-text"> Order Name : <?php echo $OrderData['OrderName']; ?></p>
                    <p class="card-text"> Order Date : <?php echo date("d-M-Y / H:i", strtotime($OrderData['_CreatedDate'])); ?></p>
                    <p class="card-text testInput" type="number"> Total : <?php echo $OrderData['Total']; ?></p>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                        <a href="/Order/edit/<?= $OrderData['Id']; ?>" class="btn btn-warning mb-2">Update</a>

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order Date</th>
                                <th>Menu Name</th>
                                <th>Quantity</th>
                                <th>@Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($OrderEntryData as $c) : ?>
                                <tr>
                                    <td><?php echo $i++ ?></th>

                                    <td><?php echo date("d-M-Y / H:i", strtotime($OrderData['_CreatedDate'])); ?></th>
                                    <td><?php echo (array_search($c['MenuId'], array_column($MenuData, 'Id')) !== false) ? $MenuData[array_search($c['MenuId'], array_column($MenuData, 'Id'))]['MenuName'] : ''; ?></th>
                                    <td><?php echo $c['Quantity']; ?></th>
                                    <td><?php echo $c['Price']; ?></th>
                                    <td><?php echo $c['Quantity'] * $c['Price']; ?></th>

                                </tr>
                            <?php
                            endforeach; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Order Date</th>
                                <th>Menu Name</th>
                                <th>Quantity</th>
                                <th>@Price</th>
                                <th>Total Price</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.col-md-6 -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>