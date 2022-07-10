<?php
   
return [
  
    'pagination_records' => 10,
  
    'file_types' => [
        '' => 'app.select_file_types',
        1  => 'app.land_transaction',
        2  => 'app.jofa',
    ],

    'jofa_types' => [
        '' => 'app.select_jofa_types',
        1  => 'app.land_grant',
        2  => 'app.land_plan',
    ],

    'statuses' => [
        '' => 'app.select_statuses',
        1 => 'app.draft',
        2 => 'app.in_process',
        3 => 'app.approved',
        4 => 'app.rejected',
        5 => 'app.file_issued',
        6 => 'app.file_returned'
    ],

    'color_statuses' => [
        '' => 'secondary',
        1 => 'secondary',
        2 => 'primary',
        3 => 'success',
        4 => 'danger',
        5 => 'success',
        6 => 'success'
    ],
]
?>