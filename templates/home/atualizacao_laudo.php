<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\resultado> $resultados
 */
?>
<div class="card h-100 p-0 radius-12">
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="atualizacaoTable">
                <thead>
                    <tr>
                        <th scope="col">Data da Solicitação</th>
                        <th scope="col">Tipo de Atendimento</th>
                        <th scope="col">Local da Solicitação</th>
                        <th scope="col">Bairro</th>
                        <th scope="col">Ações Necessárias</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($resultados)) : ?>
                        <?php foreach ($resultados as $resultado): ?>
                            <tr>		
                                <td><p class="max-w-500-px"><?= h($resultado['loc_datetimeinsert'] ? date('d/m/Y', strtotime($resultado['loc_datetimeinsert'])) : '') ?></p></td>
                                <td><p class="max-w-500-px"><?= h($resultado['e_tipoatendimento']) ?></p></td>
                                <td><p class="max-w-500-px"><?= h($resultado['loc_description']) ?></p></td>
                                <td><p class="max-w-500-px"><?= h($resultado['e_bairro']) ?></p></td>
                                <td><p class="max-w-500-px"><?= h($resultado['e_acoesnecessarias']) ?></p></td>
                                <td>
                                    <button class="btn btn-sm btn-primary btn-atualizar" 
                                            data-loc-id="<?= h($resultado['loc_id']) ?>"
                                            data-loc-desc="<?= h($resultado['loc_description']) ?>">
                                        Atualizar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <?= $this->Flash->render() ?>
    </div>
    <div id="LoadAll"></div>
</div>

<!-- Modal para Atualizar Laudo -->
<div class="modal fade" id="atualizarLaudoModal" tabindex="-1" aria-labelledby="atualizarLaudoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="atualizarLaudoModalLabel">Atualizar Laudo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAtualizarLaudo">
                    <input type="hidden" id="locId">
                    <div class="mb-3">
                        <label class="form-label">Local:</label>
                        <p id="locDescriptionDisplay" class="form-control-static"></p>
                    </div>
                    <div class="mb-3">
                        <label for="statusLaudo" class="form-label">Status</label>
                        <select class="form-select" id="statusLaudo" required>
                            <option value="">Selecione o status</option>
                            <option value="pendente">Pendente</option>
                            <option value="em_andamento">Em Andamento</option>
                            <option value="concluido">Concluído</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="observacoes" class="form-label">Observações</label>
                        <textarea class="form-control" id="observacoes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="salvarAtualizacao">Salvar</button>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    $(document).ready(function() {
        let table = $('#atualizacaoTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= $this->Url->build(['name' => 'Laudo']) ?>",
                "type": "GET",
                "data": function(d) {
                    d.search = d.search.value;
                    d.start = d.start;
                    d.length = d.length;
                    d.draw = d.draw;
                    
                    if ($('#LoadAll').val() === 'True') {
                        d.export = true;
                        d.length = -1;
                    }
                },
                "dataSrc": function(json) {
                    // Formata a data antes de exibir
                    json.data.forEach(function(item) {
                        if (item.loc_datetimeinsert) {
                            var date = new Date(item.loc_datetimeinsert);
                            item.loc_datetimeinsert = date.toLocaleDateString('pt-BR');
                        }
                    });
                    return json.data;
                }
            },
            "columns": [
                { "data": "loc_datetimeinsert" },
                { "data": "e_tipoatendimento" },
                { "data": "loc_description" },
                { "data": "e_bairro" },
                { "data": "e_acoesnecessarias" },
                { 
                    "data": "loc_id",
                    "render": function(data, type, row) {
                        return '<button class="btn btn-sm btn-primary btn-atualizar" data-loc-id="' + data + '" data-loc-desc="' + row.loc_description + '">  <iconify-icon icon="tabler:refresh"></iconify-icon></button>';
                    }
                }
            ],
            "pageLength": 10,
            "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]],
            "language": {
                "search": "",
                "processing": "Carregando...",
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nenhum resultado encontrado",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
                "loadingRecords": "",
                "emptyTable": "Nenhum dado disponível na tabela"
            },
            "columnDefs": [
                {
                    "targets": 0,
                    "width": "150px",
                    "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).html('<p class="max-w-150-px">' + cellData + '</p>');
                    }
                },
                {
                    "targets": 1,
                    "width": "150px",
                    "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).html('<p class="max-w-150-px">' + cellData + '</p>');
                    }
                },
                {
                    "targets": 2,
                    "width": "290px",
                    "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).html('<p class="max-w-290-px">' + cellData + '</p>');
                    }
                },
                {
                    "targets": 4,
                    "width": "150px",
                    "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).html('<p class="max-w-150-px">' + cellData + '</p>');
                    }
                }
            ],
            "layout": {
                "topStart": {
                    "buttons": [
                        {
                            "extend": "excel",
                            "text": '<iconify-icon icon="ri:file-excel-2-line" class="icon"></iconify-icon> <p>Excel</p>',
                            "titleAttr": 'Exportar XLS',
                            "className": 'text-secondary-light d-flex',
                            "filename": 'Programação Diversos',
                            "title": 'Progração Diversos',
                            "action": function (e, dt, node, config) {
                                $('#LoadAll').val('True');
                                table.ajax.reload(function (json) {
                                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, node, config);
                                    $(".buttons-excel").removeClass('processing');
                                    $('#LoadAll').val('False');
                                    table.page.len(10).draw();
                                });
                            }
                        },
                        {
                            "extend": 'pdf',
                            "orientation": 'landscape',
                            "className": 'text-secondary-light d-flex',
                            "pageSize": 'A4',
                            "text": '<iconify-icon icon="ri:file-pdf-2-line" class="icon"></iconify-icon> <p>PDF</p>',
                            "titleAttr": 'Exportar PDF',
                            "filename": 'Programação Diversos',
                            "title": 'Progração Diversos',
                            "action": function (e, dt, node, config) {
                                $('#LoadAll').val('True');
                                table.ajax.reload(function (json) {
                                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, node, config);
                                    $(".buttons-pdf").removeClass('processing');
                                    $('#LoadAll').val('False');
                                    table.page.len(10).draw();
                                });
                            }
                        }
                    ]
                }
            }
        });

        // Abre modal quando clicar em qualquer botão Atualizar
        $(document).on('click', '.btn-atualizar', function() {
            var locId = $(this).data('loc-id');
            var locDesc = $(this).data('loc-desc');
            
            $('#locId').val(locId);
            $('#locDescriptionDisplay').text(locDesc);
            $('#atualizarLaudoModal').modal('show');
        });

        $('#salvarAtualizacao').click(function() {
            var locId = $('#locId').val();
            var status = $('#statusLaudo').val();
            var observacoes = $('#observacoes').val();
            
            // Aqui você pode adicionar a chamada AJAX para salvar os dados
            console.log("Dados para salvar:", {
                loc_id: locId,
                status: status,
                observacoes: observacoes
            });
            
            // Fecha o modal após salvar
            $('#atualizarLaudoModal').modal('hide');
            
            // Limpa o formulário
            $('#formAtualizarLaudo')[0].reset();
        });

        // Conectar input de busca ao DataTable
        $('.navbar-search input[name="search"]').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Conectar seletor de número de itens ao DataTable
        $('.form-select').on('change', function() {
            table.page.len($(this).val()).draw();
        });
    });
</script>
<?php $this->end(); ?>