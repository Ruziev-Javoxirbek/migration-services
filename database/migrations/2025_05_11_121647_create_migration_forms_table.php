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
        Schema::create('migration_forms', function (Blueprint $table) {
            $table->id();

            // 1. Иностранный гражданин
            $table->string('surname_en');
            $table->string('surname_ru');
            $table->string('name_en');
            $table->string('name_ru');
            $table->string('patronymic_en')->nullable();
            $table->string('patronymic_ru')->nullable();
            $table->string('citizenship');
            $table->date('birth_date');
            $table->string('gender');
            $table->string('birth_place');
            $table->string('doc_type');
            $table->string('doc_number');
            $table->date('doc_issued');
            $table->date('doc_expiry');

            // 2. Место пребывания (stay_*)
            $table->string('stay_region');
            $table->string('stay_district');
            $table->string('stay_city');
            $table->string('stay_street');
            $table->string('stay_house');
            $table->string('stay_korpus')->nullable();
            $table->string('stay_stroenie')->nullable();
            $table->string('stay_flat')->nullable();
            $table->date('stay_from');
            $table->date('stay_to');
            $table->string('phone');

            // 3. Миграционная карта
            $table->string('migration_card_series');
            $table->string('migration_card_number');
            $table->string('migration_card_identity_doc');
            $table->string('visit_purpose');
            $table->date('visit_from');
            $table->date('visit_to');

            // 4. Принимающая сторона (host_*)
            $table->string('host_surname');
            $table->string('host_name');
            $table->string('host_patronymic')->nullable();
            $table->string('host_citizenship');
            $table->date('host_birth_date');
            $table->string('host_gender');
            $table->string('host_birth_place');
            $table->string('host_doc_number');
            $table->date('host_doc_issued');
            $table->date('host_doc_expiry');

            // 5. Место проживания (host_*)
            $table->string('host_region');
            $table->string('host_district');
            $table->string('host_city');
            $table->string('host_street');
            $table->string('host_house');
            $table->string('host_korpus')->nullable();
            $table->string('host_stroenie')->nullable();
            $table->string('host_flat')->nullable();
            $table->string('host_phone');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('migration_forms');
    }
};
