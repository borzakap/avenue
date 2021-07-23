<?= $this->extend('site/layout') ?>

<?= $this->section('pagecss') ?>

<?= $this->endSection() ?>


<?= $this->section('main') ?>

<?= view('App\Views\site\_breadcrumb') ?>

<?= view('App\Views\site\sections\_floors') ?>

<?= $this->endSection() ?>

<?= $this->section('artermain') ?>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="empModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('pagejs') ?>
<script src="/site/js/section.min.js"></script>
<?= $this->endSection() ?>
