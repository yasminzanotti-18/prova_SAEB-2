<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agendamento extends Model
{
    protected $table = 'agendamentos';

    protected $fillable = [
        'veiculo_id',
        'data_agendamento',
        'hora_agendamento',
        'servico',
        'status',
        'observacoes',
    ];

    protected function casts(): array
    {
        return [
            'data_agendamento' => 'date',
        ];
    }

    public function veiculo(): BelongsTo
    {
        return $this->belongsTo(Veiculo::class, 'veiculo_id');
    }
}