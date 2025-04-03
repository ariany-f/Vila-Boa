<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
  <?= $this->element('head') ?>
  <body>
    <?= $this->element('sidebar') ?>
    <main class="dashboard-main">
      <?= $this->element('navbar') ?>
            <!-- Breadcrumb e abertura da div dashboard main body -->
            <?php if ($this->request->getUri()->getPath() !== '/') : ?>
              <div class="dashboard-main-body">
                <?= $this->element('breadcrumb') ?>
            <?php else: ?>      
              <div>
            <?php endif; ?>
            <!-- /Breadcrumb -->

            <?= $this->fetch('content') ?>
        </div>

      <?= $this->element('footer') ?> 
    </main>
    <?= $this->element('scripts') ?>
    
    <!-- This is a comment about fetching the 'script' block -->
    <?= $this->fetch('script') ?>
    <div id="page-loader">
      <div class="spinner"></div>
    </div>
  </body>
</html>
