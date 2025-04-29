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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); 
            $table->foreign('user_id') 
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('full_name', 100)->nullable();
            $table->text('about')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['Hombre', 'Mujer', 'No Decirlo']);
            $table->string('phone_number', 15)->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
