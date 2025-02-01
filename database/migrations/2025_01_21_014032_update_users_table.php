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
        Schema::table('users', function (Blueprint $table) {
           $table->enum('role', ['user', 'admin'])->default('user')->after('id'); 
           $table->integer('phonenumber')->nullable()->after('email');
           $table->enum('gender', ['male', 'female'])->nullable()->after('phonenumber');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('phonenumber');
            $table->dropColumn('gender');
        });
    }
};
