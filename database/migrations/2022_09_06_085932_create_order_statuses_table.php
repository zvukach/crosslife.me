<?php

use App\Models\OrderStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('title');
            $table->timestamps();
        });

        $statuses = [
            'canceled'  => 'Отменен',
            'created'   => 'Ожидает оплаты',
            'payed'     => 'Оплачен',
            'completed' => 'Завершен'
        ];

        foreach ($statuses as $code => $title) {
            OrderStatus::factory()->create([
                'code'  => $code,
                'title' => $title
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_statuses');
    }
};
