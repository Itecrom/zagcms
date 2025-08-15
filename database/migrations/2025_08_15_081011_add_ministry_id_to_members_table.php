<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            if (!Schema::hasColumn('members', 'ministry_id')) {
                $table->foreignId('ministry_id')
                      ->nullable()
                      ->constrained()
                      ->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            if (Schema::hasColumn('members', 'ministry_id')) {
                $table->dropColumn('ministry_id');
            }
        });
    }
};
