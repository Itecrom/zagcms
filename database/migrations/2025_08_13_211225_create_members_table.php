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
        Schema::create('members', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('surname');
    $table->date('dob');
    $table->string('home_of_origin');
    $table->string('residential_home');
    $table->foreignId('homecell_id')->constrained();
    $table->foreignId('ministry_id')->constrained();
    $table->string('picture')->nullable();
    $table->string('marital_status')->nullable();
    $table->string('employment_status')->nullable();
    $table->string('phone')->nullable();
    $table->boolean('active')->default(false)->change();
    $table->boolean('transferred')->default(false)->change();
    $table->boolean('deceased')->default(false)->change();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
