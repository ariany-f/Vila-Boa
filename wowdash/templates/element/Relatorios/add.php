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
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Nome do Relatório</label>
                            <input type="text" name="titulo" class="form-control radius-8" placeholder="Enter Titulo">
                        </div>
                        <div class="col-12 mb-20">
                            <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Descrição</label>
                            <textarea class="form-control" id="desc" name="descricao" rows="4" cols="50" placeholder="Write some text"></textarea>
                        </div>
                        <div class="col-12 mb-20">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Link</label>
                            <input type="text" name="link_iframe" class="form-control radius-8" placeholder="Insert Link">
                        </div>
                        <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                            <button type="reset" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary border border-primary-600 text-md px-48 py-12 radius-8">
                                Save
                            </button>
                        </div>
                    </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->