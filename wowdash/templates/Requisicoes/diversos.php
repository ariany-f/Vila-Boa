<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity/RequisicoesLogs $form
 */
?>

<?= $this->Form->create($form, [
    'class' => 'row gy-3 needs-validation mb-28',
    'method' => 'post',
    'action' => 'diversos',
    'novalidate' => 'novalidate'
]) ?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="card-header border-bottom bg-base py-16 px-24">
                <h6 class="text-lg fw-semibold mb-0">Opções</h6>
            </div>
            <div class="card-body col-md-12 d-flex align-items-between">
                <div class="col-md-6">
                    <label class="form-label">Selecionar Serviços</label>
                    <div class="col-md-12 gy-2 pe-24">
                        
                        <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                            <label for="capina" class="position-absolute w-100 h-100 start-0 top-0"></label>
                            <div class="d-flex align-items-center gap-3 justify-content-between">
                                <span class="form-check-label line-height-1 fw-medium text-secondary-light">Capina de Guia, Sarjeta e Passeio</span>
                                <input name="capina" class="form-check-input" type="checkbox" role="switch" id="capina">
                            </div>
                        </div>
                    
                        <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                            <label for="limpeza" class="position-absolute w-100 h-100 start-0 top-0"></label>
                            <div class="d-flex align-items-center gap-3 justify-content-between">
                                <span class="form-check-label line-height-1 fw-medium text-secondary-light">Limpeza Geral, Varrição, Raspagem de Terra</span>
                                <input name="limpeza" class="form-check-input" type="checkbox" role="switch" id="limpeza">
                            </div>
                        </div>
                    
                        <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                            <label for="outros" class="position-absolute w-100 h-100 start-0 top-0"></label>
                            <div class="d-flex align-items-center gap-3 justify-content-between">
                                <span class="form-check-label line-height-1 fw-medium text-secondary-light">Outros Serviços</span>
                                <input name="outros" class="form-check-input" type="checkbox" role="switch" id="outros">
                            </div>
                        </div>
                    
                        <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                            <label for="pinturaMuretaCordao" class="position-absolute w-100 h-100 start-0 top-0"></label>
                            <div class="d-flex align-items-center gap-3 justify-content-between">
                                <span class="form-check-label line-height-1 fw-medium text-secondary-light">Pintura de Mureta e Cordões de Praças</span>
                                <input name="pinturaMuretaCordao" class="form-check-input" type="checkbox" role="switch" id="pinturaMuretaCordao">
                            </div>
                        </div>
                    
                        <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                            <label for="pinturaGuiaPoste" class="position-absolute w-100 h-100 start-0 top-0"></label>
                            <div class="d-flex align-items-center gap-3 justify-content-between">
                                <span class="form-check-label line-height-1 fw-medium text-secondary-light">Pintura de Guias e Postes</span>
                                <input name="pinturaGuiaPoste" class="form-check-input" type="checkbox" role="switch" id="pinturaGuiaPoste">
                            </div>
                        </div>
                    
                        <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                            <label for="rocada" class="position-absolute w-100 h-100 start-0 top-0"></label>
                            <div class="d-flex align-items-center gap-3 justify-content-between">
                                <span class="form-check-label line-height-1 fw-medium text-secondary-light">Roçada Canteiro/Ilhas</span>
                                <input name="rocada" class="form-check-input" type="checkbox" role="switch" id="rocada">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-between flex-wrap">
                    <div class="col-md-12">
                        <label class="form-label">Caminhão a Disposição</label>
                        <div class="d-flex align-items-center flex-wrap gap-28">
                            <?= $this->Form->control('caminhaoDisposicao', [
                                'type' => 'radio',
                                'options' => [
                                    '1' => 'Sim',
                                    '0' => 'Não'
                                ],
                                'class' => 'form-check-input',
                                'default' => '0',
                                'label' => false,
                                'required' => true,
                                'templates' => [
                                    'nestingLabel' => '{{hidden}}{{input}} <label{{attrs}}>{{text}}</label> '
                                ]
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Tipo Atendimento</label>
                        <div class="d-flex align-items-center flex-wrap gap-28">
                            <?= $this->Form->control('tipoAtendimento', [
                                'type' => 'radio',
                                'options' => [
                                    'Urgente' => 'Urgente',
                                    'Normal' => 'Normal'
                                ],
                                'class' => 'form-check-input',
                                'default' => 'Urgente',
                                'label' => false,
                                'required' => true,
                                'templates' => [
                                    'nestingLabel' => '{{hidden}}{{input}} <label{{attrs}}>{{text}}</label> '
                                ]
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap">
                        <div class="col-md-4">
                            <label class="form-label">Previsão de Execução</label>
                            <?= $this->Form->control('previsaoExecucao', [
                                'type' => 'date',
                                'label' => false,
                                'required' => true,
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Hora:</label>
                            <?= $this->Form->control('horaExecucao', [
                                'type' => 'time',
                                'required' => true,
                                'label' => false,
                                'class' => 'form-control'
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header border-bottom bg-base py-16 px-24">
                <h6 class="text-lg fw-semibold mb-0">Endereço</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap mt-28">
                    <div class="col-md-2">
                        <label class="form-label">CEP</label>
                        <?= $this->Form->control('cep', [
                            'label' => false,
                            'required' => true,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Logradouro</label>
                        <?= $this->Form->control('logradouro', [
                            'label' => false,
                            'required' => true,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">Número</label>
                        <?= $this->Form->control('numero', [
                            'label' => false,
                            'required' => true,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Sub Bairro:</label>
                        <?= $this->Form->control('subbairro', [
                            'label' => false,
                            'required' => true,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Bairro:</label>
                        <?= $this->Form->control('bairro', [
                            'label' => false,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                </div>
                <div class="col-md-12 d-flex align-items-start justify-content-between flex-wrap mt-28">
                    <div class="col-md-5">
                        <label class="form-label">Imagem do Local </label>
                        <?= $this->Form->control('imagemLocal', [
                            'label' => false,
                            'required' => true,
                            'type' => 'file',
                            'class' => 'form-control form-control-sm'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Observação</label>
                        <?= $this->Form->control('observacao', [
                            'label' => false,
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'rows' => 4,
                            'placeholder' => 'Digite sua observação...'
                        ]) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-12 d-flex align-items-center flex-wrap justify-content-end">
                <?= $this->Form->button('Confirmar', [
                    'type' => 'submit',
                    'class' => 'btn btn-primary-600 radius-8 px-20 py-11'
                ]) ?>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>

<?php $this->start('script'); ?>
<?= $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js') ?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js') ?>
<script>
    $(document).ready(function() {
        $("#cep").mask("99999-999");
        $("#cep").on("keyup", function () {
            let cep = $(this).val().replace(/\D/g, ""); // Remove caracteres não numéricos

            if (cep.length === 8) {
                $.ajax({
                    url: `https://viacep.com.br/ws/${cep}/json/`,
                    method: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (!data.erro) {
                            // Preencha os campos com os dados retornados
                            $("#logradouro").val(data.logradouro);
                            $("#logradouro").attr('readonly', true);
                            $("#subbairro").val(data.bairro);
                            $("#subbairro").attr('readonly', true);
                        } else {
                            alert("CEP não encontrado.");
                        }
                    },
                    error: function () {
                        alert("Erro ao buscar o CEP.");
                    }
                });
            } else {
                $("#logradouro").val('');
                $("#logradouro").attr('readonly', false);
                $("#subbairro").val('');
                $("#subbairro").attr('readonly', false);
            }
        });
    });
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
</script>
<?php $this->end(); ?>
<?= $this->Flash->render() ?>