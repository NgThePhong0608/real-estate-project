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
        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedTinyInteger('beds');
            $table->unsignedTinyInteger('baths');
            $table->unsignedSmallInteger('area');
            $table->tinyText('city');
            $table->tinyText('code');
            $table->tinyText('street');
            $table->tinyText('street_num');
            $table->unsignedInteger('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('beds');
            $table->dropColumn('baths');
            $table->dropColumn('area');
            $table->dropColumn('city');
            $table->dropColumn('code');
            $table->dropColumn('street');
            $table->dropColumn('street_num');
            $table->dropColumn('price');
        });
    }
};
