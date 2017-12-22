<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Packages Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'view-package' => [
        'name' => 'view-package',
        'order' => 20,
        'parent' => 'course',
        'icon' => 'fa-archive',
        'slug' => route('packages.index'),
        'always_viewable' => false,
        'labels' => [
            'title' => __('Packages'),
            'description' => __('View the list of all packages'),
        ],
    ],
];
