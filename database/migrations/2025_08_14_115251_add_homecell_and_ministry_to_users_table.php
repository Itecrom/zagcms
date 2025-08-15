<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('homecell_id')->nullable()->constrained()->nullOnDelete()->after('role');
            $table->foreignId('ministry_id')->nullable()->constrained()->nullOnDelete()->after('homecell_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('homecell_id');
            $table->dropConstrainedForeignId('ministry_id');
        });
    }
};
