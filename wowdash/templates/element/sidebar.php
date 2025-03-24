<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="<?= $this->Url->build(['_name' => 'index']) ?>" class="sidebar-logo">
            <img src="<?= $this->Url->assetUrl('assets/images/logo.png') ?>" alt="site logo" class="light-logo">
            <img src="<?= $this->Url->assetUrl('assets/images/logo-light.png') ?>" alt="site logo" class="dark-logo">
            <img src="<?= $this->Url->assetUrl('assets/images/logo-icon.png') ?>" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
        <?php foreach ($menus as $menu): ?>
                <li class="<?= ($menu->has('child_menus') && !empty($menu->child_menus)) ? 'dropdown' : '' ?>" data-menu-id="<?= h($menu->id) ?>">
                    <a href="<?= ($menu->has('child_menus') && !empty($menu->child_menus)) ? 'javascript:void(0)' : $this->Url->build($menu->url) ?>">
                        <?php if ($menu->icon): ?>
                            <iconify-icon icon="mage:<?= h($menu->icon) ?>" class="menu-icon"></iconify-icon>
                        <?php endif; ?>
                        <span><?= h($menu->name) ?></span>
                    </a>
                    <?php if ($menu->has('child_menus')): ?>
                        <ul class="sidebar-submenu">
                            <?php foreach ($menu->child_menus as $childMenu): ?>
                                <li>
                                    <a href="<?= $this->Url->build($childMenu->url) ?>">
                                        <?php if ($childMenu->icon): ?>
                                            <i class="ri-circle-fill circle-icon <?= h($childMenu->icon_class) ?>"></i>
                                        <?php endif; ?>
                                            <?= h($childMenu->name) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>