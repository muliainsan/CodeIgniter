<?= $this->extend('layout/wrapper'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1>Users Data</h1>
                    <p class="card-text"> Create, Read, Update, Delete (CRUD) for User User datas</p>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <table id="example1" class="table table-bordered table-hover">
                        <a href="/User/create" class="btn btn-primary mb-2 ">Add User</a>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User Name</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($UserData as $c) : ?>
                                <tr>
                                    <td><?php echo $i++ ?></th>
                                    <td><?php echo $c['UserName']; ?></th>
                                    <td><?php echo $c['Name']; ?></th>
                                    <td><?php echo $c['Email']; ?></th>
                                    <td><?php if ($c['IdRole'] == 1) {
                                            echo "Admin";
                                        } else {
                                            echo "-";
                                        } ?></th>
                                    <td><?php echo $c['created_at']; ?></th>
                                    <td>
                                        <a href="/User/edit/<?= $c['Id']; ?>" class="btn btn-warning">Update</a>

                                        <form action="/User/delete" class="d-inline" method="DELETE">
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
                                <th>User Name</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
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