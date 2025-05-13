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
        Schema::table('tutorials', function (Blueprint $table) {
            $table->string('difficulty')->nullable();
            $table->integer('time_required_min')->nullable();
            $table->integer('time_required_max')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tutorials', function (Blueprint $table) {
            $table->dropColumn('difficulty');
            $table->dropColumn('time_required_min');
            $table->integer('time_required_max')->nullable();
        });
    }
};
