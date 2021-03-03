<?= $this->extend('layout/wrapper'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1>Menu Data</h1>
                    <p class="card-text"> Create, Read, Update, Delete (CRUD) for Menu menu datas</p>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <table id="example1" class="table table-bordered table-striped">
                        <a href="/Menu/create" class="btn btn-primary mb-2 ">Add Menu</a>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($MenuData as $menu) : ?>
                                <tr>
                                    <td><?php echo $i++ ?></th>
                                    <td><?php echo $menu['MenuName']; ?></th>
                                    <td><?php echo $menu['Price']; ?></th>
                                        <?php
                                        if (is_null($menu['CategoryId'])) {
                                        ?>
                                    <td><?php echo "-"; ?></th>
                                    <?php } else { ?>
                                    <td><?php echo $CategoryModel->getCategory((int)$menu['CategoryId'])["CategoryName"]; ?></th>
                                    <?php } ?>

                                    <td>
                                        <a href="/Menu/detail/<?= $menu['Id']; ?>" class="btn btn-success">Detail</a>
                                        <a href="/Menu/edit/<?= $menu['Id']; ?>" class="btn btn-warning">Update</a>

                                        <form action="/Menu/delete" class="d-inline" method="DELETE">
                                            <?= csrf_field(); ?>

                                            <input type="hidden" name="Id" value="<?= $menu['Id']; ?>">
                                            <button type="submit" href="" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Menu Name</th>
                                <th>Price</th>
                                <th>Category</th>
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