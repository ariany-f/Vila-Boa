<section class="auth forgot-password-page bg-base d-flex flex-wrap">
    <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="<?= $this->Url->assetUrl('assets/images/bg-app.png') ?>" alt="">
        </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <h4 class="mb-12">Esqueceu a Senha</h4>
                <p class="mb-32 text-secondary-light text-lg">Digite o e-mail de autenticação e vamos te enviar um e-mail de recuperação de conta.</p>
            </div>
            <form class="needs-validation" id="forgot-password-form" action="#" novalidate>
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
                <button type="submit" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">Continue</button>

                <div class="text-center">
                    <a href="<?= $this->Url->build(['_name' => 'signin']) ?>" class="text-primary-600 fw-bold mt-24">Voltar ao Login</a>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="sendModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-body p-40 text-center">
                <div class="mb-32">
                    <img src="<?= $this->Url->assetUrl('assets/images/auth/envelop-icon.png') ?>" alt="">
                </div>
                <h6 class="mb-12">Verifique seu e-mail</h6>
                <p class="text-secondary-light text-sm mb-0">Obrigado, verifique seu e-mail para obter instruções sobre como redefinir sua senha</p>
                <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32">Pular</button>
                <div class="mt-32 text-sm">
                    <p class="mb-0">Não recebeu nenhum email? <a href="#" class="text-primary-600 fw-semibold">Reenviar</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>    
<script>
    (() => {
        'use strict'

        // Fetch the form and button
        const forms = document.querySelectorAll('.needs-validation');
        const modal = new bootstrap.Modal(document.getElementById('sendModal'));

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                else
                {
                    event.preventDefault()
                    event.stopPropagation()
                    modal.show();
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
<?php $this->end(); ?>
