<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::rename('repairguides', 'repair_guides');
}

public function down()
{
    Schema::rename('repair_guides', 'repairguides');
}
};