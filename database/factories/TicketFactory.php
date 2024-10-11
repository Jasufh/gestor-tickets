<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
  /*   protected $model = Ticket::class; */

  /*   public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement(['1','2','3','4']),
            'aula' => $this->faker->randomElement(['A101', 'B202', 'C303']),
            'edificio' => $this->faker->randomElement(['Edificio A', 'Edificio B', 'Edificio C']),
            'problematica' => $this->faker->sentence,
            'comentarioFinal' => $this->faker->paragraph,
            'detalles' => $this->faker->paragraph,
            'estatus' => $this->faker->randomElement(['Pendiente', 'En espera','En proceso', 'Realizado']),
            'creadoPor' => $this->faker->name,
            'fecha_finalizacion' => $this->faker->optional()->dateTimeThisMonth(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    } */
}
