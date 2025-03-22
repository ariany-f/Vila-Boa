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
                <li class="<?= ($menu->has('child_menus') && !empty($menu->child_menus)) ? 'dropdown' : '' ?>">
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
            <!-- <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'index']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> AI</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'index2']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> CRM</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'index3']) ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> eCommerce</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'index4']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Cryptocurrency</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'index5']) ?>"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Investment</a>
                    </li>

                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'index6']) ?>"><i class="ri-circle-fill circle-icon text-purple w-auto"></i> LMS</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'index7']) ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> NFT & Gaming</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'index8']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Medical</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'index9']) ?>"><i class="ri-circle-fill circle-icon text-purple w-auto"></i> Analytics</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'index10']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> POS & Inventory </a>
                    </li>

                </ul>
            </li>
            <li class="sidebar-menu-group-title">Application</li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'email']) ?>">
                    <iconify-icon icon="mage:email" class="menu-icon"></iconify-icon>
                    <span>Email</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'chat']) ?>">
                    <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
                    <span>Chat</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'calendar']) ?>">
                    <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
                    <span>Calendar</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'kanban']) ?>">
                    <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                    <span>Kanban</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="hugeicons:invoice-03" class="menu-icon"></iconify-icon>
                    <span>Invoice</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'invoiceList']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> List</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'preview']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Preview</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'addNew']) ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add new</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'edit']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Edit</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <i class="ri-robot-2-line  text-xl me-6 d-flex w-auto"></i>
                    <span>Ai Application</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'textGenerator']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Text Generator</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'codeGenerator']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Code Generator</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'imageGenerator']) ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Image Generator</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'voiceGenerator']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Voice Generator</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'videoGenerator']) ?>"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Video Generator</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <i class="ri-btc-line text-xl me-6 d-flex w-auto"></i>
                    <span>Crypto Currency</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'wallet']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Wallet</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'marketplace']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Marketplace</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'marketplaceDetails']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Marketplace Details</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'portfolio']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Portfolios</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-menu-group-title">UI Elements</li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:document-text-outline" class="menu-icon"></iconify-icon>
                    <span>Components</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'typography']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Typography</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'colors']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Colors</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'button']) ?>"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Button</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'dropdown']) ?>"><i class="ri-circle-fill circle-icon text-lilac-600 w-auto"></i> Dropdown</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'alerts']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Alerts</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'card']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Card</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'carousel']) ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Carousel</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'avatars']) ?>"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Avatars</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'progressbar']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Progress bar</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'tabAndAccordion']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Tab & Accordion</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'pagination']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Pagination</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'badges']) ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Badges</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'tooltip']) ?>"><i class="ri-circle-fill circle-icon text-lilac-600 w-auto"></i> Tooltip & Popover</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'videos']) ?>"><i class="ri-circle-fill circle-icon text-cyan w-auto"></i> Videos</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'starRatings']) ?>"><i class="ri-circle-fill circle-icon text-indigo w-auto"></i> Star Ratings</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'tags']) ?>"><i class="ri-circle-fill circle-icon text-purple w-auto"></i> Tags</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'list']) ?>"><i class="ri-circle-fill circle-icon text-red w-auto"></i> List</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'calendar']) ?>"><i class="ri-circle-fill circle-icon text-yellow w-auto"></i> Calendar</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'radio']) ?>"><i class="ri-circle-fill circle-icon text-orange w-auto"></i> Radio</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'switch']) ?>"><i class="ri-circle-fill circle-icon text-pink w-auto"></i> Switch</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'upload']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Upload</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="heroicons:document" class="menu-icon"></iconify-icon>
                    <span>Forms</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'inputForms']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Input Forms</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'inputLayout']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Input Layout</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'formValidation']) ?>"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Form Validation</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'formWizard']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Form Wizard</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="mingcute:storage-line" class="menu-icon"></iconify-icon>
                    <span>Table</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'basicTable']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Basic Table</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'dataTable']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Data Table</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="solar:pie-chart-outline" class="menu-icon"></iconify-icon>
                    <span>Chart</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'lineChart']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Line Chart</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'columnChart']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Column Chart</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'pieChart']) ?>"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Pie Chart</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'widgets']) ?>">
                    <iconify-icon icon="fe:vector" class="menu-icon"></iconify-icon>
                    <span>Widgets</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Users</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'usersList']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Users List</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'usersGrid']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Users Grid</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'addUser']) ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add User</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'viewProfile']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Perfil</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <i class="ri-user-settings-line text-xl me-6 d-flex w-auto"></i>
                    <span>Role & Access</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'roleAccess']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Role & Access</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'assignRole']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Assign Role</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-menu-group-title">Application</li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="simple-line-icons:vector" class="menu-icon"></iconify-icon>
                    <span>Authentication</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'signin']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Sign In</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'signup']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Sign Up</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'forgotPassword']) ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Forgot Password</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'gallery']) ?>">
                    <iconify-icon icon="solar:gallery-wide-linear" class="menu-icon"></iconify-icon>
                    <span>Gallery</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'pricing']) ?>">
                    <iconify-icon icon="hugeicons:money-send-square" class="menu-icon"></iconify-icon>
                    <span>Pricing</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <i class="ri-news-line text-xl me-6 d-flex w-auto"></i>
                    <span>Blog</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'blog']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Blog</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'blogDetails']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Blog Details</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'addBlog']) ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add Blog</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'testimonials']) ?>">
                    <i class="ri-star-line text-xl me-6 d-flex w-auto"></i>
                    <span>Testimonial</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'faqs']) ?>">
                    <iconify-icon icon="mage:message-question-mark-round" class="menu-icon"></iconify-icon>
                    <span>FAQs</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'notFound']) ?>">
                    <iconify-icon icon="streamline:straight-face" class="menu-icon"></iconify-icon>
                    <span>404</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'termsAndConditions']) ?>">
                    <iconify-icon icon="octicon:info-24" class="menu-icon"></iconify-icon>
                    <span>Terms & Conditions</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'comingsoon']) ?>">
                    <i class="ri-rocket-line text-xl me-6 d-flex w-auto"></i>
                    <span>Coming Soon</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'maintenance']) ?>">
                    <i class="ri-hammer-line text-xl me-6 d-flex w-auto"></i>
                    <span>Maintenance</span>
                </a>
            </li>
            <li>
                <a href="<?= $this->Url->build(['_name' => 'blankpage']) ?>">
                    <i class="ri-checkbox-multiple-blank-line text-xl me-6 d-flex w-auto"></i>
                    <span>Blank Page</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="icon-park-outline:setting-two" class="menu-icon"></iconify-icon>
                    <span>Settings</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'company']) ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Company</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'notification']) ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Notification</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'notificationAlert']) ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Notification Alert</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'theme']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Theme</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'currencies']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Currencies</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'languages']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Languages</a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build(['_name' => 'paymentGetway']) ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Payment Gateway</a>
                    </li>
                </ul>
            </li> -->
        </ul>
    </div>
</aside>