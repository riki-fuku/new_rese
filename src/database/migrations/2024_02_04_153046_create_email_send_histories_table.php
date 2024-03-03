<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSendHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_send_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('send_user_id')->nullable();
            $table->unsignedBigInteger('send_shop_id')->nullable();
            $table->unsignedBigInteger('email_template_id')->nullable();
            $table->timestamp('sent_datetime');
            $table->tinyInteger('success_flag')->comment('0:失敗,1:成功');
            $table->text('error_message')->nullable();
            $table->string('user_type', 10)->comment('1:管理者、2:店舗代表者');
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
        Schema::dropIfExists('email_send_histories');
    }
}
