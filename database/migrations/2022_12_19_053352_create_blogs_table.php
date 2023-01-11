<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->longText('description');
            $table->string('seo_keyword')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('image')->nullable();
            $table->integer('view')->default(0);
            $table->json('view_user_detail')->nullable();
            $table->enum('status', ['Active', 'InActive'])->default('Active');
            $table->timestampsTz();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
