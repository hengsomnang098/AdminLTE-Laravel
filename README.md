# Gudeline install fresh adminlte-laravel

    https://www.itsolutionstuff.com/post/how-to-integrate-adminlte-3-in-laravel-11example.html

## Full GuideLine for laraveladminlte

    https://github.com/jeroennoten/Laravel-AdminLTE/wiki

## Setup Permission laravel

    https://spatie.be/docs/laravel-permission/v6/introduction

## GuideLine setup toastr in laravel

    https://github.com/yoeunes/toastr

## Guideline datable

    https://yajrabox.com/docs/laravel-datatables/11.0

    composer require yajra/laravel-datatables-oracle:"^10.3.1"

     'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type'=> 'js',
                    'asset'=> true,
                    'location'=> '//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css',
                ]
            ],
        ],

## sweet alert use in controller and sweet alert 2 use in blade for comfrim message model since it have some bug in it
