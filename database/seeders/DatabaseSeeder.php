<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use App\Models\CardData;
use App\Models\UserContact;
use App\Models\UserData;
use App\Models\Worker;
use App\Models\Work;
use App\Models\WorkImage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 10 ta oddiy user yaratish
        User::factory(10)->create()->each(function ($user) {
            // Har bir user uchun wallet yaratish
            Wallet::factory()->create(['user_id' => $user->id]);
            
            // Har bir user uchun card data yaratish
            CardData::factory()->create(['user_id' => $user->id]);
            
            // Har bir user uchun contact yaratish
            UserContact::factory()->create(['user_id' => $user->id]);
            
            // Har bir user uchun user data yaratish
            UserData::factory()->create(['user_id' => $user->id]);
        });

        // 5 ta worker yaratish
        User::factory(5)->create()->each(function ($user) {
            // User uchun asosiy ma'lumotlar
            Wallet::factory()->create(['user_id' => $user->id]);
            CardData::factory()->create(['user_id' => $user->id]);
            UserContact::factory()->create(['user_id' => $user->id]);
            UserData::factory()->create(['user_id' => $user->id]);
            
            // Worker sifatida ro'yxatga olish
            Worker::factory()->create(['user_id' => $user->id]);
        });

        // 20 ta work e'lon yaratish
        User::factory(8)->create()->each(function ($user) {
            // User uchun asosiy ma'lumotlar
            Wallet::factory()->create(['user_id' => $user->id]);
            CardData::factory()->create(['user_id' => $user->id]);
            UserContact::factory()->create(['user_id' => $user->id]);
            UserData::factory()->create(['user_id' => $user->id]);
            
            // Har bir user uchun 2-3 ta work yaratish
            Work::factory(rand(2, 3))->create(['user_id' => $user->id])->each(function ($work) {
                // Har bir work uchun 2-5 ta rasm qo'shish
                WorkImage::factory(rand(2, 5))->create(['work_id' => $work->id]);
            });
        });

        // Test user yaratish
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        Wallet::factory()->create(['user_id' => $testUser->id, 'balanse' => 1000000]);
        CardData::factory()->create(['user_id' => $testUser->id]);
        UserContact::factory()->create(['user_id' => $testUser->id]);
        UserData::factory()->create(['user_id' => $testUser->id]);
        Worker::factory()->create(['user_id' => $testUser->id]);
        
        // Test user uchun bir nechta work yaratish
        Work::factory(3)->create(['user_id' => $testUser->id])->each(function ($work) {
            WorkImage::factory(3)->create(['work_id' => $work->id]);
        });
    }
}