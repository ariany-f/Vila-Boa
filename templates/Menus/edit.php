<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 * @var \App\Model\Entity\Menu[] $parentMenus
 */
?>
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card position-relative border radius-16 overflow-hidden bg-base h-100">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="side-nav d-flex">
                        <?= $this->Html->link(
                            '<iconify-icon icon="mingcute:arrow-left-line" class="icon fs-3 line-height-1"></iconify-icon> Voltar para Menus',
                            ['action' => 'index'],
                            ['class' => 'side-nav-item d-flex align-items-center', 'escape' => false]
                        ) ?>
                    </div>
                    <?= $this->Form->postLink(
                        __('Excluir'),
                        ['action' => 'delete', $menu->id],
                        ['confirm' => __('Tem certeza que deseja excluir o menu # {0}?', $menu->id), 'class' => 'btn btn-sm btn-danger radius-8 d-inline-flex align-items-center gap-1']
                    ) ?>
                </div>
            </div>
            <div class="card-body py-40">
                <div class="row">
                    <?= $this->Form->create($menu) ?>
                    <fieldset>
                        <?php
                            echo $this->Form->control('name', ['class' => 'form-control radius-8', 'label' => 'Título']);
                            echo $this->Form->control('url', ['class' => 'form-control radius-8', 'label' => 'URL']);
                        ?>
                        
                        <!-- Selecionar Menu Pai -->
                        <div class="col-12 mb-20">
                            <label for="iconSelectParent">Menu Pai (Opcional)</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <iconify-icon id="icon-preview-parent" icon="mage:multiply-circle" class="menu-icon"></iconify-icon> 
                                </span>
                                <select id="iconSelectParent" name="parent_id" class="form-control radius-8">
                                    <option value="" <?= empty($menu->parent_id) ? 'selected' : '' ?>>Nenhum (Menu Principal)</option>
                                    <?php foreach ($parentMenus as $parentMenu) : ?>
                                        <option data-icon="mage:<?= h($parentMenu->icon) ?>" value="<?= h($parentMenu->id) ?>"
                                            <?= ($menu->parent_id == $parentMenu->id) ? 'selected' : '' ?>>
                                            <?= h($parentMenu->name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Selecionar Ícone -->
                        <div class="col-12 mb-20">
                            <label for="iconSelect">Ícone</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <iconify-icon id="icon-preview" icon="<?= h($menu->icon) ?: 'mage:settings' ?>" class="menu-icon"></iconify-icon> 
                                </span>
                                <select id="iconSelect" name="icon" class="form-control radius-8">
                                    <?php
                                        $icons = [
                                            'mage:settings' => 'settings',
                                            'mage:home' => 'home',
                                            'mage:user' => 'user',
                                            'mage:chart' => 'chart',
                                            'mage:flag' => 'flag',
                                            'mage:calendar-2' => 'calendar',
                                            'mage:trash' => 'trash',
                                            'mage:globe' => 'globe',
                                            'mage:message-question-mark-round' => 'message-question-mark',
                                            'mage:chart-15' => 'pizza chart',
                                            'mage:check' => 'check',
                                            'mage:direction-right' => 'direction',
                                            'mage:camera' => 'camera',
                                            'mage:notification-bell' => 'bell',
                                            'mage:dots-menu' => 'menu'
                                        ];

                                        foreach ($icons as $value => $label) {
                                            $selected = ($menu->icon == $value) ? 'selected' : '';
                                            echo "<option value='{$value}' {$selected}>{$label}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
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
