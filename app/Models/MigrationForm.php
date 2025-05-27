<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MigrationForm extends Model
{
    use HasFactory;
    protected $fillable = [
        // 1. Иностранный гражданин
        'surname_en', 'surname_ru',
        'name_en', 'name_ru',
        'patronymic_en', 'patronymic_ru',
        'citizenship', 'birth_date',
        'gender', 'birth_place',
        'doc_type', 'doc_number',
        'doc_issued', 'doc_expiry',

        // 2. Место пребывания
        'stay_region', 'stay_district', 'stay_city', 'stay_street',
        'stay_house', 'stay_korpus', 'stay_stroenie', 'stay_flat',
        'stay_from', 'stay_to', 'phone',

        // 3. Миграционная карта
        'migration_card_series', 'migration_card_number',
        'migration_card_identity_doc',
        'visit_purpose', 'visit_from', 'visit_to',

        // 4. Принимающая сторона
        'host_surname', 'host_name', 'host_patronymic',
        'host_citizenship', 'host_birth_date',
        'host_gender', 'host_birth_place',
        'host_doc_number', 'host_doc_issued', 'host_doc_expiry',

        // 5. Место проживания
        'host_region', 'host_district', 'host_city', 'host_street',
        'host_house', 'host_korpus', 'host_stroenie', 'host_flat',
        'host_phone', 'document_path',
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
