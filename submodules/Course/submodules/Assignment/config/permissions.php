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
     * Assignment Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-assignment' => [
        'name' =>  'assignments.index',
        'code' => 'view-assignment',
        'description' => 'Ability to view list of assignments',
        'group' => 'assignment',
    ],
    'show-assignment' => [
        'name' => 'assignments.show',
        'code' => 'show-assignment',
        'description' => 'Ability to show a single assignment',
        'group' => 'assignment',
    ],
    'create-assignment' => [
        'name' => 'assignments.create',
        'code' => 'create-assignment',
        'description' => 'Ability to show the form to create assignment',
        'group' => 'assignment',
    ],
    'store-assignment' => [
        'name' => 'assignments.store',
        'code' => 'store-assignment',
        'description' => 'Ability to save the assignment',
        'group' => 'assignment',
    ],
    'edit-assignment' => [
        'name' => 'assignments.edit',
        'code' => 'edit-assignment',
        'description' => 'Ability to show the form to edit assignment',
        'group' => 'assignment',
    ],
    'update-assignment' => [
        'name' => 'assignments.update',
        'code' => 'update-assignment',
        'description' => 'Ability to update the assignment',
        'group' => 'assignment',
    ],
    'destroy-assignment' => [
        'name' =>  'assignments.destroy',
        'code' => 'destroy-assignment',
        'description' => 'Ability to move the assignment to trash',
        'group' => 'assignment',
    ],
    'delete-assignment' => [
        'name' =>  'assignments.delete',
        'code' => 'delete-assignment',
        'description' => 'Ability to permanently delete the assignment',
        'group' => 'assignment',
    ],
    'trash-assignment' => [
        'name' =>  'assignments.trash',
        'code' => 'trash-assignment',
        'description' => 'Ability to view the list of all trashed assignment',
        'group' => 'assignment',
    ],
    'restore-assignment' => [
        'name' => 'assignments.restore',
        'code' => 'restore-assignment',
        'description' => 'Ability to restore the assignment',
        'group' => 'assignment',
    ],

    // Many
    'destroy-many-assignment' => [
        'name' =>  'assignments.many.destroy',
        'code' => 'destroy-many-assignment',
        'description' => 'Ability to destroy many assignments',
        'group' => 'assignment',
    ],
    'delete-many-assignment' => [
        'name' =>  'assignments.many.delete',
        'code' => 'delete-many-assignment',
        'description' => 'Ability to permanently delete many assignments',
        'group' => 'assignment',
    ],
    'restore-many-assignment' => [
        'name' => 'assignments.many.restore',
        'code' => 'restore-many-assignment',
        'description' => 'Ability to restore many assignments',
        'group' => 'assignment',
    ],

    //
];
