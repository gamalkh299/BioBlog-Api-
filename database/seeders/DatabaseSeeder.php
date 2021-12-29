<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Team;
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

          $user->posts()->CreateMany(Post::factory(5)->create([
                  'user_id'=>$user->id
              ])->toArray());
          });

          Team::factory(5)->create();

          Category::factory(5)->create();

          Tag::factory(15)->create();

        Post::factory(10)->create([
           'user_id'=> User::inRandomOrder()->first()->id
        ])->each(function ($q)use ($users){
            Comment::factory(5)->create(['post_id'=>$q->id]);
        });





    }
}
