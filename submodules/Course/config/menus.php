<?php

return [
    /**
     * -------------------------------------------------------------------------
     * Courses Menus
     * -------------------------------------------------------------------------
     * Specify here the menus to appear on the sidebar.
     *
     */
    'course' => [
        'name' => 'course',
        'order' => 51,
        'slug' => url('courses'),
        'always_viewable' => false,
        'icon' => 'fa-book',
        'labels' => [
            'title' => __('Courses'),
            'description' => __('Manage courses'),
        ],
        'children' => [
            'view-enrolled-courses' => [
                'name' => 'view-enrolled-courses',
                'order' => 1,
                'slug' => route('courses.enrolled.index'),
                'always_viewable' => true,
                'routes' => [
                    'name' => 'courses.enrolled.index',
                    'children' => [
                        'courses.enrolled.show',
                    ]
                ],
                'labels' => [
                    'title' => __('My Courses'),
                    'description' => __('View your currently enrolled courses'),
                ],
            ],

            'view-course' => [
                'name' => 'view-course',
                'order' => 2,
                'slug' => route('courses.index'),
                'routes' => [
                    'name' => 'courses.index',
                    'children' => [
                        'courses.edit',
                        'courses.show',
                    ]
                ],
                'always_viewable' => false,
                'labels' => [
                    'title' => __('All Courses'),
                    'description' => __('View the list of all courses'),
                ],
            ],
            'create-course' => [
                'name' => 'create-course',
                'order' => 4,
                'slug' => url(config('path.admin').'/courses/create'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Create Course'),
                    'description' => __('Create a Course'),
                ],
            ],
            'trashed-course' => [
                'name' => 'trashed-course',
                'order' => 6,
                'slug' => url(config('path.admin').'/courses/trashed'),
                'always_viewable' => false,
                'labels' => [
                    'title' => __('Trashed Courses'),
                    'description' => __('View list of all courses moved to trash'),
                ],
            ],

            'view-bookmarked-courses' => [
                'name' => 'view-bookmarked-courses',
                'order' => 10,
                'icon' => 'bookmark',
                'slug' => route('courses.bookmark.index'),
                'always_viewable' => true,
                'labels' => [
                    'title' => __('Bookmarked'),
                    'description' => __('View all your bookmarked courses'),
                ],
            ],

            'divider-for-course-category' => [
                'name' => 'divider-for-course-category',
                'is_header' => true,
                'is_divider' => true,
                'parent' => 'course',
                'order' => 12,
            ],

            'course-category' => [
                'name' => 'course-category',
                'order' => 13,
                'slug' => route('courses.categories.index'),
                'always_viewable' => false,
                'icon' => 'label',
                'labels' => [
                    'title' => __('Categories'),
                    'description' => __('View list of all course categories'),
                ],
            ],
        ],
    ],
];
