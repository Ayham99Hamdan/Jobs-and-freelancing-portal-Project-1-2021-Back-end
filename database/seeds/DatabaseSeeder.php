<?php

use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\JobRole::class,10)->create();
        factory(\App\Models\Qualification::class,20)->create();
        factory(\App\Models\User::class,500)->create();
        factory(Company::class,150)->create();
        factory(\App\Models\Education::class,100)->create();
        factory(\App\Models\Experience::class,40)->create();
        factory(\App\Models\Post::class,300)->create();
        factory(\App\Models\Reaction::class,50)->create();
    }
}
