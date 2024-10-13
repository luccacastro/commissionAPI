<?php
// database/migrations/xxxx_xx_xx_create_commission_models_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionModelsTable extends Migration
{
    public function up()
    {
        Schema::create('commission_models', function (Blueprint $table) {
            $table->id();
            $table->string('model_type')->unique();
            $table->json('price_data'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('commission_models');
    }
}
