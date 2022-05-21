<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = [
            'admin',
            'manager',
            'user'
        ];
        $permissions = [
            [
                'read' => true,
                'create' => true,
                'update' => true,
                'delete' => true
            ],
            [
                'read' => true,
                'create' => true,
                'update' => true,
                'delete' => false
            ],
            [
                'read' => true,
                'create' => true,
                'update' => false,
                'delete' => false
            ],
        ];
        $rand = rand(0,2);
        return [
            'role' => $roles[$rand],
            'domain' => $this->faker->domainName,
            'permissions' => $permissions[$rand],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
