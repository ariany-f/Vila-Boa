<!-- Modal Start -->
<div class="modal fade" id="addCustomModal" tabindex="-1" aria-labelledby="addCustomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="addCustomModalLabel">Adicionar Tela Customizada</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <?= $this->Form->create($customizavel, [
                        'url' => ['controller' => 'Customizaveis', 'action' => 'add', 'customizavel' => $customizavel],
                        'id' => 'addCustomForm'
                    ]) ?>
                    <div class="row">
                        <div class="col-12 mb-20">
                            <input type="text" name="titulo" class="form-control radius-8" placeholder="Nome da Tela">
                        </div>
                        <div class="col-12 mb-20">
                            <textarea class="form-control" id="desc" name="descricao" rows="4" cols="50" placeholder="Descrição"></textarea>
                        </div>
                        <div class="col-12 mb-20">
                            <input type="text" name="link_iframe" class="form-control radius-8" placeholder="Link">
                        </div><div class="row row-cols-xxxl-6 row-cols-lg-5 row-cols-sm-4 row-cols-2 gy-4">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Criar menu para a tela <span class="text-danger-600">*</span></label>
                                <div class="d-flex flex-column align-items-start py-3 justify-content-start flex-wrap gap-3 menu-group col">
                                <div class="form-switch switch-primary d-flex align-items-center gap-3">
                                    <?= $this->Form->control("criar_menu", [
                                        'type' => 'checkbox',
                                        'class' => 'form-check-input',
                                        'checked' => false,
                                        'label' => 'Criar',
                                        'escape' => false
                                    ]) ?>
                                </div>
                                </div>
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