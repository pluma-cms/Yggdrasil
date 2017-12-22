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
     * Content Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-content' => [
        'name' =>  'contents.index',
        'code' => 'view-content',
        'description' => 'Ability to view list of contents',
        'group' => 'content',
    ],
    'show-content' => [
        'name' => 'contents.show',
        'code' => 'show-content',
        'description' => 'Ability to show a single content',
        'group' => 'content',
    ],
    'create-content' => [
        'name' => 'contents.create',
        'code' => 'create-content',
        'description' => 'Ability to show the form to create content',
        'group' => 'content',
    ],
    'store-content' => [
        'name' => 'contents.store',
        'code' => 'store-content',
        'description' => 'Ability to save the content',
        'group' => 'content',
    ],
    'edit-content' => [
        'name' => 'contents.edit',
        'code' => 'edit-content',
        'description' => 'Ability to show the form to edit content',
        'group' => 'content',
    ],
    'update-content' => [
        'name' => 'contents.update',
        'code' => 'update-content',
        'description' => 'Ability to update the content',
        'group' => 'content',
    ],
    'destroy-content' => [
        'name' =>  'contents.destroy',
        'code' => 'destroy-content',
        'description' => 'Ability to move the content to trash',
        'group' => 'content',
    ],
    'delete-content' => [
        'name' =>  'contents.delete',
        'code' => 'delete-content',
        'description' => 'Ability to permanently delete the content',
        'group' => 'content',
    ],
    'trash-content' => [
        'name' =>  'contents.trash',
        'code' => 'trash-content',
        'description' => 'Ability to view the list of all trashed content',
        'group' => 'content',
    ],
    'restore-content' => [
        'name' => 'contents.restore',
        'code' => 'restore-content',
        'description' => 'Ability to restore the content',
        'group' => 'content',
    ],

    // Many
    'destroy-many-content' => [
        'name' =>  'contents.many.destroy',
        'code' => 'destroy-many-content',
        'description' => 'Ability to destroy many contents',
        'group' => 'content',
    ],
    'delete-many-content' => [
        'name' =>  'contents.many.delete',
        'code' => 'delete-many-content',
        'description' => 'Ability to permanently delete many contents',
        'group' => 'content',
    ],
    'restore-many-content' => [
        'name' => 'contents.many.restore',
        'code' => 'restore-many-content',
        'description' => 'Ability to restore many contents',
        'group' => 'content',
    ],

    //
];
