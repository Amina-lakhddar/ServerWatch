<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('serveurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('adressIP'); // ✅ fix: capital IP
            $table->string('statut');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('serveurs');
    }
};