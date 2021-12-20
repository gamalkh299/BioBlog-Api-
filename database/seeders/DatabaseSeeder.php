<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('orchid:admin admin admin@admin.com password');
          $users=\App\Models\User::factory(10)->create()->each(function (User $user){

          $user->posts()->CreateMany(Post::factory(10)->create([
                  'user_id'=>$user->id
              ])->toArray());
          });



    }
}
