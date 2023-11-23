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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('reference_no', 20);
            $table->string('introduction', 200)->nullable();
            $table->string('author', 50);
            $table->string('publisher', 50)->nullable();
            $table->unsignedSmallInteger('publish_year')->nullable();
            $table->unsignedSmallInteger('num_of_pages')->default(1);
            $table->unsignedSmallInteger('num_of_copies')->default(1);
            $table->unsignedSmallInteger('price');
            $table->unsignedSmallInteger('rack_no');
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('book_domain_id');

            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->foreign('book_domain_id')->references('id')->on('book_domains')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
