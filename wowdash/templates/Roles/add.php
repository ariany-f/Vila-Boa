<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $role
 * @var \Cake\Collection\CollectionInterface|string[] $menus
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
use Cake\Utility\Hash;
?>
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card position-relative border radius-16 overflow-hidden bg-base h-100">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center justify-content-start gap-2">
                    <div class="side-nav">
                        <?= $this->Html->link(__('Voltar para Permissões'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                    </div>
                </div>
            </div>
            <div class="card-body py-40">
                <div class="row">
                    <?= $this->Form->create($role) ?>
                    <fieldset class="input-group">
                        
                        <!-- Campo para o nome do papel -->
                        <?= $this->Form->control('nome', ['class' => 'form-control']) ?>

                        <?php
                            // Agrupar menus por parent_id
                            $groupedMenus = [];
                            foreach ($menus as $men) {
                                $parentId = $men->parent_id;
                                $groupedMenus[$parentId][] = ['id' => $men->id, 'name' => $men->name];
                            }
                            
                            echo '<div class="row row-cols-xxxl-6 row-cols-lg-5 row-cols-sm-4 row-cols-2 gy-4">'; 

                            // Exibir menus agrupados
                            foreach (current($groupedMenus) as $men) {
                                echo '<div class="d-flex flex-column align-items-start py-3 justify-content-start flex-wrap gap-3 menu-group col">';
                                echo '<b>' . $men['name'] . '</b>'; // Exibe o nome do menu pai

                                
                                $filteredMenu = array_filter($allMenus, function ($menu) use ($men) {
                                    return $menu['id'] == $men['id'];
                                });

                                // Checar se o menu está marcado no role atual (se aplicável)
                                $checked = (isset($role->menus) && in_array($men['id'], Hash::extract($role->menus, '{n}.id'))) ? 'checked' : '';
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
                                        $checked = (isset($role->menus) && in_array($child['id'], Hash::extract($role->menus, '{n}.id'))) ? 'checked' : '';
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
