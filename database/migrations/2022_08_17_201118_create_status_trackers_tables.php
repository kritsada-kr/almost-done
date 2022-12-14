<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_trackers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Post::class); // foreign key `post_id`
            $table->text('message'); //
            $table->timestamps();
            $table->softDeletes();    // `deleted_at`
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_trackers');
    }
};
