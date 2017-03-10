<?php

return [
    'access-powers' => 'admin/admin-posts/index',
    'create-access-power' => 'admin/admin-posts/create',
    'update-access-power/<id:\d+>' => 'admin/admin-posts/update',
    'admin-users' => 'admin/admin-users/index',
    'create-admin-users' => 'admin/admin-users/create',
    'update-admin-user/<id:\d+>' => 'admin/admin-users/update',
    'view-admin-user/<id:\d+>' => 'admin/admin-users/view',
    'change-password/<data:\w+>' => 'admin/admin-users/change-password',
    'branches' => 'masters/branch/index',
    'create-branch' => 'masters/branch/create',
];
