<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Relatorio $relatorio
 */
?>
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card position-relative border radius-16 overflow-hidden bg-base h-100">
            <div class="card-header">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="side-nav">
                        <?= $this->Html->link(__('Voltar para Relatórios'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                    </div>
                    <?= $this->Form->postLink(
                        __('Excluir'),
                        ['action' => 'delete', $relatorio->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $relatorio->id), 'class' => 'btn btn-sm btn-danger radius-8 d-inline-flex align-items-center gap-1']
                    ) ?>
                </div>
            </div>
            <div class="card-body py-40">
                <div class="row">
                    <?= $this->Form->create($relatorio) ?>
                    <fieldset>
                        <?php
                            echo $this->Form->control('titulo', ['class' => 'form-control radius-8']);
                            echo $this->Form->control('descricao', ['class' => 'form-control radius-8']);
                            echo $this->Form->control('link_iframe', ['class' => 'form-control radius-8']);
                        ?>
                    </fieldset>
                    <div class="col-sm-12">
                        <div class="mt-24 d-flex justify-content-end">
                            <?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-primary btn-sm']) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>