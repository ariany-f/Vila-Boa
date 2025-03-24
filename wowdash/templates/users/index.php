<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-end">
        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'add']) ?>" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
            <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
            Adicionar Usuário
        </a>
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

                                    <?php if ($user->id !== $loggedUserId): ?>
                                        <a href="<?= $this->Url->build(['action' => 'edit', $user->id]) ?>" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?= $this->Url->build(['action' => 'viewProfile']) ?>" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                            <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                        </a>
                                    <?php endif; ?>
                                    <!-- Verifica se o usuário logado é o mesmo que o usuário da linha e oculta o botão de excluir -->
                                    <?php if ($user->id !== $loggedUserId): ?>
                                        <?= $this->Form->postLink(
                                            '<iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>',
                                            ['action' => 'delete', $user->id],
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
</div>

<?php $this->start('script'); ?>
<script>
    $(document).ready(function() {
        // Inicializa o DataTable com paginação, busca e ordenação
        $('#usersTable').DataTable({
            "paging": true,  // Habilita paginação
            "searching": true,  // Habilita busca
            "ordering": true,  // Habilita ordenação
            "info": true,  // Exibe informações da paginação
            "lengthMenu": [5, 10, 15, 20],  // Define opções de itens por página
            "pageLength": 10,  // Define o número padrão de itens por página
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nenhum menu encontrado",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ menus",
                "infoEmpty": "Nenhum menu disponível",
                "infoFiltered": "(filtrado de _MAX_ menus no total)",
                "search": "",
            }
        });

        $('.remove-item-btn').on('click', function () {
            $(this).closest('tr').addClass('d-none');
        });
    });
</script>
<?php $this->end(); ?>
