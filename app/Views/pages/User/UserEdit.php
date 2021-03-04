<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <form action="/Category/update/<?= $categoryData['Id']; ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $categoryData['Id']; ?>">
                <div class="row mb-3">
                    <label for="inputCategory" class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">

                        <input type="text" class="form-control <?= ($validation->hasError('inputCategory')) ? 'is-invalid' : ''; ?>" id="inputCategory" name="inputCategory" value="<?= (old('inputCategory')) ? old('inputCategory') : $categoryData['CategoryName']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputCategory'); ?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>