<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-end">
        <a href="<?= $this->Url->build(['controller' => 'Roles', 'action' => 'add']) ?>" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
            <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
            Adicionar Permissão
        </a>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="rolesTable">
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
                        <th scope="col">Nome</th>
                        <th scope="col">Criado</th>
                        <th scope="col">Modificado</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $role): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-10">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <?= h($role->id) ?>
                                </div>
                            </td>
                            <td><?= h($role->nome) ?></td>
                            <td><?= h($role->created) ?></td>
                            <td><?= h($role->modified) ?></td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <a href="<?= $this->Url->build(['action' => 'edit', $role->id]) ?>" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                        <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                    </a>
                                    <?= $this->Form->postLink(
                                        '<iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>',
                                        ['action' => 'delete', $role->id],
                                        [
                                            'class' => 'remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle',
                                            'escape' => false,
                                            'confirm' => 'Tem certeza?'
                                        ]
                                    )?>
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
        $('#rolesTable').DataTable({
            "paging": true,  // Habilita paginação
            "searching": true,  // Habilita busca
            "ordering": true,  // Habilita ordenação
            "info": true,  // Exibe informações da paginação
            "lengthMenu": [5, 10, 15, 20],  // Define opções de itens por página
            "pageLength": 10,  // Define o número padrão de itens por página
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nenhuma permissão encontrado",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ permissões",
                "infoEmpty": "Nenhuma permissão disponível",
                "infoFiltered": "(filtrado de _MAX_ permissões no total)",
                "search": "",
            }
        });

        $('.remove-item-btn').on('click', function () {
            $(this).closest('tr').addClass('d-none');
        });
    });
</script>
<?php $this->end(); ?>
