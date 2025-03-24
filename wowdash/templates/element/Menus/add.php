<!-- Modal Start -->
<div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="addModalLabel">Adicionar Menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <?= $this->Form->create($menu, [
                    'url' => ['controller' => 'Menus', 'action' => 'add'],
                    'id' => 'addMenusForm'
                ]) ?>
                <div class="row">
                    <div class="col-12 mb-20">
                        <input type="text" name="name" class="form-control radius-8" placeholder="Título" required>
                    </div>
                    <div class="col-12 mb-20">
                        <input class="form-control radius-8" name="url" placeholder="URL" required>
                    </div>
                    <!-- Selecionar Menu Pai -->
                    <div class="col-12 mb-20">
                        <label for="iconSelectParent">Menu Pai(Opcional)</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <iconify-icon id="icon-preview-parent" icon="mage:multiply-circle" class="menu-icon"></iconify-icon> 
                            </span>
                            <select id="iconSelectParent" name="parent_id" class="form-control radius-8">
                                <option icon="mage:multiply-circle" value=null>Nenhum (Menu Principal)</option>
                                <?php foreach ($parentMenus as $menu) : ?>
                                    <option data-icon="mage:<?= h($menu->icon) ?>" value="<?= h($menu->id)?>"><?= h($menu->name)?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mb-20" id="iconSelectContainer">
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
                                <option value="mage:flag">flag</option>
                                <option value="mage:calendar-2">calendar</option>
                                <option value="mage:trash">trash</option>
                                <option value="mage:globe">globe</option>
                                <option value="mage:message-question-mark-round">message-question-mark</option>
                                <option value="mage:chart-15">pizza chart</option>
                                <option value="mage:check">check</option>
                                <option value="mage:direction-right">direction</option>
                                <option value="mage:camera">camera</option>
                                <option value="mage:notification-bell">bell</option>
                                <option value="mage:dots-menu">menu</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mt-24 justify-content-end">
                        <button type="submit" class="btn btn-primary border border-primary-600 text-md px-48 py-12 radius-8">
                            Salvar
                        </button>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->