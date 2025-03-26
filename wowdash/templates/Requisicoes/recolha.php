<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity/RequisicoesLogs $form
 */
?>

<?= $this->Form->create($form, [
    'class' => 'row gy-3 needs-validation mb-28',
    'novalidate' => true,
    'type' => 'post',
    'url' => ['action' => 'recolha']
]) ?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="card-header border-bottom bg-base py-16 px-24">
                <h6 class="text-lg fw-semibold mb-0">Recolha</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap mt-28">
                    <div class="col-md-2">
                        <label class="form-label">CEP</label>
                        <?= $this->Form->control('cep', [
                            'type' => 'text',
                            'label' => false,
                            'class' => 'form-control',
                            'id' => 'cep'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Logradouro</label>
                        <?= $this->Form->control('logradouro', [
                            'type' => 'text',
                            'label' => false,
                            'class' => 'form-control',
                            'id' => 'logradouro'
                        ]) ?>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">Número</label>
                        <?= $this->Form->control('numero', [
                            'type' => 'text',
                            'label' => false,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Sub Bairro:</label>
                        <?= $this->Form->control('subbairro', [
                            'type' => 'text',
                            'label' => false,
                            'class' => 'form-control',
                            'id' => 'subbairro'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Bairro:</label>
                        <?= $this->Form->control('bairro', [
                            'type' => 'text',
                            'label' => false,
                            'class' => 'form-control',
                            'id' => 'bairro'
                        ]) ?>
                    </div>
                </div>
                <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap mt-28">
                    <div class="col-md-5">
                        <label class="form-label">Tipo de Resíduo</label>
                        <?= $this->Form->control('tipo_residuo', [
                            'type' => 'select',
                            'label' => false,
                            'options' => [
                                'organico' => 'Orgânico',
                                'reciclavel' => 'Reciclável',
                                'eletronico' => 'Eletrônico',
                                'entulho' => 'Entulho'
                            ],
                            'class' => 'form-control',
                            'empty' => 'Selecione o tipo de resíduo'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Quantidade (kg)</label>
                        <?= $this->Form->control('quantidade', [
                            'type' => 'number',
                            'label' => false,
                            'class' => 'form-control',
                            'placeholder' => 'Digite a quantidade em kg'
                        ]) ?>
                    </div>
                </div>
                <div class="col-md-12 d-flex align-items-start justify-content-between flex-wrap mt-28">
                    <div class="col-md-5">
                        <label class="form-label">Imagem do Local</label>
                        <?= $this->Form->control('imagem_local', [
                            'type' => 'file',
                            'label' => false,
                            'class' => 'form-control form-control-sm'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Observação</label>
                        <?= $this->Form->control('observacao', [
                            'type' => 'textarea',
                            'label' => false,
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
</script>
<?php $this->end(); ?>
<?= $this->Flash->render() ?>