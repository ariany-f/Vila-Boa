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
                    <div class="side-nav d-flex">
                        <?= $this->Html->link(
                            '<iconify-icon icon="mingcute:arrow-left-line" class="icon fs-3 line-height-1"></iconify-icon> Voltar para Permissões',
                            ['action' => 'index'],
                            ['class' => 'side-nav-item d-flex align-items-center', 'escape' => false]
                        ) ?>
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
                            foreach ($allMenus as $men) {
                                $parentId = $men->parent_id; 
                                if(!empty($men->parent_id)) {
                                    $groupedMenus[$parentId][] = ['id' => $men->id, 'name' => $men->name];
                                } else {
                                    // Se não tiver parent_id, cria um grupo próprio
                                    if (!isset($groupedMenus[$men->id])) {
                                        $groupedMenus[$men->id] = [];
                                    }
                                    $groupedMenus[$men->id][] = ['id' => $men->id, 'name' => $men->name];
                                }
                            }
                            
                            echo '<div class="row row-cols-xxxl-7 row-cols-lg-6 row-cols-sm-5 row-cols-4 gy-4">'; 

                            // Exibir menus agrupados
                            foreach ($groupedMenus as $k => $men) {
                                
                                $filteredMenu = array_filter($allMenus, function ($menu) use ($k) {
                                    return $menu['id'] == $k;
                                });

                                echo '<div class="d-flex flex-column align-items-start py-3 justify-content-start flex-wrap menu-group col">';
                                echo '<b>' . current($filteredMenu)->name . '</b>'; // Exibe o nome do menu pai


                                // Checar se o menu está marcado no role atual (se aplicável)
                                $checked = (isset($role->menus) && in_array($k, Hash::extract($role->menus, '{n}.id'))) ? 'checked' : '';
                                echo '<div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">';
                                    echo '<label for="menus-ids-'.$k.'" class="position-absolute w-100 h-100 start-0 top-0"></label>';
                                    echo '<div class="d-flex align-items-center gap-3 justify-content-between">';
                                        echo '<span class="form-check-label line-height-1 fw-medium text-secondary-light">'.current($filteredMenu)->name.'</span>';
                                        echo '<input name="menus[_ids]['.$k.']" '.$checked.' class="form-check-input menu-parent" type="checkbox" role="switch" id="menus-ids-'.$k.'">';
                                    echo '</div>';
                                echo '</div>';

                                if(!empty(current($filteredMenu)->child_menus))
                                {
                                    foreach (current($filteredMenu)->child_menus as $child) {
                                        $checked = (isset($role->menus) && in_array($child['id'], Hash::extract($role->menus, '{n}.id'))) ? 'checked' : '';
                                        echo '<div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">';
                                            echo '<label for="menus-ids-'.$child['id'].'" class="position-absolute w-100 h-100 start-0 top-0"></label>';
                                            echo '<div class="d-flex align-items-center gap-3 justify-content-between">';
                                                echo '<span class="form-check-label line-height-1 fw-medium text-secondary-light">'.$child['name'].'</span>';
                                                echo '<input name="menus[_ids]['.$child['id'].']" '.$checked.' class="form-check-input menu-child" type="checkbox" role="switch" id="menus-ids-'.$child['id'].'">';
                                        echo '</div>';
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
                <?= $this->Flash->render() ?>
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