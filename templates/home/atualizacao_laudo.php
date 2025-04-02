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
                        <th scope="col">Id do Local</th>
                        <th scope="col">Local da Solicitação</th>
                        <th scope="col">Bairro</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações Necessárias</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($resultados)) : ?>
                        <?php foreach ($resultados as $resultado): ?>
                            <tr>		
                                <td><p class="max-w-500-px"><?= h($resultado['loc_datetimeinsert']) ?></p></td>
                                <td><p class="max-w-500-px"><?= h($resultado['e_tipoatendimento']) ?></p></td>
                                <td><p class="max-w-500-px"><?= h($resultado['loc_id']) ?></p></td>
                                <td><p class="max-w-500-px"><?= h($resultado['loc_description']) ?></p></td>
                                <td><p class="max-w-500-px"><?= h($resultado['e_bairro']) ?></p></td>
                                <td><p class="max-w-500-px"><?= h($resultado['tsk_situation']) ?></p></td>
                                <td><p class="max-w-500-px"><?= h($resultado['e_acoesnecessarias']) ?></p></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <?= $this->Flash->render() ?>
    </div>
    <div id="LoadAll"></div>
    <!-- Renderiza o conteúdo do add.php dentro do index.php -->
    <?php //echo $this->element('resultados/add', ['resultado' => $resultado]) ?>
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
                <!-- Conteúdo do formulário para atualizar o laudo -->
                <form id="formAtualizarLaudo">
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
                    // Adiciona parâmetros necessários para o servidor
                    d.search = d.search.value;
                    d.start = d.start;
                    d.length = d.length;
                    d.draw = d.draw;
                    
                    if ($('#LoadAll').val() === 'True') {
                        d.export = true;
                        d.length = -1; // Retorna todos os registros
                    }
                },
                "dataSrc": function(json) {
                    console.log(json)
                    // Ajusta a resposta para o formato esperado pelo DataTables
                    return json.data;
                }
            },
            "columns": [
                { "data": "loc_datetimeinsert" },
                { "data": "e_tipoatendimento" },
                { "data": "loc_id" },
                { "data": "loc_description" },
                { "data": "e_bairro" },
                { "data": "tsk_situation" },
                { "data": "e_acoesnecessarias" }
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
                    "targets": 0, // Coluna de descrição (índice 3)
                    "width": "150px", // Forçar largura de 500px
                    "createdCell": function(td, cellData, rowData, row, col) {
                        // Adicionar a tag <p class="max-w-500-px"> ao conteúdo da célula
                        $(td).html('<p class="max-w-150-px">' + cellData + '</p>');
                    }
                },
                {
                    "targets": 3, // Coluna de descrição (índice 3)
                    "width": "290px", // Forçar largura de 500px
                    "createdCell": function(td, cellData, rowData, row, col) {
                        // Adicionar a tag <p class="max-w-500-px"> ao conteúdo da célula
                        $(td).html('<p class="max-w-290-px">' + cellData + '</p>');
                    }
                },
                {
                    "targets": 6, // Coluna de descrição (índice 3)
                    "width": "290px", // Forçar largura de 500px
                    "createdCell": function(td, cellData, rowData, row, col) {
                        // Adicionar a tag <p class="max-w-500-px"> ao conteúdo da célula
                        $(td).html('<p class="max-w-290-px">' + cellData + '</p>');
                    }
                }
            ],
            "layout": {
                "topStart": {
                    "buttons": [
                        {
                            "extend": "excel",
                            "text": '<iconify-icon icon="ri:file-excel-2-line" class="icon"></iconify-icon> <p>Excel</p>', // Ícone do Excel (Font Awesome)
                            "titleAttr": 'Exportar XLS',
                            "className": 'text-secondary-light d-flex',
                            "filename": 'Programação Diversos',
                            "title": 'Progração Diversos',
                            "action": function (e, dt, node, config) {
                                // Marca que é para exportar todos os dados ao clicar no botão
                                $('#LoadAll').val('True');

                                // Recarrega os dados da tabela (pegando todos os registros)
                                table.ajax.reload(function (json) {
                                    // Agora, realiza a exportação
                                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, node, config);
                                    // Remove o estado de carregamento após a exportação
                                    $(".buttons-excel").removeClass('processing');

                                    $('#LoadAll').val('False');
                                    
                                    // Volta para 10 registros por página
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
                                // Marca que é para exportar todos os dados ao clicar no botão
                                $('#LoadAll').val('True');
                                
                                // Recarrega os dados da tabela (pegando todos os registros)
                                table.ajax.reload(function (json) {
                                    // Agora, realiza a exportação
                                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, node, config);

                                    // Remove o estado de carregamento após a exportação
                                    $(".buttons-pdf").removeClass('processing');

                                    $('#LoadAll').val('False');
                                    
                                    // Volta para 10 registros por página
                                    table.page.len(10).draw();
                                });
                            }
                        },
                        {
                            text: '<iconify-icon icon="ri:edit-2-line" class="icon"></iconify-icon> <p>Atualizar Laudo</p>',
                            className: 'text-secondary-light d-flex',
                            action: function (e, dt, node, config) {
                                // Abre o modal quando o botão é clicado
                                $('#atualizarLaudoModal').modal('show');
                            }
                        }
                    ]
                }
            }
        });

        // Conectar input de busca ao DataTable
        $('.navbar-search input[name="search"]').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Conectar seletor de número de itens ao DataTable
        $('.form-select').on('change', function() {
            let valor = $(this).val();
            table.page.len(valor).draw();
        });

        $('.remove-item-btn').on('click', function () {
            $(this).closest('tr').addClass('d-none');
        });

        $('#salvarAtualizacao').click(function() {
            // Aqui você pode adicionar a lógica para salvar os dados
            const status = $('#statusLaudo').val();
            const observacoes = $('#observacoes').val();
            
            // Exemplo de alerta (substitua por sua lógica de salvamento)
            alert(`Status: ${status}\nObservações: ${observacoes}`);
            
            // Fecha o modal após salvar
            $('#atualizarLaudoModal').modal('hide');
        });
    });
</script>
<?php $this->end(); ?>