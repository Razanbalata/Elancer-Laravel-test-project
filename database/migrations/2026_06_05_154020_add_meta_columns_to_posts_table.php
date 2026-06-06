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
        Schema::table('posts', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable()->after('status');
            $table->json('meta')->nullable()->after('published_at');
            $table->softDeletes(); //deleted_at : timestamp 
           // $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->change();
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //
            $table->dropColumn(['published_at','meta']);
            $table->dropSoftDeletes();
            // $table->enum('status', ['draft', 'published'])->default('draft')->change();
            //  $table->dropIndex(['published_at']);
            
        });
    }
};
