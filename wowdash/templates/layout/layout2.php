<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<?= $this->element('head') ?>


<body>
    <?= $this->fetch('content') ?>
 
   
    <?= $this->element('scripts') ?>
    <?= $this->fetch('script') ?>
    <div id="page-loader">
      <div class="spinner"></div>
    </div>
</body>

</html>