<!-- Modal Start -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="addUserModalLabel">Adicionar Usuário</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <?= $this->Form->create($user, [
                        'url' => ['controller' => 'Users', 'action' => 'add', 'user' => $user],
                        'id' => 'addUserForm'
                    ]) ?>
                    <div class="row">
                        <div class="col-12 mb-20">
                            <input type="text" name="nome" class="form-control radius-8" placeholder="Nome do Usuário" required>
                        </div>
                        <div class="col-12 mb-20">
                            <input type="email" name="email" class="form-control radius-8" placeholder="Email" required>
                        </div>
                        <div class="col-12 mb-20">
                            <input type="password" name="senha" class="form-control radius-8" placeholder="Senha" required>
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
