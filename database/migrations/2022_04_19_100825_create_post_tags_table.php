<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('post_tags', function (Blueprint $table) {
            $table->id();

            $table->index('post_id', 'post_id_idx');
            $table->index('tag_id', 'tag_id_idx');

            $table->foreignId('post_id')->constrained();
            $table->foreignId('tag_id')->constrained();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('post_tags');
    }
};
