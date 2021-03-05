<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <form action="/Work/save" method="POST">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="inputWorkname" class="col-sm-2 col-form-label">Work Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('inputWorkname')) ? 'is-invalid' : ''; ?>" id="inputWorkname" name="inputWorkname" value="<?= old('inputWorkname'); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputWorkname'); ?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Add</button>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>