<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <form action="/IncomingMaterial/save" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="inputMaterialname" class="col-sm-2 col-form-label">Material Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('inputMaterialname')) ? 'is-invalid' : ''; ?>" id="inputMaterialname" name="inputMaterialname" value="<?= old('inputMaterialname'); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputMaterialname'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputWork" class="col-sm-2 col-form-label">Work</label>
                    <div class="col-sm-10">
                        <select class="form-control <?= ($validation->hasError('inputWork')) ? 'is-invalid' : ''; ?>" id="inputWork" name="inputWork" value="<?= old('inputWork'); ?>" autofocus>
                            <option hidden disabled selected value> -- select an option -- </option>
                            <?php foreach ($WorkData as $Work) : ?>
                                <option value="<?= $Work['Id']; ?>" <?= (old('inputWork') == $Work['Id']) ? "selected" : ""; ?>><?= $Work['WorkName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputWork'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEvidence" class="col-sm-2 col-form-label">Evidence</label>
                    <div class="col-sm-2">
                        <img src="\img\<?= old('inputEvidence'); ?>" class="img-thumbnail img-preview">
                    </div>


                    <div class="col-sm-8">

                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('inputEvidence')) ? 'is-invalid' : ''; ?>" id="inputEvidence" name="inputEvidence" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('inputEvidence'); ?>
                            </div>
                            <label class="custom-file-label" for="inputEvidence">Choose file</label>
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>