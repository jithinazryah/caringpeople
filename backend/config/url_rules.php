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
    'update-patient-enquiry/<id:\d+>' => 'patient/patient-enquiry-general-first/update',
    'update-patient/<id:\d+>' => 'patient/patient-information/update',
    'update-service/<id:\d+>' => 'services/service/update',
    'office-staff-attendance-report' => 'reports/reports/report',
    'other-staff-attendance-report' => 'reports/reports/staffattendance',
    'patient-report' => 'reports/reports/patientreport',
    'service-report' => 'reports/reports/servicereport',
    'staff-report' => 'reports/reports/oncallstaff',
    'staff-report' => 'reports/reports/oncallstaff',
    'patient-report' => 'reports/reports/report-patient',
    'day-book' => 'accounts/accounts/index',
    'services' => 'services/service/index',
    'new-service' => 'services/service/create',
    'materials' => 'sales/sales-invoice-details/index',
    'add-materials' => 'sales/sales-invoice-details/add',
    'view-materials/<id:\d+>' => 'sales/sales-invoice-details/view',
    'raete-cards' => 'masters/rate-card/index',
    'new-raetecard' => 'masters/rate-card/create',
    'update-raetecard/<id:\d+>' => 'masters/rate-card/update',
    'invoices' => 'invoice/invoice/index',
    'new-invoice' => 'invoice/invoice/invoice',
    'staff-payroll' => 'accounts/staff-payroll/create',
    'items' => 'product/item-master/index',
    'add-item' => 'product/item-master/create',
    'update-item/<id:\d+>' => 'product/item-master/update',
    'view-item/<id:\d+>' => 'product/item-master/view',
    'purchase-invoices' => 'sales/purchase-invoice-details/index',
    'new-purchase' => 'sales/purchase-invoice-details/add',
    'view-purchase-invoice/<id:\d+>' => 'sales/purchase-invoice-details/view',
    'stock-report' => 'stock/stock-view/index',
    'stock-adjustment' => 'stock/stock-adj-dtl/index',
    'new-stock-adjustment' => 'stock/stock-adj-dtl/add',
    'view-stock-adjustment/<id:\d+>' => 'stock/stock-adj-dtl/view',
];
