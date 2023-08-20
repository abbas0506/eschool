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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 50)->nullable();
            $table->string('password', 30)->nullable();
            $table->string('father', 100)->nullable();
            $table->string('cnic', 20)->nullable()->unique();
            $table->string('phone', 20)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('image', 100)->default('default.png');
            $table->date('dob')->nullable();
            $table->enum('gender', ['M', 'F', 'T']);
            $table->string('regno', 40)->unique()->nullable();
            $table->string('rollno', 40)->unique();

            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('status_id')->default(1);

            $table->foreign('section_id')->references('id')->on('sections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
