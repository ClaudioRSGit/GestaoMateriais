<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTableForAttachmentAndDuration extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('url');
            $table->string('attachment_path')->nullable();
            $table->integer('duration_days')->default(7);
            $table->boolean('is_active')->default(true);
            $table->timestamp('expires_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['attachment_path', 'duration_days', 'is_active', 'expires_at']);
            $table->string('url')->nullable();
        });
    }
}
