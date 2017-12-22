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
     * Package Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-package' => [
        'name' =>  'packages.index',
        'code' => 'view-package',
        'description' => 'Ability to view list of packages',
        'group' => 'package',
    ],
    'show-package' => [
        'name' => 'packages.show',
        'code' => 'show-package',
        'description' => 'Ability to show a single package',
        'group' => 'package',
    ],
    'create-package' => [
        'name' => 'packages.create',
        'code' => 'create-package',
        'description' => 'Ability to show the form to create package',
        'group' => 'package',
    ],
    'store-package' => [
        'name' => 'packages.store',
        'code' => 'store-package',
        'description' => 'Ability to save the package',
        'group' => 'package',
    ],
    'edit-package' => [
        'name' => 'packages.edit',
        'code' => 'edit-package',
        'description' => 'Ability to show the form to edit package',
        'group' => 'package',
    ],
    'update-package' => [
        'name' => 'packages.update',
        'code' => 'update-package',
        'description' => 'Ability to update the package',
        'group' => 'package',
    ],
    'destroy-package' => [
        'name' =>  'packages.destroy',
        'code' => 'destroy-package',
        'description' => 'Ability to move the package to trash',
        'group' => 'package',
    ],
    'delete-package' => [
        'name' =>  'packages.delete',
        'code' => 'delete-package',
        'description' => 'Ability to permanently delete the package',
        'group' => 'package',
    ],
    'trash-package' => [
        'name' =>  'packages.trash',
        'code' => 'trash-package',
        'description' => 'Ability to view the list of all trashed package',
        'group' => 'package',
    ],
    'restore-package' => [
        'name' => 'packages.restore',
        'code' => 'restore-package',
        'description' => 'Ability to restore the package',
        'group' => 'package',
    ],

    // Many
    'destroy-many-package' => [
        'name' =>  'packages.many.destroy',
        'code' => 'destroy-many-package',
        'description' => 'Ability to destroy many packages',
        'group' => 'package',
    ],
    'delete-many-package' => [
        'name' =>  'packages.many.delete',
        'code' => 'delete-many-package',
        'description' => 'Ability to permanently delete many packages',
        'group' => 'package',
    ],
    'restore-many-package' => [
        'name' => 'packages.many.restore',
        'code' => 'restore-many-package',
        'description' => 'Ability to restore many packages',
        'group' => 'package',
    ],

    //
];
