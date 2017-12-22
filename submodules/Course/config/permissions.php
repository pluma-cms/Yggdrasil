<?php
/**
 * -----------------------------------------------------------------------------
 * Permissions Array
 * -----------------------------------------------------------------------------
 *
 * Here we define our permissions that you can attach to roles.
 *
 * These permissions corresponds to a counterpart
 * route (found in <this module>/routes/<route-files>.php).
 * All permissionable routes should have a `name` (e.g. 'roles.store')
 * for the role authentication middleware to work.
 *
 */
return [
    /**
     * Course Permissions
     *
     */
    'view-course' => [
        'name' =>  'courses.index',
        'code' => 'view-course',
        'description' => 'Ability to view list of courses',
        'group' => ['course', 'student'],
    ],
    'show-course' => [
        'name' => 'courses.show',
        'code' => 'show-course',
        'description' => 'Ability to show a single course',
        'group' => ['course', 'student'],
    ],
    'create-course' => [
        'name' => 'courses.create',
        'code' => 'create-course',
        'description' => 'Ability to show the form to create course',
        'group' => 'course',
    ],
    'store-course' => [
        'name' => 'courses.store',
        'code' => 'store-course',
        'description' => 'Ability to save the course',
        'group' => 'course',
    ],
    'edit-course' => [
        'name' => 'courses.edit',
        'code' => 'edit-course',
        'description' => 'Ability to show the form to edit course',
        'group' => 'course',
    ],
    'update-course' => [
        'name' => 'courses.update',
        'code' => 'update-course',
        'description' => 'Ability to update the course',
        'group' => 'course',
    ],
    'destroy-course' => [
        'name' =>  'courses.destroy',
        'code' => 'destroy-course',
        'description' => 'Ability to move the course to trash',
        'group' => 'course',
    ],
    'delete-course' => [
        'name' =>  'courses.delete',
        'code' => 'delete-course',
        'description' => 'Ability to permanently delete the course',
        'group' => 'course',
    ],
    'trash-course' => [
        'name' =>  'courses.trash',
        'code' => 'trash-course',
        'description' => 'Ability to view the list of all trashed course',
        'group' => 'course',
    ],
    'restore-course' => [
        'name' => 'courses.restore',
        'code' => 'restore-course',
        'description' => 'Ability to restore the course',
        'group' => 'course',
    ],

    // Many
    'destroy-many-course' => [
        'name' =>  'courses.many.destroy',
        'code' => 'destroy-many-course',
        'description' => 'Ability to destroy many courses',
        'group' => 'course',
    ],
    'delete-many-course' => [
        'name' =>  'courses.many.delete',
        'code' => 'delete-many-course',
        'description' => 'Ability to permanently delete many courses',
        'group' => 'course',
    ],
    'restore-many-course' => [
        'name' => 'courses.many.restore',
        'code' => 'restore-many-course',
        'description' => 'Ability to restore many courses',
        'group' => 'course',
    ],

    // Enrolled
    'view-enrolled-courses' => [
        'name' => 'courses.enrolled.index',
        'code' => 'view-enrolled-courses',
        'description' => 'Ability to view enrolled courses',
        'group' => ['course', 'student'],
    ],
    'show-enrolled-courses' => [
        'name' => 'courses.enrolled.show',
        'code' => 'show-enrolled-courses',
        'description' => 'Ability to view enrolled courses',
        'group' => ['course', 'student'],
    ],
    'enroll-course' => [
        'name' => 'courses.enroll',
        'code' => 'enroll-course',
        'description' => 'Ability to enroll to a course',
        'group' => ['course', 'student'],
    ],

    // Bookmarked
    'view-bookmarked-courses' => [
        'name' => 'courses.bookmark.index',
        'code' => 'view-bookmarked-courses',
        'description' => 'Ability to view bookmarked courses',
        'group' => ['course', 'student'],
    ],
    'bookmark-course' => [
        'name' => 'courses.bookmark.bookmark',
        'code' => 'bookmark-course',
        'description' => 'Ability to bookmark a course',
        'group' => ['course', 'student'],
    ],
    'unbookmark-course' => [
        'name' => 'courses.bookmark.unbookmark',
        'code' => 'unbookmark-course',
        'description' => 'Ability to remove from bookmarks list a course',
        'group' => ['course', 'student'],
    ],
];
