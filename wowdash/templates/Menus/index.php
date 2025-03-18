<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Menu> $menus
 */
?>
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
            <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                <option>5</option>
                <option>10</option>
                <option>15</option>
                <option>20</option>
            </select>
            <form class="navbar-search">
                <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
            </form>
        </div>
        <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addMenuModal">
            <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
            Adicionar Menu
        </button>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="menusTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">URL</th>
                        <th scope="col">Ícone</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menusView as $menu): ?>
                        <tr>
                            <td><?= h($menu->id) ?></td>
                            <td><?= h($menu->name) ?></td>
                            <td><?= h($menu->url) ?></td>
                            <td><iconify-icon icon="<?= h($menu->icon) ?>" class="menu-icon"></iconify-icon></td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <a href="<?= $this->Url->build(['action' => 'view', $menu->id]) ?>" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                        <iconify-icon icon="lucide:eye" class="menu-icon"></iconify-icon>
                                    </a>
                                    <?php if($menu->allow_delete): ?>
                                        <a href="<?= $this->Url->build(['action' => 'edit', $menu->id]) ?>" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                        </a>
                                        <?= $this->Form->postLink(
                                            '<iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>',
                                            ['action' => 'delete', $menu->id],
                                            [
                                                'class' => 'remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle',
                                                'escape' => false,
                                                'confirm' => 'Tem certeza?'
                                            ]
                                        )?>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?= $this->Flash->render() ?>
    </div>
    <?php //echo $this->element('Menus/add', ['menu' => $menu]) ?>
</div>

<?php $this->start('script'); ?>
<script>
    $(document).ready(function() {
        $('.remove-item-btn').on('click', function () {
            $(this).closest('tr').addClass('d-none');
        });
    });
</script>
<?php $this->end(); ?>
