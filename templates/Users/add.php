
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card position-relative border radius-16 overflow-hidden bg-base h-100">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center justify-content-start gap-2">
                    <div class="side-nav d-flex">
                        <?= $this->Html->link(
                            '<iconify-icon icon="mingcute:arrow-left-line" class="icon fs-3 line-height-1"></iconify-icon> Voltar para Usuários',
                            ['action' => 'index'],
                            ['class' => 'side-nav-item d-flex align-items-center', 'escape' => false]
                        ) ?>
                    </div>
                </div>
            </div>
            <div class="card-body p-24">
                <div class="row justify-content-center">
                    <div class="col-xxl-8 col-xl-10 col-lg-12">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="text-md text-primary-light mb-16">Imagem de Perfil</h6>

                                <!-- Upload Image Start -->
                                <div class="mb-24 mt-16">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                            <input type='file' name="profile_image" id="imageUpload" accept=".png, .jpg, .jpeg" hidden>
                                            <label for="imageUpload" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                            </label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview"> </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Upload Image End -->
                                <?= $this->Form->create($user, [
                                        'url' => ['controller' => 'Users', 'action' => 'add', 'user' => $user],
                                        'id' => 'addUserForm'
                                    ]) ?>
                                    <div class="mb-20">
                                        <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Nome <span class="text-danger-600">*</span></label>
                                        <input type="text" class="form-control radius-8" id="name" name="name" placeholder="Digite o nome" required>
                                    </div>
                                    <div class="mb-20">
                                        <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                                        <input type="email" class="form-control radius-8" id="email" name="email" placeholder="Digite o email" required>
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label for="password" class="form-label fw-semibold text-primary-light text-sm mb-8">Senha <span class="text-danger-600">*</span></label>
                                        <input type="password" name="password" class="form-control radius-8" placeholder="Senha" required>
                                    </div>
                                    <div class="mb-20">
                                        <label for="role_ids" class="form-label fw-semibold text-primary-light text-sm mb-8">Permissão <span class="text-danger-600">*</span></label>
                                    <?= $this->Form->control('role_ids', [
                                            'type' => 'select',
                                            'label' => false,
                                            'id' => 'role_ids',
                                            'class' => 'form-control',
                                            'options' => $roles,
                                            'empty' => 'Selecione permissão'
                                        ]);
                                    ?>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <button type="button" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                                            Salvar
                                        </button>
                                    </div>
                                <?= $this->Form->end() ?>
                            </div>
                            <?= $this->Flash->render() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
