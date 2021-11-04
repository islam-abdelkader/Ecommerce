<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->unique();
            $table->string('name_ar')->unique();
            $table->enum('is_active',[0,1])->default(1);
            $table->enum('is_parent',[0,1])->default(1);
            // $table->id('parent_id');
            $table->string('image')->default('assets/images/notfound.jpg');
            $table->string('slug')->unique();
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
        Schema::dropIfExists('categories');
    }
}
