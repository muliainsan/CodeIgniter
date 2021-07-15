<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <form action="/Order/save" method="POST">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="inputOrder" class="col-sm-2 col-form-label">Order Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('inputOrder')) ? 'is-invalid' : ''; ?>" id="inputOrder" name="inputOrder" value="<?= old('inputOrder'); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputOrder'); ?>
                        </div>
                    </div>
                </div>

                <table id="example1" class="table table-bordered table-hover">
                    <a href="/Order/create" class="btn btn-primary mb-2 ">Add Order</a>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order Name</th>
                            <th>Total Menu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($MenuData as $c) : ?>
                            <tr>
                                <td><?php echo $i++ ?></th>
                                <td><?php echo $c['OrderName']; ?></th>
                                <td><?php echo $c['OrderName']; ?></th>
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
                            <th>Order Name</th>
                            <th>Total Menu</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>

                <button type="submit" class="btn btn-primary">Add</button>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>