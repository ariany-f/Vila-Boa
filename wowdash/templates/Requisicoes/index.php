<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\RequisicoesLog> $requisicoesLogs
 */
?>
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <span class="text-md fw-medium text-secondary-light mb-0">Mostrar</span>
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
                <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Pesquisar">
                <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
            </form>
        </div>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="requisicoesTable">
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-10">
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input radius-4 border input-form-dark" type="checkbox" name="checkbox" id="selectAll">
                                </div>
                                ID
                            </div>
                        </th>
                        <th scope="col">Payload</th>
                        <th scope="col">Status</th>
                        <th scope="col">Data de Criação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requisicoesLogs as $log): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-10">
                                    <div class="form-check style-check d-flex align-items-center">
                                        <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                                    </div>
                                    <?= h($log->id) ?>
                                </div>
                            </td>
                            <td><?= h($log->payload) ?></td>
                            <td><?= h($log->status) ?></td>
                            <td><?= h($log->created->format('d/m/Y H:i')) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?= $this->Flash->render() ?>
    </div>
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
