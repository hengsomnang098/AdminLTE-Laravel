<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class CreaeRoutePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate route permissions for all routes in the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $routes = Route::getRoutes()->getRoutes();
        // foreach($routes as $route)
        // {
        //     if($route->getName() !='' && $route->getAction()['middleware'][0]=='web')
        //     {
        //         $permission = Permission::where('name', $route->getName())->first();
        //         if(is_null($permission))
        //         {
        //             permission::create(['name' => $route->getName()]);
        //         }
        //     }
        // }
        // $this->info('Permission Route Added Successfully');


        $routes = Route::getRoutes()->getRoutes();
        foreach($routes as $route)
        {
            if($route->getName() != '')
            {
                $action = $route->getAction();

                // Check if middleware exists and contains 'web'
                if (isset($action['middleware']) && in_array('web', $action['middleware']))
                {
                    $permission = Permission::where('name', $route->getName())->first();
                    if (is_null($permission))
                    {
                        Permission::create(['name' => $route->getName()]);
                    }
                }
            }
        }
        $this->info('Permission Route Added Successfully');
    }
}
