<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <form action="/IncomingMaterial/update/<?= $MaterialData['Id']; ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $MaterialData['Id']; ?>">
                <div class="row mb-3">
                    <label for="inputMaterialname" class="col-sm-2 col-form-label">Material Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('inputMaterialname')) ? 'is-invalid' : ''; ?>" id="inputMaterialname" name="inputMaterialname" value="<?= (old('inputMaterialname')) ? old('inputMaterialname') : $MaterialData['MaterialName']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputMaterialname'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputWork" class="col-sm-2 col-form-label">Work</label>
                    <div class="col-sm-10">
                        <select class="form-control <?= ($validation->hasError('inputWork')) ? 'is-invalid' : ''; ?>" id="inputWork" name="inputWork" value="<?= (old('inputWork')) ? old('inputWork') : $MaterialData['WorkId']; ?>" autofocus>
                            <option>Choose Work Name</option>
                            <?php foreach ($WorkData as $Work) : ?>
                                <option value="<?= $Work['Id']; ?>" selected="<?php if ($MaterialData['WorkId'] == $Work['Id']) "selected" ?> "><?= $Work['WorkName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputPrice'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEvidence" class="col-sm-2 col-form-label">Evidence</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('inputEvidence')) ? 'is-invalid' : ''; ?>" id="inputEvidence" name="inputEvidence" value="<?= (old('inputEvidence')) ? old('inputEvidence') : $MaterialData['Evidence']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputEvidence'); ?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>