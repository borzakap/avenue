<?= $this->extend('admin/layout') ?>
<?= $this->section('main') ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= lang('FacebookExport.PageTitle') ?></h1>
    <!-- Topbar Search -->
    <a href="<?= route_to('managers/create') ?>" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-flag"></i>
        </span>
        <span class="text"><?= lang('Managers.TableButtonCreate') ?></span>
    </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th><?= lang('Residentials.List.Headers.Title') ?></th>
                        <th><?= lang('Residentials.List.Headers.Address') ?></th>
                        <th><?= lang('Residentials.List.Headers.BuildStart') ?></th>
                        <th><?= lang('Residentials.List.Headers.BuildEnd') ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><?= lang('Residentials.List.Headers.Title') ?></th>
                        <th><?= lang('Residentials.List.Headers.Address') ?></th>
                        <th><?= lang('Residentials.List.Headers.BuildStart') ?></th>
                        <th><?= lang('Residentials.List.Headers.BuildEnd') ?></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $item->name ?></td>
                            <td><?= $item->phone ?></td>
                            <td><?= $item->email ?></td>
                            <td><?= $item->form ?></td>
                            <td><?= $item->created_at ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Content Row -->

<?= $this->endSection() ?>

<?= $this->section('pagescript') ?>

<!-- Page level plugins -->
<script src="/assets/modules/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/modules/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->

<script type="text/javascript">
// Call the dataTables jQuery plugin
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?= route_to('facebook/tableajax') ?>",
            "deferLoading": <?= $counts ?>
        });
    });
</script>

<?= $this->endSection() ?>

<?= $this->section('pagecss') ?>
<!-- Custom styles for this page -->
<link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<?= $this->endSection() ?>
