<?= $this->extend('layout/wrapper'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <form action="/User/update/<?= $UserData['Id']; ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $UserData['Id']; ?>">
                <div class="row mb-3">
                    <label for="inputUsername" class="col-sm-2 col-form-label">User Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('inputUsername')) ? 'is-invalid' : ''; ?>" id="inputUsername" name="inputUsername" value="<?= (old('inputUsername')) ? old('inputUsername') : $UserData['UserName']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputUsername'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('inputPassword')) ? 'is-invalid' : ''; ?>" id="inputPassword" name="inputPassword" value="<?= (old('inputPassword')) ? old('inputPassword') : $UserData['Password']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputPassword'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputContractorname" class="col-sm-2 col-form-label">Contractor Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('inputContractorname')) ? 'is-invalid' : ''; ?>" id="inputContractorname" name="inputContractorname" value="<?= (old('inputContractorname')) ? old('inputContractorname') : $UserData['ContractorName']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputContractorname'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('inputEmail')) ? 'is-invalid' : ''; ?>" id="inputEmail" name="inputEmail" value="<?= (old('inputEmail')) ? old('inputEmail') : $UserData['Email']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputEmail'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPosition" class="col-sm-2 col-form-label">Position</label>
                    <div class="col-sm-10">
                        <select class="form-control <?= ($validation->hasError('inputPosition')) ? 'is-invalid' : ''; ?>" id="inputPosition" name="inputPosition" value="<?= (old('inputPosition')) ? old('inputPosition') : $UserData['Position']; ?>" autofocus>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputPosition'); ?>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>