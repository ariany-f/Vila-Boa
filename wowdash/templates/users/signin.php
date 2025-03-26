<section class="auth bg-base d-flex flex-wrap">
    <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="<?= $this->Url->assetUrl('assets/images/auth/auth-img.png') ?>" alt="">
        </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <a href="<?= $this->Url->build(['_name' => 'index']) ?>" class="mb-40 max-w-290-px auth-logo">
                    <img src="<?= $this->Url->assetUrl('assets/images/logo.png') ?>" alt="site logo" class="light-logo">
                    <img src="<?= $this->Url->assetUrl('assets/images/logo-light.png') ?>" alt="site logo" class="dark-logo">
                </a>
                <h4 class="mb-12">Entrar</h4>
                <p class="mb-32 text-secondary-light text-lg">Bem vindo(a) de volta! Preencha os dados para entrar.</p>
            </div>
            <form class="needs-validation row gy-3 " action="<?= $this->Url->build(['controller' => 'Users', 'action' => 'signin']) ?>" method="post" novalidate>
                <input type="hidden" name="_csrfToken" value="<?= $this->request->getAttribute('csrfToken'); ?>">
                <div class="col-md-12">
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="mage:email"></iconify-icon>
                        </span>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="invalid-feedback">
                            Preencha email
                        </div>
                    </div>
                </div>
                <div class="position-relative mb-20">
                    <div class="icon-field has-validation">
                        <span class="icon">
                            <iconify-icon icon="solar:lock-password-outline"></iconify-icon>
                        </span>
                        <input type="password" name="password" class="form-control" required>
                        <div class="invalid-feedback">
                            Preencha senha
                        </div>
                    </div>
                    <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                </div>
                <div class="">
                    <div class="d-flex justify-content-between gap-2">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input border border-neutral-300" type="checkbox" value="" id="remeber">
                            <label class="form-check-label" for="remeber">Lembrar-me </label>
                        </div>
                        <a href="<?= $this->Url->build(['_name' => 'forgotPassword']) ?>" class="text-primary-600 fw-medium">Esqueceu a Senha?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32"> Entrar</button>
<!-- 
                <div class="mt-32 text-center text-sm">
                    <p class="mb-0">Não tem conta? <a href="<?= $this->Url->build(['_name' => 'signup']) ?>" class="text-primary-600 fw-semibold">Cadastrar</a></p>
                </div> -->
            </form>
            <?= $this->Flash->render() ?>
        </div>
    </div>
</section>

<?php $this->start('script'); ?>    
<script>
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
    // ================== Password Show Hide Js Start ==========
    function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on('click', function() {
            $(this).toggleClass('ri-eye-off-line');
            var input = $($(this).attr('data-toggle'));
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
            } else {
                input.attr('type', 'password');
            }
        });
    }
    // Call the function
    initializePasswordToggle('.toggle-password');
    // ========================= Password Show Hide Js End ===========================
</script>
<?php $this->end(); ?>