<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('文章标题');
            $table->integer('category_id')->default(0)->comment('分类ID');
            $table->text('intro')->comment('文章简介');
            $table->string('img')->default('')->comment('文章封面');
            $table->text('content_html')->comment('文章内容-html格式');
            $table->text('content_mark')->comment('文章内容-markdown格式');
            $table->tinyInteger('status')->default(0)->comment('状态');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
