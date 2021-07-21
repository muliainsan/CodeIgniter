<?= $this->extend('layout/wrapper'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1>Order Data</h1>
                    <p class="card-text"> Create, Read, Update, Delete (CRUD) for Order datas</p>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                        <a href="/Order/create" class="btn btn-primary mb-2 ">Add Order</a>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Order Date</th>
                                <th>Order Name</th>
                                <th>Total Menu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($OrderData as $c) : ?>
                                <tr>
                                    <td><?php echo $i++ ?></th>
                                    <td><?php echo $c['OrderName']; ?></th>
                                    <td><?php echo date("d-M-Y / H:i", strtotime($c['_CreatedDate'])); ?></th>
                                    <td><?php echo $c['Total']; ?></th>
                                    <td>
                                        <a href="/Order/detail/<?= $c['Id']; ?>" class="btn btn-success">Detail</a>
                                        <a href="/Order/edit/<?= $c['Id']; ?>" class="btn btn-warning">Update</a>

                                        <form action="/Order/delete" class="d-inline" method="DELETE">
                                            <?= csrf_field(); ?>

                                            <input type="hidden" name="Id" value="<?= $c['Id']; ?>">
                                            <button type="submit" href="" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Order Date</th>
                                <th>Order Name</th>
                                <th>Total Menu</th>
                                <th>Action</th>
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