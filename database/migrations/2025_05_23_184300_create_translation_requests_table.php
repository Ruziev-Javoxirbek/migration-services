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
        Schema::create('translation_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('document_type'); // паспорт, метрика и т.д.
            $table->string('delivery_type'); // самовывоз / курьер
            $table->string('delivery_address')->nullable(); // если выбрал доставку
            $table->json('uploaded_files'); // массив ссылок на сканы
            $table->string('translated_file_path')->nullable(); // перевод
            $table->enum('status', ['ожидает', 'в процессе', 'готово'])->default('ожидает');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translation_requests');
    }
};
