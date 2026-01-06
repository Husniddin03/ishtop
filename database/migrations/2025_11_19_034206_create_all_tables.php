<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // wallets
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->float('balanse')->default(0);
            $table->timestamps();
        });

        // cardData
        Schema::create('card_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('number');
            $table->date('date');
            $table->string('name');
            $table->string('phone');
            $table->timestamps();
        });

        // userContacts
        Schema::create('user_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('phone');
            $table->string('telegram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });

        // userData
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->text('bio')->nullable();
            $table->string('gender')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->date('birthday')->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('district')->nullable();
            $table->string('village')->nullable();
            $table->integer('views_count')->default(0);
            $table->string('address')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->timestamps();
        });

        // workers
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // works
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('type');
            $table->float('price');
            $table->integer('how_much_people');
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->boolean('lunch')->default(true);
            $table->text('description');
            $table->string('country');
            $table->string('region');
            $table->string('district');
            $table->string('village');
            $table->string('address');
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->integer('read_count')->default(0);
            $table->date('when');
            $table->time('start_time');
            $table->time('finish_time');
            $table->integer('duration'); // kunlarda
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // work_images
        Schema::create('work_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained('works')->cascadeOnDelete();
            $table->string('image');
            $table->timestamps();
        });
        
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained('works')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('message');
            $table->timestamps();
        });


        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('soato_id')->nullable();
            $table->string('name_uz', 60)->nullable();
            $table->string('name_oz', 60)->nullable();
            $table->string('name_ru', 60)->nullable();
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('soato_id')->nullable();
            $table->string('name_uz', 100)->nullable();
            $table->string('name_oz', 100)->nullable();
            $table->string('name_ru', 100)->nullable();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('soato_id')->nullable();
            $table->unsignedBigInteger('district_id');
            $table->string('name_uz', 100)->nullable();
            $table->string('name_oz', 100)->nullable();
            $table->string('name_ru', 100)->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_images');
        Schema::dropIfExists('works');
        Schema::dropIfExists('workers');
        Schema::dropIfExists('user_data');
        Schema::dropIfExists('user_contacts');
        Schema::dropIfExists('card_data');
        Schema::dropIfExists('wallets');
        Schema::dropIfExists('users');
        Schema::dropIfExists('regions');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('villages');
    }
};
