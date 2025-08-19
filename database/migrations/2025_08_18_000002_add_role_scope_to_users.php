<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->constrained('roles');
            $table->foreignId('homecell_id')->nullable()->constrained('homecells');
            $table->foreignId('ministry_id')->nullable()->constrained('ministries');
        });
    }

    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
            $table->dropForeign(['homecell_id']);
            $table->dropColumn('homecell_id');
            $table->dropForeign(['ministry_id']);
            $table->dropColumn('ministry_id');
        });
    }
};
