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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            // $table->string('author');
            // $table->string('isbn');
            // $table->string('publisher');
            // $table->string('published_date');
            // $table->string('description');
            // $table->string('page_count');
            // $table->string('thumbnail_url');
            // $table->string('language');
            // $table->string('preview_link');
            // $table->string('info_link');
            // $table->string('canonical_volume_link');

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
        Schema::dropIfExists('books');
    }
};
