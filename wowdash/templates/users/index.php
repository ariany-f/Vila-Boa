<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
            <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
            </select>
            <form class="navbar-search">
                <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
            </form>
        </div>
        <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
            Adicionar Usuário
        </button>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="usersTable">
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-10">
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input radius-4 border input-form-dark" type="checkbox" name="checkbox" id="selectAll">
                                </div>
                                ID
                            </div>
                        </th>
                        <th scope="col">Email</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-10">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <?= h($user->id) ?>
                                </div>
                            </td>
                            <td><?= h($user->email) ?></td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <a href="<?= $this->Url->build(['action' => 'view', $user->id]) ?>" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                        <iconify-icon icon="lucide:eye" class="menu-icon"></iconify-icon>
                                    </a>
                                    <a href="<?= $this->Url->build(['action' => 'edit', $user->id]) ?>" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                        <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                    </a>
                                    <?= $this->Form->postLink(
                                        '<iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>',
                                        ['action' => 'delete', $user->id],
                                        [
                                            'class' => 'remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle',
                                            'escape' => false,
                                            'confirm' => 'Tem certeza?'
                                        ]
                                    ) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?= $this->Flash->render() ?>
    </div>
    <!-- Renderiza o conteúdo do add.php dentro do index.php -->
    <?php //echo $this->element('Users/add', ['user' => $user]) ?>
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
