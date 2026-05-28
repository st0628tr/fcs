<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {

            $table->id();

            $table->foreignId('partner_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('store_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('name');

            $table->string('kana')->nullable();

            $table->string('phone')->nullable();

            $table->string('email')->nullable();

            $table->string('employment_type')
                ->default('contract');

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
