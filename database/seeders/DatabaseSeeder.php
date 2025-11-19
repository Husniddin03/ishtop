<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserConnection;
use App\Models\Wallet;
use App\Models\UserLocation;
use App\Models\Work;
use App\Models\WorkConnection;
use App\Models\WorkLocation;
use App\Models\WorkPhoto;
use App\Models\WorkVideo;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(20)->create()->each(function($user){
            UserConnection::factory(3)->create(['user_id'=>$user->id]);
            Wallet::factory(1)->create(['user_id'=>$user->id]);
            UserLocation::factory(2)->create(['user_id'=>$user->id]);
        });

        Work::factory(20)->create()->each(function($work){
            WorkConnection::factory(3)->create(['work_id'=>$work->id]);
            WorkLocation::factory(2)->create(['work_id'=>$work->id]);
            WorkPhoto::factory(5)->create(['work_id'=>$work->id]);
            WorkVideo::factory(2)->create(['work_id'=>$work->id]);
        });
    }
}
