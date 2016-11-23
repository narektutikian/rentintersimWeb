<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/*
* Register This command by adding in app/Console/Kernel.php file
*Example:
*       protected $commands = [
*                 Commands\ThisClassName::class
*                    ];
*
*/

class Commandset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:entities {entity*} {--route=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates Model, migration, seed for an entity';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $arguments = $this->argument('entity');
        $bar = $this->output->createProgressBar(count($arguments));
        foreach ($arguments as $value) {            
        
        $this::callSilent('make:model', ['name' => 'Models\\'.ucfirst($value)]);
        $this::callSilent('make:migration', ['name' => 'create_'.$value.'s_table', '--create' => $value.'s']);
        $this::callSilent('make:seeder', ['name' => ucfirst($value).'sTableSeeder']);
        if ($this->option('route')=='api')
            $this::callSilent('make:controller',  ['name' => 'Api\\' .ucfirst($value).'Controller', '--resource' => true]);
        else {
            $this::callSilent('make:controller',  ['name' => 'Web\\' .ucfirst($value).'Controller']);
        }

         
         $bar->advance();
         }
         $bar->finish();
         $this->info('Entities are creted succesfully');
    }
}
