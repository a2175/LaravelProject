<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Post;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('pw');
            $table->string('subject');
            $table->text('content');
            $table->timestamps();
        });

        for($i=1; $i<=200; $i++) {
            $blog = new Post;
            $blog->name = "Admin";
            $blog->pw = $i;
            $blog->subject = "제목 ".$i;
            $blog->content = "내용 ".$i;
            $blog->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
