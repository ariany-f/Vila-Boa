<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $role
 * @var \Cake\Collection\CollectionInterface|string[] $menus
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="roles form content">
            <?= $this->Form->create($role) ?>
            <fieldset class="input-group">
                <legend><?= __('Add Role') ?></legend>
                <?php
                    echo $this->Form->control('nome', ['class' => 'form-control']);
                    echo $this->Form->control('menus._ids', ['options' => $menusToRoles, 'class' => 'form-control']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
