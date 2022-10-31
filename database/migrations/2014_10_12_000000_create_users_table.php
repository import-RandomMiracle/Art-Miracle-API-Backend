<?php

use App\Models\Artist;
use App\Models\Image;
use App\Models\Wallet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $url = Storage::url('avatar/default_profile.png');
            $table->id();
            $table->foreignIdFor(Wallet::class);
            $table->foreignIdFor(Artist::class)->nullable();
            $table->string('image')->default($url);
            $table->string('user_name')->unique();
            $table->string('display_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('USER');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
