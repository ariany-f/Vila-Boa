<section class="auth forgot-password-page bg-base d-flex flex-wrap">
    <div class="auth-left d-lg-block d-none">
        <div class="d-flex align-items-center flex-column h-100 justify-content-center">
            <img src="<?= $this->Url->assetUrl('assets/images/auth/forgot-pass-img.png') ?>" alt="">
        </div>
    </div>
    <div class="auth-right py-32 px-24 d-flex flex-column justify-content-center">
        <div class="max-w-464-px mx-auto w-100">
            <div>
                <h4 class="mb-12">Esqueceu a Senha</h4>
                <p class="mb-32 text-secondary-light text-lg">Digite o e-mail de autenticação e vamos te enviar um e-mail de recuperação de conta.</p>
            </div>
            <form action="#">
                <div class="icon-field">
                    <span class="icon top-50 translate-middle-y">
                        <iconify-icon icon="mage:email"></iconify-icon>
                    </span>
                    <input type="email" class="form-control h-56-px bg-neutral-50 radius-12" placeholder="Digite o email">
                </div>
                <button type="button" class="btn btn-primary text-sm btn-sm px-12 py-16 w-100 radius-12 mt-32" data-bs-toggle="modal" data-bs-target="#exampleModal">Continue</button>

                <div class="text-center">
                    <a href="<?= $this->Url->build(['_name' => 'signin']) ?>" class="text-primary-600 fw-bold mt-24">Voltar ao Login</a>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
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

