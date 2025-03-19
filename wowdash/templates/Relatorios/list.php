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
                            <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                            <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                        </form>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="text-secondary-light line-height-1">1-12 of 1,253</span>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link d-flex bg-base border text-secondary-light text-xl" href="javascript:void(0)">
                                        <iconify-icon icon="iconamoon:arrow-left-2" class="icon"></iconify-icon>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link d-flex bg-base border text-secondary-light text-xl" href="javascript:void(0)">
                                        <iconify-icon icon="iconamoon:arrow-right-2" class="icon"></iconify-icon>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="overflow-x-auto">
                    <?php foreach ($relatorios as $relatorio): ?>
                        <li class="email-item px-24 py-16 d-flex gap-4 align-items-center border-bottom cursor-pointer bg-hover-neutral-200 min-w-max-content ">
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox">
                            </div>
                            <a href="<?= $this->Url->build(['_name' => 'viewRelatorio', 'id' => $relatorio->id]) ?>" 
                                class="text-primary-light fw-medium text-md text-line-1 w-190-px">
                                <?= h($relatorio->titulo) ?>
                            </a>

                            <a href="<?= $this->Url->build(['_name' => 'viewRelatorio', 'id' => $relatorio->id]) ?>" 
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
    // Table Header Checkbox checked all js Start
    $('#selectAll').on('change', function () {
        $('.form-check .form-check-input').prop('checked', $(this).prop('checked'));

        if ($(this).prop('checked')) {
            $('.email-item').addClass('active');
        } else {
            $('.email-item').removeClass('active');
        }
    });

    // Active Item with js
    $('.form-check .form-check-input').on('change', function () {
        if ($(this).is(':checked')) {
            $(this).closest('.email-item').addClass('active');
        } else {
            $(this).closest('.email-item').removeClass('active');
        }
    });

    // Selected Checkbox count amount js Start
    $('.email-card .form-check-input').on('change', function () {
        let selectedCount = $('.email-card .form-check-input:checked').length;

        if (selectedCount > 0) {
            $('.delete-button').removeClass('d-none');
        } else {
            $('.delete-button').addClass('d-none')
        }
    });
    // Selected Checkbox count amount js End

    $('.delete-button').on('click', function () {
        $('.email-item.active').addClass('d-none')
    });

    // Page Reload Js
    $('.reload-button').on('click', function () {
        history.go(0);
    });

    // Starred Button js
    $('.starred-button').on('click', function () {
        $(this).toggleClass('active')
    });
</script>
<?php $this->end(); ?>
