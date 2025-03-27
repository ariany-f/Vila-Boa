<div class="row gy-4">
    <div class="col-xxl-12">
        <div class="card h-100 p-0 email-card">
            <div class="card-header border-bottom bg-base py-16 px-24">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input radius-4 border input-form-dark" type="checkbox" name="checkbox" id="selectAll">
                        </div>
                        <button type="button" class="delete-button d-none text-secondary-light text-xl d-flex">
                            <iconify-icon icon="material-symbols:delete-outline" class="icon line-height-1"></iconify-icon>
                        </button>
                        <button type="button" class="reload-button text-secondary-light text-xl d-flex">
                            <iconify-icon icon="tabler:reload" class="icon"></iconify-icon>
                        </button>
                        <form class="navbar-search d-lg-block d-none">
                            <input type="text" class="bg-base h-40-px w-auto" name="search" id="searchInput" placeholder="Search">
                            <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <ul id="relatorioList" class="overflow-x-auto">
                    <?php foreach ($relatorios as $relatorio): ?>
                        <li class="email-item px-24 py-16 gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content "
                        style="display: flex;" 
                        data-titulo="<?= h($relatorio->titulo) ?>"> 
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                            </div>
                            <a target="_blank" href="<?= h($relatorio->link_iframe) ?>" 
                                class="text-primary-light fw-medium text-md text-line-1 w-190-px">
                                <?= h($relatorio->titulo) ?>
                            </a>

                            <a target="_blank" href="<?= h($relatorio->link_iframe) ?>" 
                                class="text-primary-light fw-medium mb-0 text-line-1 max-w-740-px">
                                <?= h($relatorio->link_iframe) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>



<?php $this->start('script'); ?>
    <script>

    // Search functionality
    $('#searchInput').on('input', function () {
        var searchQuery = $(this).val().toLowerCase();  // Pega o texto da pesquisa
       
        $('#relatorioList .email-item').each(function () {
            var titulo = $(this).data('titulo').toLowerCase();  // Pega o título de cada item
            if (titulo.indexOf(searchQuery) !== -1) {
                $(this).attr('style', 'display: flex!important;');  // Mostra o item se ele corresponder à pesquisa
            } else {
                $(this).attr('style', 'display: none!important;'); 
            }
        });
    });

    // Page Reload Js
    $('.reload-button').on('click', function () {
        history.go(0);
    });

</script>
<?php $this->end(); ?>
