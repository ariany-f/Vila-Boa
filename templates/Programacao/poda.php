<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\resultado> $resultados
 */
?>
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
            <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
            </select>
            <form class="navbar-search">
                <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
            </form>
        </div>
    </div>

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
                </tbody>
            </table>
        </div>
        
        <?= $this->Flash->render() ?>
    </div>
    <!-- Renderiza o conteúdo do add.php dentro do index.php -->
    <?php //echo $this->element('resultados/add', ['resultado' => $resultado]) ?>
</div>


<?php $this->start('script'); ?>
<script>
    $(document).ready(function() {
        $('.remove-item-btn').on('click', function () {
            $(this).closest('tr').addClass('d-none');
        });
    });
</script>
<?php $this->end(); ?>