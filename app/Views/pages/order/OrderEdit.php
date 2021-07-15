<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <form action="/Order/update/<?= $OrderData['Id']; ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $OrderData['Id']; ?>">
                <div class="row mb-3">
                    <label for="inputOrder" class="col-sm-2 col-form-label">Order Name</label>
                    <div class="col-sm-10">

                        <input type="text" class="form-control <?= ($validation->hasError('inputOrder')) ? 'is-invalid' : ''; ?>" id="inputOrder" name="inputOrder" value="<?= (old('inputOrder')) ? old('inputOrder') : $OrderData['OrderName']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputOrder'); ?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>