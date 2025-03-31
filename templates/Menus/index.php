<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Menu> $menus
 */
?>
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-end">
        <a href="<?= $this->Url->build(['controller' => 'Menus', 'action' => 'reorder']) ?>" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
            <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
            Reordenar Menus
        </a>
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
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-start">
                                    <?php if($menu->icon) : ?>
                                    <iconify-icon icon="mage:<?= h($menu->icon) ?>" class="menu-icon"></iconify-icon>
                                    <?php else: ?>
                                        Sem ícone
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center gap-10 justify-content-center">
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
    <?php echo $this->element('Menus/add', ['menu' => $menu]) ?>
</div>

<?php $this->start('script'); ?>
<script>
        $(document).ready(function() {
            $('#menusTable').DataTable({
            "paging": true,            // Ativar paginação
            "lengthMenu": [10, 15, 20], // Opções de itens por página
            "pageLength": 10,           // Padrão: mostrar 5 por página
            "ordering": false,          // Ativar ordenação das colunas
            "searching": true,         // Ativar barra de pesquisa
            "info": true,              // Mostrar informações (Ex: "Mostrando 1-5 de 20")
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let iconSelect = document.getElementById("iconSelect");
        let iconPreview = document.getElementById("icon-preview");

        let iconSelectParent = document.getElementById("iconSelectParent");
        let iconPreviewParent = document.getElementById("icon-preview-parent");

        iconSelect.addEventListener("change", function () {
            iconPreview.setAttribute("icon", this.value);
        });

        iconSelectParent.addEventListener("change", function () {
            let selectedOption = this.options[this.selectedIndex]; // Obtém a opção selecionad
            let iconValue = selectedOption.getAttribute("data-icon"); // Pega o data-icon
            iconPreviewParent.setAttribute("icon", iconValue);
        });
        
        let parentMenuSelect = document.getElementById("iconSelectParent");
        let iconSelectContainer = document.getElementById("iconSelectContainer");

        function toggleIconSelectContainer() {
            if (parentMenuSelect.value === "null") {
                iconSelectContainer.style.display = "block"; // Mostra o seletor de ícones
            } else {
                iconSelectContainer.style.display = "none"; // Esconde o seletor de ícones
            }
        }

        // Executa ao carregar a página (para estado inicial correto)
        toggleIconSelectContainer();

        // Evento de mudança no select do menu pai
        parentMenuSelect.addEventListener("change", toggleIconSelectContainer);
    });
</script>
<?php $this->end(); ?>
