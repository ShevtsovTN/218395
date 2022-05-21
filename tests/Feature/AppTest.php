<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JetBrains\PhpStorm\NoReturn;
use Tests\TestCase;

class AppTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    #[NoReturn] public function test_validation(): void
    {
        $user = User::first();
        $role = $user->roles[0];
        $responseOk = $this->get(route('users.index', [
            'sort' => [
                'email' => 'desc'
            ],
            'filter' => [
                'model' => [
                    [
                        'param' => 'name',
                        'value' => $user->name,
                    ]
                ],
                'relations' => [
                    'roles' => [
                        [
                            'value' => $role->domain,
                            'param' => 'domain',
                            'pivot' => [
                                [
                                    'param' => 'active',
                                    'value' => 0,
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ]), [
            'Authorization' => config('app_key.access_key')
        ]);
        $responseOk->assertStatus(200);
        $responseNotValid = $this->get(route('users.index', [
            'sort' => [
                'email' => 'desc'
            ],
            'filter' => [
                'model' => [
                    [
                        'param' => 'name',
                        //'value' => $user->name,
                    ]
                ],
                'relations' => [
                    'roles' => [
                        [
                            'value' => $role->domain,
                            'param' => 'domain',
                            'pivot' => [
                                [
                                    'param' => 'active',
                                    'value' => 0,
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ]), [
            'Authorization' => config('app_key.access_key')
        ]);
        $responseNotValid->assertStatus(302);

        $responseBadAppKey = $this->get(route('users.index', [
            'sort' => [
                'email' => 'desc'
            ],
            'filter' => [
                'model' => [
                    [
                        'param' => 'name',
                        'value' => $user->name,
                    ]
                ],
                'relations' => [
                    'roles' => [
                        [
                            'value' => $role->domain,
                            'param' => 'domain',
                            'pivot' => [
                                [
                                    'param' => 'active',
                                    'value' => 0,
                                ]
                            ]
                        ]
                    ]
                ],
            ]
        ]), [
            'Authorization' => config('app_key.access_key') . '12'
        ]);

        $responseBadAppKey->assertStatus(403);
    }
}
