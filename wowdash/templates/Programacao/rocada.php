<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\resultado> $resultados
 */
?>
<div class="card h-100 p-0 radius-12">
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="resultadosTable">
                <thead>
                    <tr>
                        <th scope="col">Equipe</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Serviços</th>
                        <th scope="col">Observação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($resultados)) : ?>
                        <?php foreach ($resultados as $resultado): ?>
                            <tr>		
                                <td><?= h($resultado['age_name']) ?></td>
                                <td>
                                    <p class="max-w-500-px"><?= h($resultado['loc_description']) ?></p>
                                </td>
                                <td>
                                    <p class="max-w-500-px"><?= h($resultado['e_servicos']) ?></p>
                                </td>
                                <td>
                                    <p class="max-w-500-px"><?= h($resultado['tsk_observation']) ?></p>
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
    <!-- Renderiza o conteúdo do add.php dentro do index.php -->
    <?php //echo $this->element('resultados/add', ['resultado' => $resultado]) ?>
</div>


<?php $this->start('script'); ?>
<script>
    $(document).ready(function() {
        let table = $('#resultadosTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= $this->Url->build(['controller' => 'Programacao', 'action' => 'rocada']) ?>",
                "type": "GET",
                "data": function(d) {
                    // Verifica se o botão de exportação foi clicado e ajusta a requisição
                    if ($('#LoadAll').val() === 'True') {
                        d.export = true; // Adiciona parâmetro para exportação de todos os registros
                    }
                }
            },
            "columns": [
                { "data": "age_name" },
                { "data": "loc_description" },
                { "data": "e_servicos" },
                { "data": "tsk_observation" }
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
            "layout": {
                "topStart": {
                    "buttons": [
                        {
                            "extend": "excel",
                            "text": '<iconify-icon icon="ri:file-excel-2-line" class="icon"></iconify-icon> <p>Excel</p>', // Ícone do Excel (Font Awesome)
                            "titleAttr": 'Exportar XLS',
                            "className": 'text-secondary-light d-flex',
                            "filename": 'Programação Roçada',
                            "title": 'Progração Roçada',
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
                            "filename": 'Programação Roçada',
                            "title": 'Progração Roçada',
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
    });
</script>
<?php $this->end(); ?>