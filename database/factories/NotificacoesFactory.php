<?php

namespace Database\Factories;

use App\Models\Notificacoes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class NotificacoesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notificacoes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        return [
            'titulo' => $name,
            'tipo' => 'pdf',
            'usuario_cod' => 5,
        ];
    }
}
