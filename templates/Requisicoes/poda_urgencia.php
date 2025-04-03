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
                    <div class="d-flex form-check align-items-center justify-content-between flex-wrap gap-28">
                        <?= $this->Form->control('servico', [
                            'type' => 'radio',
                            'options' => [
                                'emergencia' => 'Solicitação Emergência',
                                'sbc' => 'Processo SBC',
                                'memorando' => 'Memorando',
                                'vcsbc' => 'VcSBC',
                                'legislativo' => 'Oficio Legislativo',
                                'interna' => 'Comunicação Interna'
                            ],
                            'label' => false,
                            'templates' => [
                                'nestingLabel' => '<div class="d-flex justify-content-start align-items-center gap-1">{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></div>'
                            ],
                            'class' => 'form-check-input'
                        ]) ?>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-between flex-wrap" id="poda-div">
                    <div class="col-md-12" id="servico-emergencia-div">
                        <div class="row mb-2">
                            <label class="form-label">Tipo Atendimento</label>
                            <div class="d-flex form-check align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_emergencia', [
                                    'type' => 'radio',
                                    'options' => [
                                        'emergencia-1' => 'Emergência / Risco de Queda / Queda de Árvore',
                                        'urgencia' => 'Urgência'
                                    ],
                                    'label' => false,
                                    'default' => 'emergencia-1',
                                    'templates' => [
                                        'nestingLabel' => '<div class="d-flex justify-content-start align-items-center gap-1">{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></div>'
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
                            <div class="d-flex form-check align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_sbc', [
                                    'type' => 'radio',
                                    'options' => [
                                        'garagem' => 'Frente de Garagem (com GAM Paga)',
                                        'municipio' => 'Atendimento ao Município',
                                        'ouvidoria' => 'Ouvidoria',
                                        'urgencia' => 'Urgência'
                                    ],
                                    'label' => false,
                                    'default' => 'garagem',
                                    'templates' => [
                                        'nestingLabel' => '<div class="d-flex justify-content-start align-items-center gap-1">{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></div>'
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
                        <div class="row" id="gam-sbc-div" style="display:none;">
                            <label class="form-label">Nº da GAM</label>
                            <?= $this->Form->control('gam_sbc', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nº da GAM'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-12" id="servico-memorando-div">
                        <div class="row mb-2">
                            <label class="form-label">Tipo Atendimento</label>
                            <div class="d-flex form-check align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_memorando', [
                                    'type' => 'radio',
                                    'options' => [
                                        'garagem' => 'Frente de Garagem (com GAM Paga)',
                                        'municipio' => 'Atendimento ao Município',
                                        'proprio' => 'Próprio Municipal',
                                        'urgencia' => 'Urgência'
                                    ],
                                    'label' => false,
                                    'default' => 'garagem',
                                    'templates' => [
                                        'nestingLabel' => '<div class="d-flex justify-content-start align-items-center gap-1">{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></div>'
                                    ],
                                    'class' => 'form-check-input'
                                ]) ?>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label class="form-label" for="secretaria_memorando"> Secretaria </label>
                            <?= $this->Form->control('secretaria_memorando', [
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
                                'id' => 'secretaria_memorando',
                                'label' => false,
                                'empty' => 'Selecione a secretaria'
                            ]) ?>
                        </div>
                        <div class="row" id="proprio-memorando-div" style="display:none;">
                            <label class="form-label">Próprio Municipal</label>
                            <?= $this->Form->control('proprio_memorando', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nome do Próprio Municipal'
                            ]) ?>
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
                        <div class="row" id="gam-memorando-div" style="display:none;">
                            <label class="form-label">Nº da GAM</label>
                            <?= $this->Form->control('gam_memorando', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nº da GAM'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-12" id="servico-vcsbc-div">
                        <div class="row mb-2">
                            <label class="form-label">Tipo Atendimento</label>
                            <div class="d-flex form-check align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_vcsbc', [
                                    'type' => 'radio',
                                    'options' => [
                                        'garagem' => 'Frente de Garagem (com GAM Paga)',
                                        'municipio' => 'Atendimento ao Município',
                                        'urgencia' => 'Urgência'
                                    ],
                                    'label' => false,
                                    'default' => 'garagem',
                                    'templates' => [
                                        'nestingLabel' => '<div class="d-flex justify-content-start align-items-center gap-1">{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></div>'
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
                        <div class="row" id="gam-vcsbc-div" style="display:none;">
                            <label class="form-label">Nº da GAM</label>
                            <?= $this->Form->control('gam_vcsbc', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nº da GAM'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-12" id="servico-legislativo-div">
                        <div class="row mb-2">
                            <label class="form-label">Tipo Atendimento</label>
                            <div class="d-flex form-check align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_legislativo', [
                                    'type' => 'radio',
                                    'options' => [
                                        'garagem' => 'Frente de Garagem (com GAM Paga)',
                                        'municipio' => 'Atendimento ao Município',
                                        'urgencia' => 'Urgência'
                                    ],
                                    'label' => false,
                                    'default' => 'garagem',
                                    'templates' => [
                                        'nestingLabel' => '<div class="d-flex justify-content-start align-items-center gap-1">{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></div>'
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
                        <div class="row" id="gam-legislativo-div" style="display:none;">
                            <label class="form-label">Nº da GAM</label>
                            <?= $this->Form->control('gam_legislativo', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nº da GAM'
                            ]) ?>
                        </div>
                    </div>

                    <div class="col-md-12" id="servico-interna-div">
                        <div class="row mb-2">
                            <label class="form-label">Tipo Atendimento</label>
                            <div class="d-flex form-check align-items-center justify-content-between flex-wrap gap-28">
                                <?= $this->Form->control('atendimento_interna', [
                                    'type' => 'radio',
                                    'options' => [
                                        'garagem' => 'Frente de Garagem (com GAM Paga)',
                                        'municipio' => 'Atendimento ao Município',
                                        'proprio' => 'Próprio Municipal',
                                        'urgencia' => 'Urgência'
                                    ],
                                    'label' => false,
                                    'default' => 'garagem',
                                    'templates' => [
                                        'nestingLabel' => '<div class="d-flex justify-content-start align-items-center gap-1">{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></div>'
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
                            <div class="row" id="proprio-interna-div" style="display:none;">
                                <label class="form-label">Próprio Municipal</label>
                                <?= $this->Form->control('proprio_interna', [
                                    'type' => 'text',
                                    'label' => false,
                                    'class' => 'form-control',
                                    'placeholder' => 'Nome do Próprio Municipal'
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
                        <div class="row" id="gam-interna-div" style="display:none;">
                            <label class="form-label">Nº da GAM</label>
                            <?= $this->Form->control('gam_interna', [
                                'type' => 'text',
                                'label' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nº da GAM'
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
                            'empty' => ' '
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
                
                <div class="col-md-12" id="tipo-poda-div" style="display:none;">
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="form-label">Tipo de Poda</label>
                            <?= $this->Form->control('tipo_poda', [
                                'type' => 'select',
                                'options' => [
                                    'CONDUCAO' => 'CONDUÇÃO',
                                    'LIMPEZA' => 'LIMPEZA',
                                    'LEVANTAMENTO' => 'LEVANTAMENTO DE COPA',
                                    'ADEQUACAO' => 'ADEQUAÇÃO OU REBAIXAMENTO DE COPA - ACENTUADA (RADICAL) AUTORIZADA',
                                    'ACENTUADA' => 'PODA ACENTUADA (RADICAL)'
                                ],
                                'class' => 'form-control',
                                'id' => 'tipo-poda-select',
                                'label' => false,
                                'empty' => 'Selecione o tipo de poda'
                            ]) ?>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Observação</label>
                            <textarea class="form-control" name="observacao_poda" id="observacao-poda" maxlength="2000" rows="3" readonly></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 d-flex align-items-center justify-content-start flex-wrap mt-3" id="substituicao-div" style="display:none;">
                    <div class="col-md-3">
                        <label class="form-label">Substituição</label>
                        <div class="d-flex form-check align-items-center justify-content-between flex-wrap gap-28">
                            <?= $this->Form->control('substituicao', [
                                'type' => 'radio',
                                'options' => [
                                    'sim' => 'Sim',
                                    'nao' => 'Não'
                                ],
                                'label' => false,
                                'templates' => [
                                    'nestingLabel' => '<div class="d-flex justify-content-start align-items-center gap-1">{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></div>'
                                ],
                                'class' => 'form-check-input'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-3" id="laudo-div">
                        <label class="form-label">Laudo Pendente</label>
                        <div class="d-flex form-check align-items-center justify-content-between flex-wrap gap-28">
                            <?= $this->Form->control('laudo_pendente', [
                                'type' => 'radio',
                                'options' => [
                                    'sim' => 'Sim',
                                    'nao' => 'Não'
                                ],
                                'label' => false,
                                'templates' => [
                                    'nestingLabel' => '<div class="d-flex justify-content-start align-items-center gap-1">{{hidden}}{{input}} <label{{attrs}}>{{text}}</label></div>'
                                ],
                                'class' => 'form-check-input'
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card-header border-bottom bg-base py-16 px-24">
                <h6 class="text-lg fw-semibold mb-0">Dados do Munícipe</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12 d-flex align-items-start justify-content-between flex-wrap">
                    <div class="col-md-5">
                        <label class="form-label">Nome do Solicitante (Opcional)</label>
                        <?= $this->Form->control('nome_solicitante', [
                            'type' => 'text',
                            'label' => false,
                            'class' => 'form-control',
                            'placeholder' => 'Nome completo do solicitante'
                        ]) ?>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Telefone do Solicitante (Opcional)</label>
                        <?= $this->Form->control('telefone_solicitante', [
                            'type' => 'text',
                            'label' => false,
                            'class' => 'form-control',
                            'placeholder' => '(DDD) 99999-9999'
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
                            'required' => true,
                            'class' => 'form-control',
                            'id' => 'cep'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Logradouro</label>
                        <?= $this->Form->control('logradouro', [
                            'type' => 'text',
                            'required' => true,
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
                            'required' => true,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Sub Bairro:</label>
                        <?= $this->Form->control('subbairro', [
                            'type' => 'text',
                            'required' => true,
                            'label' => false,
                            'class' => 'form-control',
                            'id' => 'subbairro'
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Bairro:</label>
                        <?= $this->Form->control('bairro', [
                            'type' => 'select',
                            'options' => [
                                'ALTO DA SERRA' => 'ALTO DA SERRA',
                                'ALVES DIAS' => 'ALVES DIAS',
                                'ANCHIETA' => 'ANCHIETA',
                                'ASSUNCAO' => 'ASSUNCAO',
                                'BAETA NEVES' => 'BAETA NEVES',
                                'BALNEARIA' => 'BALNEARIA',
                                'BATISTINI' => 'BATISTINI',
                                'BOTUJURU' => 'BOTUJURU',
                                'CAPIVARI' => 'CAPIVARI',
                                'CENTRO' => 'CENTRO',
                                'COOPERATIVA' => 'COOPERATIVA',
                                'CURUCUTU' => 'CURUCUTU',
                                'DEMARCHI' => 'DEMARCHI',
                                'DOS ALVARENGAS' => 'DOS ALVARENGAS',
                                'DOS CASAS' => 'DOS CASAS',
                                'DOS FINCO' => 'DOS FINCO',
                                'FERRAZOPOLIS' => 'FERRAZOPOLIS',
                                'IMIGRANTES' => 'IMIGRANTES',
                                'INDEPENDENCIA' => 'INDEPENDENCIA',
                                'JORDANOPOLIS' => 'JORDANOPOLIS',
                                'MONTANHAO' => 'MONTANHAO',
                                'NOVA PETROPOLIS' => 'NOVA PETROPOLIS',
                                'PAULICEIA' => 'PAULICEIA',
                                'PLANALTO' => 'PLANALTO',
                                'RIO GRANDE' => 'RIO GRANDE',
                                'RIO PEQUENO' => 'RIO PEQUENO',
                                'RUDGE RAMOS' => 'RUDGE RAMOS',
                                'SANTA CRUZ' => 'SANTA CRUZ',
                                'SANTA TEREZINHA' => 'SANTA TEREZINHA',
                                'TABOAO' => 'TABOAO',
                                'TAQUACETUBA' => 'TAQUACETUBA',
                                'TATETOS' => 'TATETOS',
                                'VARGINHA' => 'VARGINHA',
                                'ZANZALA' => 'ZANZALA'
                            ],
                            'label' => false,
                            'class' => 'form-control',
                            'id' => 'bairro',
                            'empty' => 'Selecione o bairro'
                        ]) ?>
                    </div>
                </div>
                <div class="col-md-12 d-flex align-items-start justify-content-between flex-wrap mt-28">
                    <div class="col-md-5">
                        <label class="form-label">Imagem do Local </label>
                        <?= $this->Form->control('imagem_local', [
                            'type' => 'file',
                            'required' => true,
                            'label' => false,
                            'class' => 'form-control form-control-sm'
                        ]) ?>
                         <div id="laudo-pdf-div" style="display:none;">
                            <label class="form-label">Laudo em PDF</label>
                            <?= $this->Form->control('laudo_pdf', [
                                'type' => 'file',
                                'label' => false,
                                'class' => 'form-control form-control-sm'
                            ]) ?>
                        </div>
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
        // Máscaras
        $("#cep").mask("99999-999");
        $("#telefone_solicitante").mask("(99) 99999-9999");
        
        // Auto-complete CEP
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
                            $("#bairro").val(data.bairro);
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
                $("#bairro").val('');
            }
        });

        // Mostrar/ocultar divs de serviço
        let serviceContainer = $("#poda-div");
        if (serviceContainer.length) {
            hideAllServiceDivs();
            
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
                    if(confirm('Você fez uma requisição do tipo Emergência. Neste caso algumas equipes irão paralisar os serviços e se deslocarão a este local. Confirma esse tipo de atendimento?')) {
                        generateEmergencyNumber();
                        $("#quantidade-arvores").val('1');
                        $("#data-solicitacao").val(new Date().toISOString().split('T')[0]);
                        $("#servico-selecionado").val('Liberacao de Via');
                    } else {
                        $(this).prop('checked', false);
                        $("input[name='servico']").first().prop('checked', true).change();
                    }
                }
                else {
                    $("#numero-solicitacao-emergencia").val('').change();
                }
                
                // Atualizar opções de serviço disponíveis
                atualizarOpcoesServico();
            });
            
            function hideAllServiceDivs() {
                serviceContainer.children("div[id$='-div']").hide();
            }
        }
        
        // Gera número de emergência
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
        
        // Controlar opções disponíveis no select de serviço
        function atualizarOpcoesServico() {
            const servicoSelecionado = $("input[name='servico']:checked").attr("id");
            const selectServico = $("#servico-selecionado");
            
            // Salvar o valor selecionado atual
            const valorAtual = selectServico.val();
            
            // Limpar e adicionar opções baseadas no serviço selecionado
            selectServico.empty().append('<option value=""> </option>');
            
            if (servicoSelecionado === "servico-emergencia") {
                selectServico.append('<option value="Liberacao de Via">Liberação de Via Pública</option>');
            } else {
                selectServico.append('<option value="Poda">Poda</option>');
                selectServico.append('<option value="Remocao">Remoção</option>');
                selectServico.append('<option value="Destoca">Destoca</option>');
                selectServico.append('<option value="Reparo de Passeio">Reparo de Passeio</option>');
                
                // Se estava selecionado "Liberação de Via" e não é mais permitido, limpar
                if (valorAtual === "Liberacao de Via") {
                    selectServico.val('');
                }
            }
            
            // Restaurar o valor selecionado se ainda estiver disponível
            if (valorAtual && selectServico.find("option[value='" + valorAtual + "']").length > 0) {
                selectServico.val(valorAtual);
            }
            
            // Disparar evento de change para atualizar outros campos
            selectServico.trigger('change');
        }
        
        // Mostrar/ocultar campos de GAM quando selecionar Frente de Garagem
        $("input[name^='atendimento_']").on("change", function() {
            let name = $(this).attr("name");
            let service = name.replace("atendimento_", "");
            let value = $(this).val();
            
            if (service === "memorando" || service === "interna") {
                if (value === "proprio") {
                    $("#proprio-" + service + "-div").show();
                    $("#secretaria" + (service === "memorando" ? "_memorando" : "")).closest(".row").hide();
                } else {
                    $("#proprio-" + service + "-div").hide();
                    $("#secretaria" + (service === "memorando" ? "_memorando" : "")).closest(".row").show();
                }
            }
            
            if (value === "garagem") {
                $("#gam-" + service + "-div").show();
            } else {
                $("#gam-" + service + "-div").hide();
            }
        });
        
        // Mostrar/ocultar tipo de poda quando selecionar Poda
        $("#servico-selecionado").on("change", function() {
            let value = $(this).val();
                       
            if (value === "Poda") {
                $("#tipo-poda-div").show();
                $("#substituicao-laudo-div").hide();
                $("#laudo-div").hide();
                $("#laudo-pdf-div").hide();
            } 
            else if (value === "Remocao") {
                $("#tipo-poda-div").hide();
                $("#substituicao-laudo-div").show();
                $("#substituicao-div").show();
                $("#laudo-div").show();
                // Reset laudo pendente selection
                $("input[name='laudo_pendente']").prop('checked', false);
                // Hide PDF upload since we reset the selection
                $("#laudo-pdf-div").hide();
            }
            else if (value === "Destoca") {
                $("#tipo-poda-div").hide();
                $("#substituicao-laudo-div").show();
                $("#substituicao-div").show();
                $("#laudo-div").hide();
                $("#laudo-pdf-div").hide();
            }
            else {
                $("#tipo-poda-div").hide();
                $("#laudo-div").hide();
                $("#substituicao-laudo-div").hide();
                $("#laudo-pdf-div").hide();
            }
        });
        
        // Atualizar observação do tipo de poda
        $("#tipo-poda-select").on("change", function() {
            let value = $(this).val();
            let textarea = $("#observacao-poda");
            
            switch(value) {
                case 'CONDUCAO':
                    textarea.val('1. DE CONDUÇÃO Com o objetivo de conduzir las plantas jovens em seu eixo de crescimento, retirando os ramos indesejáveis e ramificações baixas, direcionando o desenvolvimento da copa para os espaços disponíveis, sempre levando em consideração o modelo arquitetônico da espécie');
                    break;
                case 'LIMPEZA':
                    textarea.val('2. DE LIMPEZA Com o objetivo de remover galhos secos, doentes, praguejados ou infestados por ervas parasitas, improdutivos e ramos ladrões (epicórmicos), além da retirada de tocos e remanescentes de podas mal executadas.');
                    break;
                case 'LEVANTAMENTO':
                    textarea.val('3. DE LEVANTAMENTO DE COPA Com o objetivo de melhorar a visibilidade, fornecer espaço sob a copa, aumentar a segurança e prevenir a interferência do elemento arbóreo com o mobiliário urbano.');
                    break;
                case 'ADEQUACAO':
                    textarea.val('4. DE ADEQUAÇÃO OU REBAIXAMENTO DE COPA - ACENTUADA (RADICAL) AUTORIZADA Com o objetivo de adequar o elemento arbóreo ao seu ambiente, função ou propósito específico e solucionar problemas já causados ao mobiliário urbano, sinalização de trânsito, iluminação pública; OU para redução da altura da copa com o objetivo de mantê-la de 2 a 3 metros abaixo da fiação de rede elétrica primária. A depender do tipo, da densidade e do formato da copa, bem como da espécie do elemento arbóreo, poderá resultar em poda radical.');
                    break;
                case 'ACENTUADA':
                    textarea.val('5. PODA ACENTUADA (RADICAL) Com o objetivo recuperação de árvores em condições fitossanitárias de saúde precária ou de reduzir a incidência dos ventos sobre o tronco eliminando o risco de queda ou o risco de vida dos transeuntes.');
                    break;
                default:
                    textarea.val('');
            }
        });
        
        // Mostrar/ocultar upload de laudo
        $("input[name='laudo_pendente']").on("change", function() {
            if ($(this).val() === "nao") {
                $("#laudo-pdf-div").show();
            } else {
                $("#laudo-pdf-div").hide();
            }
        });
        
        // Validação do formulário
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    const servicoSelecionado = $("input[name='servico']:checked").attr("id");
                    const tipoServico = $("#servico-selecionado").val();
                    
                    // Validar se Liberação de Via está sendo usada apenas em emergências
                    if (tipoServico === "Liberacao de Via" && servicoSelecionado !== "servico-emergencia") {
                        alert("A opção 'Liberação de Via Pública' só está disponível para solicitações de emergência.");
                        event.preventDefault();
                        event.stopPropagation();
                        return false;
                    }
                    
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })();
        
        // Inicializar o formulário
        atualizarOpcoesServico();
    });
</script>
<?php $this->end(); ?>
<?= $this->Flash->render() ?>