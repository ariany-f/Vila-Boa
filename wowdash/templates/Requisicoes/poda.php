<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RequisicoesLogs $form
 */
?>

<?= $this->Form->create($form, [
    'class' => 'row gy-3 needs-validation mb-28',
    'novalidate' => true,
    'type' => 'post',
    'url' => ['action' => 'poda']
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
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-28">
                        <?= $this->Form->control('servico', [
                            'type' => 'radio',
                            'options' => [
                                'emergencia' => 'Solicitação Emergência',
                                'sbc' => 'Processo SBC',
                                'memorando' => 'Memorando',
                                'vcsbc' => 'VcSBC',
                                'legislativo' => 'Oficio Legislativo',
                                'interna' => 'Comunicação Interna',
                                'vila-boa' => 'Solicitação Interna (Vila Boa)'
                            ],
                            'default' => 'emergencia',
                            'label' => false,
                            'templates' => [
                                'nestingLabel' => '{{hidden}}{{input}} <label{{attrs}}>{{text}}</label><br/>'
                            ],
                            'class' => 'form-check-input'
                        ]) ?>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-between flex-wrap" id="poda-div">
                    <div class="col-md-12" id="servico-emergencia-div">
                        <div class="row mb-2">
                            <label class="form-label">Tipo Atendimento</label>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_emergencia', [
                                    'type' => 'radio',
                                    'options' => [
                                        'emergencia-1' => 'Emergência / Risco de Queda / Queda de Árvore'
                                    ],
                                    'label' => false,
                                    'default' => 'emergencia-1',
                                    'templates' => [
                                        'nestingLabel' => '{{hidden}}{{input}} <label{{attrs}}>{{text}}</label>'
                                    ],
                                    'class' => 'form-check-input'
                                ]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Nº da Solicitação</label>
                            <?= $this->Form->control('numero_solicitacao_emergencia', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'readonly' => true,
                                'placeholder' => 'Nº da Solicitação'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-12" id="servico-sbc-div">
                        <div class="row mb-2">
                            <label class="form-label">Tipo Atendimento</label>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_sbc', [
                                    'type' => 'radio',
                                    'options' => [
                                        'garagem' => 'Frente de Garagem (com GAM Paga)',
                                        'municipio' => 'Atendimento ao Município'
                                    ],
                                    'label' => false,
                                    'default' => 'garagem',
                                    'templates' => [
                                        'nestingLabel' => '{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></br>'
                                    ],
                                    'class' => 'form-check-input'
                                ]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Nº da Solicitação</label>
                            <?= $this->Form->control('numero_solicitacao_sbc', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nº da Solicitação'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-12" id="servico-memorando-div">
                        <div class="row mb-2">
                            <label class="form-label">Tipo Atendimento</label>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_memorando', [
                                    'type' => 'radio',
                                    'options' => [
                                        'garagem' => 'Frente de Garagem (com GAM Paga)',
                                        'municipio' => 'Atendimento ao Município'
                                    ],
                                    'label' => false,
                                    'default' => 'garagem',
                                    'templates' => [
                                        'nestingLabel' => '{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></br>'
                                    ],
                                    'class' => 'form-check-input'
                                ]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Nº da Solicitação</label>
                            <?= $this->Form->control('numero_solicitacao_memorando', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nº da Solicitação'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-12" id="servico-vcsbc-div">
                        <div class="row mb-2">
                            <label class="form-label">Tipo Atendimento</label>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_vcsbc', [
                                    'type' => 'radio',
                                    'options' => [
                                        'garagem' => 'Frente de Garagem (com GAM Paga)',
                                        'municipio' => 'Atendimento ao Município'
                                    ],
                                    'label' => false,
                                    'default' => 'garagem',
                                    'templates' => [
                                        'nestingLabel' => '{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></br>'
                                    ],
                                    'class' => 'form-check-input'
                                ]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Nº da Solicitação</label>
                            <?= $this->Form->control('numero_solicitacao_vcsbc', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nº da Solicitação'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-12" id="servico-legislativo-div">
                        <div class="row mb-2">
                            <label class="form-label">Tipo Atendimento</label>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_legislativo', [
                                    'type' => 'radio',
                                    'options' => [
                                        'garagem' => 'Frente de Garagem (com GAM Paga)',
                                        'municipio' => 'Atendimento ao Município'
                                    ],
                                    'label' => false,
                                    'default' => 'garagem',
                                    'templates' => [
                                        'nestingLabel' => '{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></br>'
                                    ],
                                    'class' => 'form-check-input'
                                ]) ?>
                            </div>
                            <div class="row mb-2">
                                <label class="form-label" for="ano"> Ano </label>
                                <?= $this->Form->control('ano_legislativo', [
                                    'type' => 'text',
                                    'label' => false,
                                    'class' => 'form-control',
                                    'id' => 'ano'
                                ]) ?>
                            </div>
                            <div class="row mb-2">
                                <label class="form-label" for="vereador"> Vereador </label>
                                <?= $this->Form->control('vereador', [
                                    'type' => 'select',
                                    'options' => [
                                        'AFONSINHO' => 'AFONSO TORRES (AFONSINHO)',
                                        'FRAN_SILVA' => 'ALESSANDRO DA SILVA (FRAN SILVA)',
                                        'ALEX_MOGNON' => 'ALEXANDER MOGNON (ALEX MOGNON)',
                                        'ANA_DO_CARMO' => 'ANA MARIA DO CARMO ROSSETTO (ANA DO CARMO)',
                                        'ANA_NICE' => 'ANA NICE MARTINS DE CARVALHO (ANA NICE)',
                                        'TONINHO_TAVARES' => 'ANTONIO APARECIDO TAVARES (TONINHO TAVARES)',
                                        'DANILO_LIMA' => 'DANILO LIMA DE RAMOS (DANILO LIMA)',
                                        'DR_ELIEZER_MENDES' => 'ELIEZER MENDES DA SILVA (Dr ELIEZER MENDES)',
                                        'ESTEVAO_CAMOLESI' => 'ESTEVAO EDMAR HADDAD CAMOLESI JUNIOR (ESTEVAO CAMOLESI)',
                                        'NETINHO_RODRIGUES' => 'FRANCISCO JOSÉ RODRIGUES NETO (NETINHO RODRIGUES)',
                                        'GETULIO_DO_AMARELINHO' => 'GETULIO BATISTA CANGUSSU (GETULIO DO AMARELINHO)',
                                        'GLAUCO_BRAIDO' => 'GLAUCO NOVELLO BRAIDO (GLAUCO BRAIDO)',
                                        'MINAMI' => 'HIROYUKI MINAMI (MINAMI)',
                                        'IVAN_SILVA' => 'IVAN FELICIANO SILVA (IVAN SILVA)',
                                        'BISPO_JOAO_BATISTA' => 'JOAO BATISTA RAMOS DA SILVA (Bispo JOAO BATISTA)',
                                        'JOILSON_SANTOS' => 'JOILSON SANTOS DE CARVALHO (JOILSON SANTOS)',
                                        'JORGE_ARAUJO' => 'JORGE ARAUJO DA SILVA (JORGE ARAUJO)',
                                        'ALMIR_DO_GAS' => 'JOSÉ ALMIR DA SILVA (ALMIR DO GÁS)',
                                        'AURELIO' => 'JOSÉ AURÉLIO BARCELAR DE PAULA (AURELIO)',
                                        'GORDO_DA_ADEGA' => 'JOSIAS JOAO DE PAZ (GORDO DA ADEGA)',
                                        'JULINHO_FUZARI' => 'JULIO CESAR FUZARI (JULINHO FUZARI)',
                                        'LUCAS_FERREIRA' => 'LUCAS FERREIRA DO NASCIMENTO (LUCAS FERREIRA)',
                                        'DR_MANUEL' => 'MANUEL PEREIRA MARTINS (Dr MANUEL)',
                                        'MAURICIO_CARDOZO' => 'MAURICIO CARDOZO (MAURICIO CARDOZO)',
                                        'PAULO_CHUCHU' => 'PAULO EDUARDO LOPES (PAULO CHUCHU)',
                                        'PERY_CARTOLA' => 'PERY RODRIGUES DOS SANTOS (PERY CARTOLA)',
                                        'REGINALDO_BURGUES' => 'REGINALDO FERREIRA DA SILVA (REGINALDO BURGUES)',
                                        'PALHINHA' => 'ROBERTO GARCIA FUENTES (PALHINHA)',
                                        'ARY_DE_OLIVEIRA' => 'ARY JOSE DE OLIVEIRA (ARY DE OLIVEIRA)',
                                        'EDUARDO_GINEZ_TUDO_AZUL' => 'EDUARDO VERZEGNASSI GINEZ (EDUARDO GINEZ TUDO AZUL)',
                                        'HENRIQUE_KABECA' => 'HENRIQUE SANTOS DE OLIVEIRA (HENRIQUE KABECA)',
                                        'LEO_RR' => 'LEO RR (LEO RR)'
                                    ],
                                    'class' => 'form-control',
                                    'id' => 'vereador',
                                    'label' => false,
                                    'empty' => 'Selecione o vereador'
                                ]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Nº da Solicitação</label>
                            <?= $this->Form->control('numero_solicitacao_legislativo', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nº da Solicitação'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-12" id="servico-interna-div">
                        <div class="row mb-2">
                            <label class="form-label">Tipo Atendimento</label>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_interna', [
                                    'type' => 'radio',
                                    'options' => [
                                        'garagem' => 'Frente de Garagem (com GAM Paga)',
                                        'municipio' => 'Atendimento ao Município'
                                    ],
                                    'label' => false,
                                    'default' => 'garagem',
                                    'templates' => [
                                        'nestingLabel' => '{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></br>'
                                    ],
                                    'class' => 'form-check-input'
                                ]) ?>
                            </div>
                            <div class="row mb-2">
                                <label class="form-label" for="ano">Ano</label>
                                <?= $this->Form->control('ano_interna', [
                                    'type' => 'text',
                                    'label' => false,
                                    'class' => 'form-control',
                                    'id' => 'ano'
                                ]) ?>
                            </div>
                            <div class="row mb-2">
                                <label class="form-label" for="secretaria"> Secretaria </label>
                                <?= $this->Form->control('secretaria', [
                                    'type' => 'select',
                                    'options' => [
                                        'CMS' => 'CONSELHO MUN DA SAUDE',
                                        'CMAS' => 'CONSELHO MUN DE ASSISTENCIA SOCIAL',
                                        'CME' => 'CONSELHO MUN DE EDUCACAO',
                                        'COMSEA' => 'CONSELHO MUN DE SEGURANCA ALIM E NUTRICIONAL',
                                        'CMDPcD' => 'CONSELHO MUN DIREITOS DA PESSOA COM DEFICIENCIA',
                                        'COMPAHC' => 'CONSELHO MUN DO PATRIMONIO HIST E CULTURAL',
                                        'CMDPI' => 'CONSELHO MUN DOS DIREITOS DA PESSOA IDOSA',
                                        'FDSBC' => 'FACULDADE DE DIREITO',
                                        'FSS' => 'FUNDO SOCIAL DE SOLIDADRIEDADE',
                                        'IMASF' => 'INSTITUTO MUN DE ASSIST SAUDE FUNCIONALISMO',
                                        'SBCPREV' => 'INSTITUTO PREVIDENCIA MUN SAO BERNARDO',
                                        'PGM' => 'PROCURADORIA GERAL DO MUNICIPIO',
                                        'SA' => 'SECRETARIA ADMINISTRACAO E INOVACAO',
                                        'SAS' => 'SECRETARIA ASSISTENCIA SOCIAL',
                                        'SCG' => 'SECRETARIA CHEFIA DE GABINETE',
                                        'SCPD' => 'SECRETARIA CIDADANIA E DA PESSOA COM DEFICIENCIA',
                                        'SECOM' => 'SECRETARIA COMUNICACAO',
                                        'SCP' => 'SECRETARIA CONCESSOES E PARCERIAS',
                                        'SCOG' => 'SECRETARIA COORDENACAO GOVERNAMENTAL',
                                        'SC' => 'SECRETARIA CULTURA E JUVENTUDE',
                                        'SDECT' => 'SECRETARIA DESENV ECONONOMICO CIEN TEC TRAB E TUR',
                                        'SE' => 'SECRETARIA EDUCACAO',
                                        'SESP' => 'SECRETARIA ESPORTES E LAZER',
                                        'SF' => 'SECRETARIA FINANCAS',
                                        'SG' => 'SECRETARIA GOVERNO',
                                        'SEHAB' => 'SECRETARIA HABITACAO',
                                        'SMA' => 'SECRETARIA MEIO AMBIENTE E PROTECAO ANIMAL',
                                        'SOPE' => 'SECRETARIA OBRAS E PLANEJAMENTO ESTRATEGICO',
                                        'SS' => 'SECRETARIA SAUDE',
                                        'SSU' => 'SECRETARIA SEGURANCA URBANA',
                                        'SU' => 'SECRETARIA SERVICOS URBANOS',
                                        'ST' => 'SECRETARIA TRANSPORTES E VIAS PUBLICAS',
                                        'SPRG' => 'SUB PREFEITURA RIACHO GRANDE'
                                    ],
                                    'class' => 'form-control',
                                    'id' => 'secretaria',
                                    'label' => false,
                                    'empty' => 'Selecione a secretaria'
                                ]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Nº da Solicitação</label>
                            <?= $this->Form->control('numero_solicitacao_interna', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nº da Solicitação'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-12" id="servico-vila-boa-div">
                        <div class="row mb-2">
                            <label class="form-label">Tipo Atendimento</label>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_vila_boa', [
                                    'type' => 'radio',
                                    'options' => [
                                        'garagem' => 'Frente de Garagem (com GAM Paga)',
                                        'municipio' => 'Atendimento ao Município'
                                    ],
                                    'label' => false,
                                    'default' => 'garagem',
                                    'templates' => [
                                        'nestingLabel' => '{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></br>'
                                    ],
                                    'class' => 'form-check-input'
                                ]) ?>
                            </div>
                            <div class="row mb-2">
                                <label class="form-label" for="ano"> Ano </label>
                                <?= $this->Form->control('ano_vila_boa', [
                                    'type' => 'text',
                                    'label' => false,
                                    'class' => 'form-control',
                                    'id' => 'ano'
                                ]) ?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="form-label">Nº da Solicitação</label>
                            <?= $this->Form->control('numero_solicitacao_vila_boa', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nº da Solicitação'
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap">
                    <div class="col-md-4">
                        <label class="form-label">Selecionar Serviço</label>
                        <?= $this->Form->control('servico_selecionado', [
                            'type' => 'select',
                            'label' => false,
                            'options' => [
                                'Poda' => 'Poda',
                                'Remocao' => 'Remoção',
                                'Destoca' => 'Destoca',
                                'Reparo de Passeio' => 'Reparo de Passeio',
                                'Liberacao de Via' => 'Liberação de Via Pública'
                            ],
                            'class' => 'form-control',
                            'empty' => ' ',
                            'required' => true
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Quantidade Árvores:</label>
                        <?= $this->Form->control('quantidade_arvores', [
                            'type' => 'text',
                            'label' => false,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Data Solicitação</label>
                        <?= $this->Form->control('data_solicitacao', [
                            'type' => 'date',
                            'label' => false,
                            'class' => 'form-control'
                        ]) ?>
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
                <div class="col-md-12 d-flex align-items-start justify-content-between flex-wrap mt-28">
                    <div class="col-md-5">
                        <label class="form-label">Imagem do Local </label>
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

        let serviceContainer = $("#poda-div");

        // Só executa o código se o container existir
        if (serviceContainer.length) {
            hideAllServiceDivs();
            serviceContainer.children("#servico-emergencia-div").show();
            generateEmergencyNumber();
            // Evento de mudança nos inputs de rádio
            $("input[name='servico']").on("change", function () {
                hideAllServiceDivs();

                let selectedService = $(this).attr("id");
                let serviceDiv = $("#" + selectedService + "-div");

                // Mostra apenas se a div existir dentro do container
                if (serviceDiv.length) {
                    serviceDiv.show();
                }
                
                // Se for emergência, gera o número da solicitação
                if (selectedService === 'servico-emergencia') {
                    generateEmergencyNumber();
                }
                else
                {
                    $("#numero-solicitacao-emergencia").val('').change();
                }
            });

            function hideAllServiceDivs() {
                serviceContainer.children("div[id$='-div']").hide();
            }
        }
        
        function generateEmergencyNumber() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            const emergencyNumber = `EM${year}${day}${month}${hours}${minutes}${seconds}`;
            $("#numero-solicitacao-emergencia").val(emergencyNumber).change();
        }
    });
</script>
<?php $this->end(); ?>
<?= $this->Flash->render() ?>