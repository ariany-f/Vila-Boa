<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $role
 * @var string[]|\Cake\Collection\CollectionInterface $menuEdit
 */

use Cake\Utility\Hash;

?>
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card position-relative border radius-16 overflow-hidden bg-base h-100">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="side-nav d-flex">
                        <?= $this->Html->link(
                            '<iconify-icon icon="mingcute:arrow-left-line" class="icon fs-3 line-height-1"></iconify-icon> Voltar para Permissões',
                            ['action' => 'index'],
                            ['class' => 'side-nav-item d-flex align-items-center', 'escape' => false]
                        ) ?>
                    </div>
                    <?= $this->Form->postLink(
                        __('Excluir'),
                        ['action' => 'delete', $role->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $role->id), 'class' => 'btn btn-sm btn-danger radius-8 d-inline-flex align-items-center gap-1']
                    ) ?>
                </div>
            </div>
            <div class="card-body py-40">
                <div class="row">
                    <?= $this->Form->create($role) ?>
                    <fieldset>
                        <?php
                            echo $this->Form->control('nome', ['class' => 'form-control radius-8']);

                            $groupedMenus = [];
                            foreach ($menus as $men) {
                                $parentId = $men->parent_id; // Acessando a propriedade diretamente
                                $groupedMenus[$parentId][] = ['id' => $men->id, 'name' => $men->name]; // Agrupar os filhos
                            }
                            echo '<div class="row row-cols-xxxl-6 row-cols-lg-5 row-cols-sm-4 row-cols-2 gy-4">';                                    
                            // Agora percorra os menus agrupados
                            foreach (current($groupedMenus) as $men) {

                                echo '<div class="d-flex flex-column align-items-start py-3 justify-content-start flex-wrap gap-3 menu-group col">';
                                echo '<b>' . $men['name'] . '</b>'; // Exibe o nome do menu pai
                            
                                // Filtra os menus com o id igual a $men['id']
                                $filteredMenu = array_filter($allMenus, function ($menu) use ($men) {
                                    return $menu['id'] == $men['id'];
                                });

                                $checked = in_array($men['id'], Hash::extract($role->menus, '{n}.id')) ? 'checked' : '';
                                echo '<div class="form-switch switch-primary d-flex align-items-center gap-3">';
                                echo $this->Form->control("menus._ids.{$men['id']}", [
                                    'type' => 'checkbox',
                                    'class' => 'form-check-input',
                                    'checked' => $checked,
                                    'label' => $men['name'],
                                    'escape' => false
                                ]);
                                echo '</div>';
                                
                                if(!empty(current($filteredMenu)->child_menus))
                                {
                                    foreach (current($filteredMenu)->child_menus as $child) {
                                        $checked = in_array($child['id'], Hash::extract($role->menus, '{n}.id')) ? 'checked' : '';
                                        echo '<div class="form-switch switch-primary d-flex align-items-center gap-3">';
                                        echo $this->Form->control("menus._ids.{$child['id']}", [
                                            'type' => 'checkbox',
                                            'class' => 'form-check-input',
                                            'checked' => $checked,
                                            'label' => $child['name'],
                                            'escape' => false
                                        ]);
                                        echo '</div>';
                                    }
                                }

                                echo '</div>';
                            }
                            echo '</div>';
                        ?>
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