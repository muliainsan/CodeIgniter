<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <form action="/Work/update/<?= $WorkData['Id']; ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $WorkData['Id']; ?>">
                <div class="row mb-3">
                    <label for="inputWorkname" class="col-sm-2 col-form-label">Work Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('inputWorkname')) ? 'is-invalid' : ''; ?>" id="inputWorkname" name="inputWorkname" value="<?= (old('inputWorkname')) ? old('inputWorkname') : $WorkData['WorkName']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputWorkname'); ?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>