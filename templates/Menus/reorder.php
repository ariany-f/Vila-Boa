<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Menu> $menus
 */
?>
<div class="card h-100 p-0 radius-12">
<div class="card-header">
                <div class="d-flex flex-wrap align-items-center justify-content-start gap-2">
                    <div class="side-nav d-flex">
                        <?= $this->Html->link(
                            '<iconify-icon icon="mingcute:arrow-left-line" class="icon fs-3 line-height-1"></iconify-icon> Voltar para Menus',
                            ['action' => 'index'],
                            ['class' => 'side-nav-item d-flex align-items-center', 'escape' => false]
                        ) ?>
                    </div>
                </div>
            </div>

    <div class="card-body p-24">
        <?= $this->Form->create(null, [
            'id' => 'reorderForm',
            'url' => ['action' => 'updateOrder'],
            'class' => 'd-flex flex-column h-100'
        ]) ?>
        
        <div class="table-responsive scroll-sm flex-grow-1">
            <ul id="sortable-menus" class="list-group">
                <?php foreach ($menus as $menu): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center" data-id="<?= $menu->id ?>">
                        <div class="d-flex align-items-center gap-3">
                            <iconify-icon icon="mdi:drag" class="handle text-secondary-light" style="cursor: move;"></iconify-icon>
                            <?php if($menu->icon) : ?>
                                <iconify-icon icon="mage:<?= h($menu->icon) ?>" class="menu-icon"></iconify-icon>
                            <?php endif; ?>
                            <span><?= h($menu->name) ?></span>
                        </div>
                        <span class="badge text-sm fw-semibold bg-primary-600 px-20 py-9 radius-4 text-white">Posição: <?= $menu->position ?></span>
                        <?= $this->Form->hidden('order[]', [
                            'value' => $menu->id,
                            'id' => false,
                            'class' => 'menu-order'
                        ]) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="d-flex align-items-center justify-content-end gap-3">
            <?= $this->Form->button('Salvar', [
                'type' => 'submit',
                'class' => 'btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8',
                'id' => 'saveOrderBtn',
                'escape' => false
            ]) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    $(function() {
        // Ativar ordenação por arrastar e soltar
        $("#sortable-menus").sortable({
            handle: ".handle",
            placeholder: "ui-state-highlight",
            tolerance: "pointer", // Melhora a precisão do arraste
            cursor: "move",
            opacity: 0.7, // Transparência durante o arraste
            revert: 150, // Suaviza o retorno se não for válido
            start: function(e, ui) {
                ui.placeholder.height(ui.item.height()); // Ajusta altura do placeholder
            },
            update: function(event, ui) {
                updateOrderFields();
            }
        }).disableSelection();

        // Função para atualizar os campos de ordem
        function updateOrderFields() {
            $("#sortable-menus li").each(function(index) {
                $(this).find(".badge").text("Posição: " + (index));
                $(this).find(".menu-order").val($(this).data('id'));
            });
        }

        // Inicializa os campos de ordem
        updateOrderFields();

        // Submissão do formulário
        $("#reorderForm").on('submit', function(e) {
            e.preventDefault();
            
            var $form = $(this);
            var $button = $("#saveOrderBtn");
            var formData = $form.serialize();
            
            $button.prop("disabled", true)
                .html('<iconify-icon icon="eos-icons:loading" class="icon text-xl line-height-1"></iconify-icon> Salvando...');

            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if(response && response.success) {
                        alert("Ordem salva com sucesso!");
                        updateOrderFields();
                    } else {
                        alert("Ocorreu um erro ao salvar a ordem: " + (response.error || ''));
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Erro na requisição:", status, error); // Para debug
                    alert("Erro na comunicação com o servidor: " + error);
                },
                complete: function() {
                    $button.prop("disabled", false)
                        .html('<iconify-icon icon="ic:baseline-save" class="icon text-xl line-height-1"></iconify-icon> Salvar Ordem');
                }
            });
        });
    });
</script>
<style>
    .ui-state-highlight {
        height: auto !important; /* Altura automática baseada no item */
        min-height: 50px; /* Altura mínima */
        background-color: #f8f9fa;
        border: 2px dashed #dee2e6;
        margin: 4px 0; /* Espaçamento reduzido */
    }
    .list-group-item {
        cursor: move;
        transition: all 0.2s ease;
        position: relative;
        padding: 12px 16px; /* Padding mais compacto */
        margin: 4px 0; /* Espaçamento reduzido entre itens */
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    .list-group-item.ui-sortable-helper {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sombra durante arraste */
        transform: scale(.9); /* Efeito de "levantar" o item */
        z-index: 1000; /* Garante que fique acima dos outros */
    }
    .menu-icon {
        font-size: 1.25rem;
    }
    .menu-order {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }
    .handle {
        margin-right: 8px;
        color: #6c757d;
        transition: transform 0.2s;
    }
    .handle:hover {
        transform: scale(.9);
        color: #0d6efd;
    }
</style>
<?php $this->end(); ?>