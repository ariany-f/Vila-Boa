<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Relatorio $relatorio
 */
?>
<div class="row gy-4">
    <div class="col-xxl-12">
        <div class="card h-100 p-0 email-card overflow-x-auto d-block">
            <div class="min-w-450-px d-flex flex-column justify-content-between h-100">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center gap-3 justify-content-between flex-wrap">
                    <div class="d-flex align-items-center gap-2">
                        <a href="<?= $this->Url->build(['_name' => 'listGerenciarRelatorios'])?>" class="d-flex align-items-center">
                            <button class="text-secondary-light d-flex me-8">
                                <iconify-icon icon="mingcute:arrow-left-line" class="icon fs-3 line-height-1"></iconify-icon>
                            </button>
                        </a>
                        <h6 class="mb-0 text-lg"><?= h($relatorio->titulo) ?></h6>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <button class="text-secondary-light d-flex">
                            <iconify-icon icon="mi:print" class="icon text-xxl line-height-1"></iconify-icon>
                        </button>
                        <button class="text-secondary-light d-flex">
                            <iconify-icon icon="mdi:star-outline" class="icon text-xxl line-height-1"></iconify-icon>
                        </button>
                        <button class="text-secondary-light d-flex">
                            <iconify-icon icon="material-symbols:delete-outline" class="icon text-xxl line-height-1"></iconify-icon>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="py-16 px-24 border-bottom">
                        <div class="content">
                            <?php if($relatorio->descricao): ?>
                                <div class="text">
                                    <strong><?= __('Descricao') ?></strong>
                                    <blockquote>
                                        <?= $this->Text->autoParagraph(h($relatorio->descricao)); ?>
                                    </blockquote>
                                </div>
                            <?php endif; ?>
                            
                            <iframe height="600px" width="100%" src="<?= $relatorio->link_iframe ?>"></iframe>
                        </div>
                    </div>
                </div>
                <div class="card-footer py-16 px-24 bg-base shadow-top">
                </div>
            </div>
        </div>
    </div>
</div>