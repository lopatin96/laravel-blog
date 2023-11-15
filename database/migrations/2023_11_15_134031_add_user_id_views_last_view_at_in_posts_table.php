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
            $table->foreignId('user_id')->nullable()->after('id');
            $table->unsignedInteger('views')->after('published')->default(0);
            $table->timestamp('last_view_at')->after('views')->nullable();
        });

        \Atin\LaravelBlog\Models\Post::whereNull('user_id')
            ->update(['user_id' => 1]);

        Schema::table('posts', function (Blueprint $table) {
            $table->string('user_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', static function (Blueprint $table) {
            $table->dropColumn(['user_id', 'views', 'last_view_at']);
        });
    }
};
