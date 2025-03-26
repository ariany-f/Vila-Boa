<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\RequisicoesLog> $requisicoesLogs
 */
?>
<div class="card h-100 p-0 radius-12">
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="requisicoesTable">
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-10">
                                Identificador
                            </div>
                        </th>
                        <th scope="col">Payload</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">Origem</th>
                        <th scope="col">Status</th>
                        <th scope="col">Data de Criação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requisicoesLogs as $log): ?>
                        <tr class="payload-row" data-payload="<?= h($log->payload) ?>">
                            <td>
                                <div class="d-flex align-items-center gap-10">
                                    <?= h($log->id) ?>
                                </div>
                            </td>
                            <td><p alt="<?= h($log->payload) ?>" class="max-w-440-px max-h-100-px text-line-3"><?= h($log->payload) ?></p></td>
                            <td><?= h($log->user->name) ?></td>
                            <td><?= h($log->origem) ?></td>
                            <td><span class="bg-<?= h($log->status) == 'sucesso' ? 'success' : 'danger' ?>-focus text-<?= h($log->status) == 'sucesso' ? 'success' : 'danger' ?>-main px-24 py-4 rounded-pill fw-medium text-sm"><?= h($log->status) ?></span></td>
                            <td><?= h($log->created->format('d/m/Y H:i')) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?= $this->Flash->render() ?>
    </div>
</div>

<!-- Modal para exibir o payload completo -->
<div class="modal fade" id="payloadModal" tabindex="-1" aria-labelledby="payloadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="payloadModalLabel">Payload Completo</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <pre id="modalPayloadContent"></pre>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    $(document).ready(function() {
        $('#requisicoesTable').DataTable({
            "paging": true,        // Ativa paginação
            "searching": true,     // Ativa busca
            "processing": true,    // Ativa loading enquanto carrega
            "language": {
                "processing": "Carregando...",
                "search": "",
                "lengthMenu": "Mostrar _MENU_ registros",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Nenhum registro encontrado",
                "infoFiltered": "(filtrado de _MAX_ registros totais)"
            }
        });

        $('.remove-item-btn').on('click', function () {
            $(this).closest('tr').addClass('d-none');
        });
        
        // Evento para exibir o modal com o payload completo
        $('.payload-row').on('click', function () {
            let payloadCompleto = $(this).data('payload');
            $('#modalPayloadContent').text(payloadCompleto);
            $('#payloadModal').modal('show');
        });
    });
</script>
<?php $this->end(); ?>
