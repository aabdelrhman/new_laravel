<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->text('desc_en');
            $table->text('desc_ar');
            $table->integer('price');
            $table->text('photos');
            $table->tinyInteger('status')->default(1)->comment('1=>active , 0=>not active');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
