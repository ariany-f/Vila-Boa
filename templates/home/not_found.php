
<div class="card basic-data-table">
    <div class="card-body py-80 px-32 text-center">
        <img src="<?= $this->Url->assetUrl('assets/images/error-img.png') ?>" alt="" class="mb-24">
        <h6 class="mb-16">Page not Found</h6>
        <p class="text-secondary-light">Sorry, the page you are looking for doesn’t exist </p>
        <a href="<?= $this->Url->build(['_name' => 'index']) ?>" class="btn btn-primary-600 radius-8 px-20 py-11">Back to Home</a>
    </div>
</div>


<?php $this->start('script'); ?><script>let table = new DataTable('#dataTable');</script><?php $this->end(); ?>