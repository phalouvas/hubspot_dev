<?php

namespace Smsto\Hubspot\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Smsto\Hubspot\Models\Jsons;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @var string
     */
    protected $signature = 'hubspot:install {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

    /**
     * The console command description.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @var string
     */
    protected $description = 'Install the Hubspot components and resources';

    /**
     * Execute the console command.
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @return void
     */
    public function handle()
    {
        $this->seedUsers();
        $this->line('');
        $this->info('Hubspot installed successfully.');
    }

    /**
     * Create administrator user
     *
     * @author Panayiotis Halouvas <phalouvas@kainotomo.com>
     *
     * @return void
     */
    protected function seedUsers() {
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@sms.to',
            'password' => Hash::make('admin'), // password
       ]);
    }

}
