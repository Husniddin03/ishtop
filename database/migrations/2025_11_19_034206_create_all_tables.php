<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_connections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('url')->nullable();
            $table->timestamps();
        });

        Schema::create('wallet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->integer('balance')->default(0);
            $table->timestamps();
        });

         Schema::create('user_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamps();
        });

         Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type')->nullable();
            $table->text('descrition')->nullable();   // Sizdagi nom qoldirildi
            $table->date('date')->nullable();
            $table->timestamps();
        });

        Schema::create('work_connections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained('works')->onDelete('cascade');
            $table->string('name');
            $table->string('url')->nullable();
            $table->timestamps();
        });

        Schema::create('work_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained('works')->onDelete('cascade');
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamps();
        });

        Schema::create('work_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained('works')->onDelete('cascade');
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('work_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained('works')->onDelete('cascade');
            $table->string('url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_connections');
        Schema::dropIfExists('wallet');
        Schema::dropIfExists('user_locations');
        Schema::dropIfExists('works');
        Schema::dropIfExists('work_connections');
        Schema::dropIfExists('work_locations');
        Schema::dropIfExists('work_photos');
        Schema::dropIfExists('work_videos');
    }
};
