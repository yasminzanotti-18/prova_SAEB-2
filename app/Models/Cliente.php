<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'endereco',
    ];

    protected function casts(): array
    {
        return [
            'cpf' => 'encrypted',
        ];
    }

    public function veiculos(): HasMany
    {
        return $this->hasMany(Veiculo::class, 'cliente_id');
    }
}