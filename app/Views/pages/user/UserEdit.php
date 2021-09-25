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
                        <input type="password" class="form-control <?= ($validation->hasError('inputPassword')) ? 'is-invalid' : ''; ?>" id="inputPassword" name="inputPassword" value="<?= (old('inputPassword')) ? old('inputPassword') : $UserData['Password']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputPassword'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('inputName')) ? 'is-invalid' : ''; ?>" id="inputName" name="inputName" value="<?= (old('inputName')) ? old('inputName') : $UserData['Name']; ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('inputName'); ?>
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
                    <label for="inputMenu" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control <?= ($validation->hasError('inputRole')) ? 'is-invalid' : ''; ?>" id="inputRole" name="inputRole" value="<?= old('inputRole'); ?>" autofocus>
                            <option>No Role</option>
                            <?php foreach ($RoleData as $Role) : ?>
                                <option <?= $Role['Id'] == $UserData['IdRole'] ? 'Selected' : '';  ?> value="<?= $Role['Id']; ?>"><?= $Role['Role']; ?></option>
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