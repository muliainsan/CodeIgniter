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
                    <?php elseif (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error'); ?>
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
                                    <td><?php echo date("d-M-Y / H:i", strtotime($c['created_at'])); ?></th>
                                    <td><?php echo $c['Total']; ?></th>
                                    <td>
                                        <a href="/Order/detail/<?= $c['Id']; ?>" class="btn btn-success">Detail</a>
                                        <a href="/Order/edit/<?= $c['Id']; ?>" class="btn btn-warning">Update</a>
                                        <button type="button" class="btn btn-danger open-modaldelete" data-toggle="modal" data-target="#modal-delete" data-id='<?= $c['Id']; ?>' data-name='<?= $c['OrderName']; ?>'>
                                            Delete
                                        </button>
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
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Order</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a>Are you sure want to delete "</a> <b id="Name"></b> <a>" Order?</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <form action="/Order/delete" class="d-inline" method="DELETE">
                    <?= csrf_field(); ?>

                    <input type="hidden" id="Id" name="Id" value="">

                    <button type="submit" href="" class="btn btn-danger">Delete</button>
                </form>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?= $this->endSection(); ?>