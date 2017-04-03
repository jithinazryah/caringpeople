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
    'update-branch/<id:\d+>' => 'masters/branch/update',
    'view-branch/<id:\d+>' => 'masters/branch/view',
    'countries' => 'masters/country/index',
    'create-country' => 'masters/country/create',
    'update-country/<id:\d+>' => 'masters/country/update',
    'states' => 'masters/state/index',
    'create-state' => 'masters/state/create',
    'update-state/<id:\d+>' => 'masters/state/update',
    'cities' => 'masters/city/index',
    'create-city' => 'masters/city/create',
    'update-city/<id:\d+>' => 'masters/city/update',
    'new-enquiry' => 'enquiry/enquiry/new-enquiry',
    'view-enquiry/<id:\d+>' => 'enquiry/enquiry/view',
    'hospitals' => 'masters/hospital/index',
    'create-hospital' => 'masters/hospital/create',
    'update-hospital/<id:\d+>' => 'masters/hospital/update',
    'view-hospital/<id:\d+>' => 'masters/hospital/view',
    'staff-enquiries' => 'staff/staff-enquiry/index',
    'new-staff-enquiry' => 'staff/staff-enquiry/create',
    'update-staff-enquiry/<id:\d+>' => 'staff/staff-enquiry/update',
    'view-staff-enquiry/<id:\d+>' => 'staff/staff-enquiry/view',
    'proceed-staff/<id:\d+>' => 'staff/staff-info/proceed',
    'update-staff/<id:\d+>' => 'staff/staff-info/update',
    'update-enquiry/<id:\d+>' => 'enquiry/enquiry/update',
    'update-followup/<id:\d+>' => 'followup/followups/update',
];
