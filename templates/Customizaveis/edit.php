<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Relatorio $customizavel
 */
?>
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card position-relative border radius-16 overflow-hidden bg-base h-100">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="side-nav d-flex">
                    <?= $this->Html->link(
                        '<iconify-icon icon="mingcute:arrow-left-line" class="icon fs-3 line-height-1"></iconify-icon> Voltar para Telas Customizadas',
                        ['action' => 'index'],
                        ['class' => 'side-nav-item d-flex align-items-center', 'escape' => false]
                    ) ?>
                    </div>
                    <?= $this->Form->postLink(
                        __('Excluir'),
                        ['action' => 'delete', $customizavel->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $customizavel->id), 'class' => 'btn btn-sm btn-danger radius-8 d-inline-flex align-items-center gap-1']
                    ) ?>
                </div>
            </div>
            <div class="card-body py-40">
                <div class="row">
                    <?= $this->Form->create($customizavel) ?>
                    <fieldset>
                        <?php
                            echo $this->Form->control('titulo', ['class' => 'form-control radius-8']);
                            echo $this->Form->control('descricao', ['class' => 'form-control radius-8']);
                            echo $this->Form->control('link_iframe', ['class' => 'form-control radius-8']);
                        ?>
                    </fieldset>
                    <div class="col-12 mb-20">
                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">Criar menu para a tela</label>
                        <div class="form-switch switch-primary d-flex align-items-center gap-3">
                            <?= $this->Form->checkbox('criar_menu', ['id' => 'criarMenu', 'class' => 'form-check-input', 'checked' => !empty($menu)]) ?>
                            <label for="criarMenu">Criar</label>
                        </div>
                    </div>
                    <?php if (!empty($menu)): ?>
                        <div class="col-12 mb-20">
                            <label for="menuLink">Menu Vinculado</label>
                            <input type="text" class="form-control radius-8" value="<?= h($menu->name) ?>" disabled>
                        </div>
                    <?php endif; ?>
                    <div class="col-12 mb-20" id="iconSelectContainer" style="display: <?= empty($menu) ? 'block' : 'none' ?>;">
                        <label for="iconSelect">Ícone</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <iconify-icon id="icon-preview" icon="mage:settings" class="menu-icon"></iconify-icon>
                            </span>
                            <select id="iconSelect" name="icon" class="form-control radius-8">
                                <option value="mage:settings" selected>settings</option>
                                <option value="mage:home">home</option>
                                <option value="mage:user">user</option>
                                <option value="mage:chart">chart</option>
                            </select>
                        </div>
                    </div>
                     <!-- Menu Pai (visível apenas se não houver ícone) -->
                     <div class="col-12 mb-20" id="menuPaiContainer" style="display: none;">
                        <label for="menuPai">Menu Pai</label>
                        <select id="menuPai" name="parent_id" class="form-control radius-8">
                            <option value="">Nenhum (Menu Principal)</option>
                            <?php foreach ($parentMenus as $menu) : ?>
                                <option value="<?= h($menu->id) ?>"><?= h($menu->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row row-cols-xxxl-6 row-cols-lg-5 row-cols-sm-4 row-cols-2 gy-4">
                        <label class="form-label fw-semibold text-primary-light text-sm mb-8">Permissão <span class="text-danger-600">*</span></label>
                        <?php foreach ($roles as $role): ?>
                            <div class="d-flex flex-column align-items-start py-3 justify-content-start flex-wrap gap-3 menu-group col">
                                <div class="form-switch switch-primary d-flex align-items-center gap-3">
                                    <?= $this->Form->control("roles._ids.{$role->id}", [
                                        'type' => 'checkbox',
                                        'class' => 'form-check-input',
                                        'checked' => isset($customizavel->roles) && in_array($role->id, \Cake\Utility\Hash::extract($customizavel->roles, '{n}.id')),
                                        'label' => $role->nome,
                                        'escape' => false
                                    ]) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-sm-12">
                        <div class="mt-24 d-flex justify-content-end">
                            <?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-primary btn-sm']) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const criarMenuCheckbox = document.getElementById("criarMenu");
        const iconSelectContainer = document.getElementById("iconSelectContainer");
        const menuPaiContainer = document.getElementById("menuPaiContainer");
        const menuPai = document.getElementById("menuPai");

        criarMenuCheckbox.addEventListener("change", function () {
            if (this.checked) {
                iconSelectContainer.style.display = "block";
                menuPaiContainer.style.display = "block";
            } else {
                iconSelectContainer.style.display = "none";
                menuPaiContainer.style.display = "none";
            }
        });

        menuPai.addEventListener("change", function () {
            if (this.value) {
                iconSelectContainer.style.display = "none";
            } else {
                iconSelectContainer.style.display = "block";
            }
        });
    });
</script>