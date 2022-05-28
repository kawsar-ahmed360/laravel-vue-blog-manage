<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_manages', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->text('short_summary')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->string('cat_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('size_id')->nullable();
            $table->string('color_id')->nullable();
            $table->string('tag_id')->nullable();
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
        Schema::dropIfExists('product_manages');
    }
}
