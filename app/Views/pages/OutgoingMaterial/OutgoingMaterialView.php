<?= $this->extend('layout/wrapper'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1><?= $title; ?></h1>
                    <p class="card-text"> Create, Read, Update, Delete (CRUD) for OutgoingMaterial menu datas</p>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <table id="example1" class="table table-bordered table-hover">
                        <a href="/OutgoingMaterial/create" class="btn btn-primary mb-2 ">Add OutgoingMaterial</a>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Material Name</th>
                                <th>Work</th>
                                <th>Reason</th>
                                <th>Evidence</th>
                                <th>Created By</th>
                                <th>Created Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($OutgoingMaterialData as $c) : ?>
                                <tr>
                                    <td><?php echo $i++ ?></th>
                                    <td><?php echo $c['MaterialName']; ?></th>
                                    <td><?php echo $WorkModel->getWork((int)$c['WorkId'])["WorkName"]; ?></th>
                                    <td><?php echo $c['Reason']; ?></th>
                                    <td><?php echo $c['Evidence']; ?></th>
                                    <td><?php echo $c['_CreatedBy']; ?></th>
                                    <td><?php echo date_format(date_create($c['_CreatedDate']), 'd-M-Y \a\t H:i'); ?></th>
                                    <td><?php if ($c['Status'] == "0") { ?>
                                            <a style="color:#ffc107">Pending Verification</a>
                                        <?php } elseif ($c['Status'] == "1") { ?>
                                            <a style="color:green">Verified</a>
                                        <?php } elseif ($c['Status'] == "2") { ?>
                                            <a style="color:red">Rejected</a>
                                        <?php } ?>
                                    </td>

                                    <td>

                                        <a href="/OutgoingMaterial/edit/<?= $c['Id']; ?>" class="btn btn-warning">Update</a>

                                        <form action="/OutgoingMaterial/delete" class="d-inline" method="DELETE">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="Id" value="<?= $c['Id']; ?>">
                                            <button type="submit" href="" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>


                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                <?php if ($c['Status'] == "0") { ?>
                                                    <form action="/OutgoingMaterial/updateStatus" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="Id" value="<?= $c['Id']; ?>">
                                                        <input type="hidden" name="Status" value=1>
                                                        <button type="submit" class="dropdown-item" href="">Verify</button>
                                                    </form>
                                                    <form action="/OutgoingMaterial/updateStatus" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="Id" value="<?= $c['Id']; ?>">
                                                        <input type="hidden" name="Status" value=2>
                                                        <button type="submit" class="dropdown-item" href="">Reject</button>
                                                    </form>

                                                <?php } elseif ($c['Status'] == "1") { ?>
                                                    <form action="/OutgoingMaterial/updateStatus" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="Id" value="<?= $c['Id']; ?>">
                                                        <input type="hidden" name="Status" value=2>
                                                        <button type="submit" class="dropdown-item" href="">Reject</button>
                                                    </form>
                                                <?php } elseif ($c['Status'] == "2") { ?>
                                                    <form action="/OutgoingMaterial/updateStatus" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="Id" value="<?= $c['Id']; ?>">
                                                        <input type="hidden" name="Status" value=0>
                                                        <button type="submit" class="dropdown-item" href="">Pending Verification</button>
                                                    </form>
                                                <?php } ?>



                                            </div>
                                        </div>




                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Material Name</th>
                                <th>Work</th>
                                <th>Reason</th>
                                <th>Evidence</th>
                                <th>Created By</th>
                                <th>Created Date</th>
                                <th>Status</th>
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