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
     * -------------------------------------------------------------------------
     * Lesson Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-lesson' => [
        'name' =>  'lessons.index',
        'code' => 'view-lesson',
        'description' => 'Ability to view list of lessons',
        'group' => 'lesson',
    ],
    'show-lesson' => [
        'name' => 'lessons.show',
        'code' => 'show-lesson',
        'description' => 'Ability to show a single lesson',
        'group' => 'lesson',
    ],
    'create-lesson' => [
        'name' => 'lessons.create',
        'code' => 'create-lesson',
        'description' => 'Ability to show the form to create lesson',
        'group' => 'lesson',
    ],
    'store-lesson' => [
        'name' => 'lessons.store',
        'code' => 'store-lesson',
        'description' => 'Ability to save the lesson',
        'group' => 'lesson',
    ],
    'edit-lesson' => [
        'name' => 'lessons.edit',
        'code' => 'edit-lesson',
        'description' => 'Ability to show the form to edit lesson',
        'group' => 'lesson',
    ],
    'update-lesson' => [
        'name' => 'lessons.update',
        'code' => 'update-lesson',
        'description' => 'Ability to update the lesson',
        'group' => 'lesson',
    ],
    'destroy-lesson' => [
        'name' =>  'lessons.destroy',
        'code' => 'destroy-lesson',
        'description' => 'Ability to move the lesson to trash',
        'group' => 'lesson',
    ],
    'delete-lesson' => [
        'name' =>  'lessons.delete',
        'code' => 'delete-lesson',
        'description' => 'Ability to permanently delete the lesson',
        'group' => 'lesson',
    ],
    'trash-lesson' => [
        'name' =>  'lessons.trash',
        'code' => 'trash-lesson',
        'description' => 'Ability to view the list of all trashed lesson',
        'group' => 'lesson',
    ],
    'restore-lesson' => [
        'name' => 'lessons.restore',
        'code' => 'restore-lesson',
        'description' => 'Ability to restore the lesson',
        'group' => 'lesson',
    ],

    // Many
    'destroy-many-lesson' => [
        'name' =>  'lessons.many.destroy',
        'code' => 'destroy-many-lesson',
        'description' => 'Ability to destroy many lessons',
        'group' => 'lesson',
    ],
    'delete-many-lesson' => [
        'name' =>  'lessons.many.delete',
        'code' => 'delete-many-lesson',
        'description' => 'Ability to permanently delete many lessons',
        'group' => 'lesson',
    ],
    'restore-many-lesson' => [
        'name' => 'lessons.many.restore',
        'code' => 'restore-many-lesson',
        'description' => 'Ability to restore many lessons',
        'group' => 'lesson',
    ],

    //
];
