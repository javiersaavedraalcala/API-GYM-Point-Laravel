<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 20);
            $table->string("name", 100);
            $table->string("last_name", 100);
            $table->string("cellphone", 12);
            $table->string("photo")->nullable();
            $table->string("email", 100);
            $table->enum("status", ['active', 'inactive', 'pending'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
