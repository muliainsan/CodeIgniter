<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <form action="/Menu/update/<?= $MenuData['Id']; ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $MenuData['Id']; ?>">
                <div class="row mb-3">
                    <label for="inputMenu" class="col-sm-2 col-form-label">Menu Name</label>
                    <div class="col-sm-10">

                        <input type="text" class="form-control <?= ($validation->hasError('inputMenu')) ? 'is-invalid' : ''; ?>" id="inputMenu" name="inputMenu" value="<?= (old('inputMenu')) ? old('inputMenu') : $MenuData['MenuName']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputMenu'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">

                        <input type="number" class="form-control <?= ($validation->hasError('inputPrice')) ? 'is-invalid' : ''; ?>" id="inputPrice" name="inputPrice" value="<?= (old('inputMenu')) ? old('inputMenu') : $MenuData['Price']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputPrice'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputMenu" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-control <?= ($validation->hasError('inputCategory')) ? 'is-invalid' : ''; ?>" id="inputCategory" name="inputCategory" value="<?= old('inputCategory'); ?>" autofocus>
                            <option>No Category</option>
                            <?php foreach ($CategoryData as $category) : ?>
                                <option <?= $category['Id'] == $MenuData['CategoryId'] ? 'Selected' : '';  ?> value="<?= $category['Id']; ?>"><?= $category['CategoryName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputPrice'); ?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>