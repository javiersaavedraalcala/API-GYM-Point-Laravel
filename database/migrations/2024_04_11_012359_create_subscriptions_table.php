<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id');
            $table->dateTime("membership_start")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime("membership_end")->nullable();
            $table->enum("plan", ['day', 'weekly', 'monthly', 'quarterly', 'semiannually', 'annually']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
