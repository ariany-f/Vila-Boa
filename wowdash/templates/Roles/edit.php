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
                            echo '<div class="row row-cols-xxxl-7 row-cols-lg-6 row-cols-sm-5 row-cols-4 gy-4">';                                    
                            // Agora percorra os menus agrupados
                            foreach (current($groupedMenus) as $men) {

                                echo '<div class="d-flex flex-column align-items-start py-3 justify-content-start flex-wrap menu-group col">';
                                echo '<b>' . $men['name'] . '</b>'; // Exibe o nome do menu pai
                            
                                // Filtra os menus com o id igual a $men['id']
                                $filteredMenu = array_filter($allMenus, function ($menu) use ($men) {
                                    return $menu['id'] == $men['id'];
                                });

                                $checked = in_array($men['id'], Hash::extract($role->menus, '{n}.id')) ? 'checked' : '';
                                echo '<div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">';
                                    echo '<label for="menus._ids.{'.$men['id'].'}" class="position-absolute w-100 h-100 start-0 top-0"></label>';
                                    echo '<div class="d-flex align-items-center gap-3 justify-content-between">';
                                        echo '<span class="form-check-label line-height-1 fw-medium text-secondary-light">'.$men['name'].'</span>';
                                        echo '<input name="menus._ids.{'.$men['id'].'}" '.$checked.' class="form-check-input menu-parent" type="checkbox" role="switch" id="menus._ids.{'.$men['id'].'}">';
                                echo '</div>';
                                echo '</div>';
                                // echo $this->Form->control("menus._ids.{$men['id']}", [
                                //     'type' => 'checkbox',
                                //     'class' => 'form-check-input menu-parent',
                                //     'checked' => $checked,
                                //     'label' => $men['name'],
                                //     'escape' => false
                                // ]);
                                // echo '</div>';
                                
                                if(!empty(current($filteredMenu)->child_menus))
                                {
                                    foreach (current($filteredMenu)->child_menus as $child) {
                                        $checked = in_array($child['id'], Hash::extract($role->menus, '{n}.id')) ? 'checked' : '';
                                        
                                        echo '<div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">';
                                            echo '<label for="menus._ids.{'.$child['id'].'}" class="position-absolute w-100 h-100 start-0 top-0"></label>';
                                            echo '<div class="d-flex align-items-center gap-3 justify-content-between">';
                                                echo '<span class="form-check-label line-height-1 fw-medium text-secondary-light">'.$child['name'].'</span>';
                                                echo '<input name="menus._ids.{'.$child['id'].'}" '.$checked.' class="form-check-input menu-child" type="checkbox" role="switch" id="menus._ids.{'.$child['id'].'}">';
                                        echo '</div>';
                                        echo '</div>';
                                        // echo '<div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">';
                                        // echo $this->Form->control("menus._ids.{$child['id']}", [
                                        //     'type' => 'checkbox',
                                        //     'class' => 'form-check-input menu-child',
                                        //     'checked' => $checked,
                                        //     'label' => $child['name'],
                                        //     'escape' => false
                                        // ]);
                                        // echo '</div>';
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuParents = document.querySelectorAll('.menu-parent');
        const menuChildren = document.querySelectorAll('.menu-child');

        // Quando um menu filho for marcado ou desmarcado
        menuChildren.forEach(child => {
            child.addEventListener('change', function () {
                const parentId = this.closest('.menu-group').querySelector('.menu-parent');
                
                if (this.checked) {
                    // Se o filho foi marcado, marca o pai
                    if (parentId) {
                        parentId.checked = true;
                    }
                }

                // Verifica se algum filho está marcado, se sim, o pai não pode ser desmarcado
                const anyChildChecked = Array.from(this.closest('.menu-group').querySelectorAll('.menu-child')).some(child => child.checked);
                if (!anyChildChecked && parentId && !this.checked) {
                    // Se nenhum filho estiver marcado, o pai pode ser desmarcado
                    parentId.checked = false;
                }
            });
        });

        // Quando o menu pai for marcado ou desmarcado
        menuParents.forEach(parent => {
            parent.addEventListener('change', function () {
                const menuGroup = this.closest('.menu-group');
                const children = menuGroup.querySelectorAll('.menu-child');
                
                // Se o pai for marcado, marca todos os filhos
                if (this.checked) {
                    children.forEach(child => {
                        child.checked = true;
                    });
                } else {
                    // Se o pai for desmarcado, desmarca todos os filhos
                    children.forEach(child => {
                        child.checked = false;
                    });
                }
            });
        });
    });
</script>