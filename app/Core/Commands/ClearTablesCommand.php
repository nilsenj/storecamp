<?php

namespace App\Core\Commands;

use Illuminate\Console\Command;

class ClearTablesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:tables';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear tables INSTEAD of migrate:reset';

    /**
     * ClearTablesCommand constructor.
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
        if ($this->confirm('Would you like to clear all Tables? [y|N]')) {
            if (\App::environment('local', 'staging', 'testing')) {
                // set tables don't want to truncate here
                $excepts = ['migrations']; /*TODO add excepts option to command*/
                $tables = \DB::connection()
                    ->getPdo()
                    ->query("SHOW FULL TABLES")
                    ->fetchAll();
                $tableNames = [];

                $keys = array_keys($tables[0]);
                $keyName = $keys[0];
                $keyType = $keys[1];

                foreach ($tableNames as $name) {
                    //if you don't want to truncate migrations
                    if (in_array($name[$keyName], $excepts))
                        continue;

                    // truncate tables only
                    if ('BASE TABLE' !== $name[$keyType])
                        continue;

                    \DB::table($name)->truncate();
                }
            } else {
                $this->warn("Tables not cleared. Not allowed on production env");
            }
        }
    }
}