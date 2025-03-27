<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Relatorio> $relatorios
 */
?>
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-end">
        <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addRelatorioModal">
            <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
            Adicionar Relatório
        </button>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="relatoriosTable">
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
                        <th scope="col">Descrição</th>
                        <th scope="col">Link</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($relatorios as $relatorio): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-10">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <?= h($relatorio->id) ?>
                                </div>
                            </td>
                            <td><?= h($relatorio->titulo) ?></td>
                            <td>
                                <p class="max-w-500-px"><?= h($relatorio->descricao) ?></p>
                            </td>
                            <td>
                                <p class="max-w-500-px"><?= h($relatorio->link_iframe) ?></p>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-center">
                                    <a href="<?= $this->Url->build(['action' => 'view', $relatorio->id]) ?>" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                        <iconify-icon icon="lucide:eye" class="menu-icon"></iconify-icon>
                                    </a>
                                    <a href="<?= $this->Url->build(['action' => 'edit', $relatorio->id]) ?>" class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                        <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                                    </a>
                                    <?= $this->Form->postLink(
                                        '<iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>',
                                        ['action' => 'delete', $relatorio->id],
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
    <?= $this->element('Relatorios/add', ['relatorio' => $relatorio]) ?>
</div>


<?php $this->start('script'); ?>
<script>
    $(document).ready(function() {
        // $('#relatoriosTable').DataTable({
        //     paging: true,
        //     ordering: true,
        //     info: true
        // });

        $('.remove-item-btn').on('click', function () {
            $(this).closest('tr').addClass('d-none');
        });
    });
</script>
<?php $this->end(); ?>