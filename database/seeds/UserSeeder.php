<?php

use Illuminate\Database\Seeder;
use App\Post;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\User::class,100)->create();
          }
}
