<!-- Modal Start -->
<div class="modal fade" id="addRelatorioModal" tabindex="-1" aria-labelledby="addRelatorioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="addRelatorioModalLabel">Adicionar Relatório</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <?= $this->Form->create($relatorio, [
                        'url' => ['controller' => 'Relatorios', 'action' => 'add', 'relatorio' => $relatorio],
                        'id' => 'addRelatorioForm'
                    ]) ?>
                    <div class="row">
                        <div class="col-12 mb-20">
                            <input type="text" name="titulo" class="form-control radius-8" placeholder="Nome do Relatório">
                        </div>
                        <div class="col-12 mb-20">
                            <textarea class="form-control" id="desc" name="descricao" rows="4" cols="50" placeholder="Descrição"></textarea>
                        </div>
                        <div class="col-12 mb-20">
                            <input type="text" name="link_iframe" class="form-control radius-8" placeholder="Link">
                        </div>
                        <div class="d-flex align-items-center gap-3 mt-24 justify-content-end">
                            <button type="submit" class="btn btn-primary border border-primary-600 text-md px-48 py-12 radius-8">
                                Salvar
                            </button>
                        </div>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->