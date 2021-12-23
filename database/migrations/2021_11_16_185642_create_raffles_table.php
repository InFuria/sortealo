<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRafflesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raffle_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('raffle_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('raffle_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('raffles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('quantity_tickets');
            $table->integer('cost_per_ticket');
            $table->boolean('multiple_winners')->default(0);
            $table->integer('extra_winners')->default(0)->comment('Define la cantidad de ganadores en caso de ser un sorteo con multiples ganadores.');
            $table->text('description');
            $table->bigInteger('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('raffle_types')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('raffle_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('status')->default(0)->comment('0 => Pendiente, 1 => En curso, 2 => Terminado, 3 => Cancelado');
            $table->timestamp('start_date')->comment("Define el dia desde que sl sorteo el valido para registrarse");
            $table->timestamp('end_date')->comment("Define el dia hasta que es posible comprar tickets para participar");
            $table->timestamp('raffle_date')->comment("Define el dia y horario en que se realizara el sorteo");
            $table->bigInteger('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('created_by');
            $table->timestamps();
        });

        Schema::create('raffle_clients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('raffle_id')->unsigned();
            $table->foreign('raffle_id')->references('id')->on('raffles')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('status')->default(0)->comment('0 => Registrado, 1 => Ganador');
            $table->boolean('paid')->default(0)->comment('0 => Pendiente, 1 => Pagado');
            $table->date('orderable_date')->comment('Columna para seguimiento y ordenamiento en el grafico de resumen. Se crea con la fecha de created_at en formato "date", y se actualiza cuando el cliente paga por sus tickets');
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
        Schema::dropIfExists('raffle_clients');
        Schema::dropIfExists('raffles');
        Schema::dropIfExists('raffle_types');
    }
}
