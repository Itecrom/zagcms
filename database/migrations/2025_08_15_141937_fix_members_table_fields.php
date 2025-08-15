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
        Schema::table('members', function (Blueprint $table) {
            $table->string('home_of_origin')->nullable()->change();
            $table->string('residential_home')->nullable()->change();
            $table->boolean('active')->default(false)->change();
            $table->boolean('transferred')->default(false)->change();
            $table->boolean('deceased')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('home_of_origin')->nullable(false)->change();
            $table->string('residential_home')->nullable(false)->change();
            $table->boolean('active')->default(false)->change();
            $table->boolean('transferred')->default(false)->change();
            $table->boolean('deceased')->default(false)->change();
        });
    }
};
