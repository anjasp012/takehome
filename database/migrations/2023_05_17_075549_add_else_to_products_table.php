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
        Schema::table('products', function (Blueprint $table) {
            $table->string('meta_keyword');
            $table->string('meta_description');
            $table->boolean('size_s')->nullable();
            $table->boolean('size_m')->nullable();
            $table->boolean('size_l')->nullable();
            $table->boolean('size_xl')->nullable();
            $table->boolean('size_xxl')->nullable();
            $table->string('link_youtube')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('meta_keyword');
            $table->dropColumn('meta_description');
            $table->dropColumn('size_s');
            $table->dropColumn('size_m');
            $table->dropColumn('size_l');
            $table->dropColumn('size_xl');
            $table->dropColumn('size_xxl');
            $table->dropColumn('link_youtube');
        });
    }
};
