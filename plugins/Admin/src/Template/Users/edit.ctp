<h1 class="page-header">
    <?= __('users.edit') ?>
    <div class="pull-right">
        <?= $this->CkTools->viewButton($user) ?>
        <?= $this->ListFilter->backToListButton() ?>
    </div>
</h1>

<?= $this->element('../Users/form') ?>
