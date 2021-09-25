<?= $this->extend('layout/wrapper'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1>Dashboard</h1>
                    <p class="card-text">monthly summary</p>
                </div>
                <h3 style="text-align: center;font-style: italic;">Coming soon</h3>
            </div>
            <!-- /.card -->
            <!-- /.col-md-6 -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a>Are you sure want to delete "</a> <b id="Name"></b> <a>" Category?</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <form action="/Category/delete" class="d-inline" method="DELETE">
                    <?= csrf_field(); ?>

                    <input type="hidden" id="Id" name="Id" value="">

                    <button type="submit" href="" class="btn btn-danger">Delete</button>
                </form>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection(); ?>