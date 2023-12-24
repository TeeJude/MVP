<?php

namespace App\Console\Commands;

use App\Models\Core\Gender;
use Illuminate\Console\Command;

class CreateGenderComand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-gender';

    /**app:create-gender
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Gender';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        return (new Gender())->createGender();
    }
}