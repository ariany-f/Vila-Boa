<div class="row gy-4"> 
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
        <div class="card-body col-lg-12 p-24 d-flex">
            <div class="col-lg-4">
                <div class="user-grid-card position-relative  radius-16 overflow-hidden bg-base h-100">
                    <img src="<?= $this->Url->assetUrl('assets/images/bg-user.png') ?>" alt="" class="w-100 object-fit-cover">
                    <div class="pb-24 ms-16 mb-24 me-16 mt--100">
                        <div class="text-center border border-top-0 border-start-0 border-end-0">
                            <?php $profileImage = !empty($user->profile_image) ? $this->Url->assetUrl(h($user->profile_image)) : $this->Url->assetUrl('assets/images/user-grid/user-grid-img14.png'); ?>
                            <img src="<?= $profileImage ?>" alt="" class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                            <!-- Nome do usuário -->
                            <h6 class="mb-0 mt-16"><?= h($user->name) ?></h6>
                            <!-- Email do usuário -->
                            <span class="text-secondary-light mb-16"><?= h($user->email) ?></span>
                        </div>
                        <div class="mt-24">
                            <h6 class="text-xl mb-16">Informações Pessoais</h6>
                            <ul>
                            <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Nome</span>
                                    <span class="w-70 text-secondary-light fw-medium">: <?= h($user->name) ?></span>
                                </li>
                                <li class="d-flex align-items-center gap-1 mb-12">
                                    <span class="w-30 text-md fw-semibold text-primary-light">Email</span>
                                    <span class="w-70 text-secondary-light fw-medium">: <?= h($user->email) ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card h-100">
                    <div class="card-body">
                        <ul class="nav border-gradient-tab nav-pills mb-20 d-inline-flex" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center px-24 active" id="pills-edit-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-edit-profile" type="button" role="tab" aria-controls="pills-edit-profile" aria-selected="true">
                                    Editar Perfil
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center px-24" id="pills-change-passwork-tab" data-bs-toggle="pill" data-bs-target="#pills-change-passwork" type="button" role="tab" aria-controls="pills-change-passwork" aria-selected="false" tabindex="-1">
                                    Alterar Senha
                                </button>
                            </li>
                            <!-- <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center px-24" id="pills-notification-tab" data-bs-toggle="pill" data-bs-target="#pills-notification" type="button" role="tab" aria-controls="pills-notification" aria-selected="false" tabindex="-1">
                                    Configurações de Notificação
                                </button>
                            </li> -->
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                            <h6 class="text-md text-primary-light mb-16">Imagem de Perfil</h6>
                                <!-- Upload de Imagem Fim -->
                                <?= $this->Form->create($user, [
                                    'url' => ['controller' => 'Users', 'action' => 'edit', $user->id],
                                    'id' => 'editUserForm',
                                    'type' => 'file' // Adicionando o suporte a upload de arquivos
                                ]) ?>
                                <!-- Upload de Imagem Início -->
                                <div class="mb-24 mt-16">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                            <?= $this->Form->control('profile_image', [
                                                'type' => 'file',
                                                'label' => false,
                                                'accept' => '.png, .jpg, .jpeg',
                                                'hidden' => true,
                                                'id' => 'imageUpload'
                                            ]) ?>
                                            <label for="imageUpload" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                            </label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url('<?= $profileImage ?>');">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Nome <span class="text-danger-600">*</span></label>
                                                <input type="text" name="name" class="form-control radius-8" id="name" placeholder="Digite o Nome Completo" value="<?= h($user->name) ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-20">
                                                <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                                                <input type="email" name="email" class="form-control radius-8" id="email" placeholder="Digite o endereço de email" value="<?= h($user->email) ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-20">
                                            <label for="role_id" class="form-label fw-semibold text-primary-light text-sm mb-8">Tipo <span class="text-danger-600">*</span></label>
                                                <?= $this->Form->control('role_id', [
                                                    'type' => 'select',
                                                    'options' => $roles, // Exibe as opções dos roles
                                                    'empty' => 'Selecione a permissão...', // Placeholder
                                                    'class' => 'form-control radius-8',
                                                    'label' => false,
                                                    'value' => (!empty($user->roles) ? $user->roles[0]['id'] : null)  // Valor selecionado
                                                ]) ?>
                                                </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mt-24 d-flex justify-content-end">
                                                <button class="btn btn-primary btn-sm">Salvar Alterações</button>
                                            </div>
                                        </div>
                                    </div>
                                <?= $this->Form->end() ?>
                                <?= $this->Flash->render() ?>
                            </div>

                            <div class="tab-pane fade" id="pills-change-passwork" role="tabpanel" aria-labelledby="pills-change-passwork-tab" tabindex="0">
                                <!-- Upload de Imagem Fim -->
                                <?= $this->Form->create($user, [
                                    'url' => ['controller' => 'Users', 'action' => 'changePassword', $user->id],
                                    'id' => 'changePasswordUserForm'
                                ]) ?>
                                <div class="mb-20">
                                    <label for="your-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Nova Senha <span class="text-danger-600">*</span></label>
                                    <div class="position-relative">
                                        <input name="new_password" type="password" class="form-control radius-8" id="your-password" placeholder="Digite a Nova Senha*">
                                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                                    </div>
                                </div>
                                <div class="mb-20">
                                    <label for="confirm-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmar Senha <span class="text-danger-600">*</span></label>
                                    <div class="position-relative">
                                        <input name="confirm_password" type="password" class="form-control radius-8" id="confirm-password" placeholder="Confirmar Senha*">
                                        <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#confirm-password"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mt-24 d-flex justify-content-end">
                                        <button class="btn btn-primary btn-sm">Salvar Alterações</button>
                                    </div>
                                </div>
                                <?= $this->Form->end() ?>
                                <?= $this->Flash->render() ?>
                            </div>

                            <!-- <div class="tab-pane fade" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab" tabindex="0">
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="companzNew" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Notícias da Empresa</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="companzNew">
                                    </div>
                                </div>
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="pushNotifcation" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Notificações Push</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="pushNotifcation" checked>
                                    </div>
                                </div>
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="weeklyLetters" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Boletins Semanais</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="weeklyLetters" checked>
                                    </div>
                                </div>
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="meetUp" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Meetups Próximos a Você</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="meetUp">
                                    </div>
                                </div>
                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                    <label for="orderNotification" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Notificações de Pedidos</span>
                                        <input class="form-check-input" type="checkbox" role="switch" id="orderNotification" checked>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
            <?= $this->Flash->render() ?>
        </div>
    </div>
</div>


<?php $this->start('script'); ?>
    <script>
    // ======================== Upload de Imagem Início =====================
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#imageUpload').change(function () {
        readURL(this);
    });
    // ======================== Upload de Imagem Fim =====================

    // ================== Mostrar/Esconder Senha Início ==========
    function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function () {
            $(this).toggleClass('ri-eye-off-line');
            var input = $($(this).attr('data-toggle'));
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
            } else {
                input.attr('type', 'password');
            }
        });
    }
    // Chama a função
    initializePasswordToggle('.toggle-password');
    // ========================= Mostrar/Esconder Senha Fim ===========================
</script>
<?php $this->end(); ?>
