<?php

namespace Database\Factories;

use App\Models\Usuarios;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuariosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuarios::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name;
        $nameWithoutSpaces = str_replace(' ', '', $name);
        return [
            'usuario' => $nameWithoutSpaces,
            'nome' => $name,
            'password' => $nameWithoutSpaces,
        ];
    }
}
