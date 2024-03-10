<?php

namespace Tests\Feature\Presenter\Http\User\Login;

use App\Infrastructure\Database\Models\UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AuthenticatedUser;
use Tests\TestCase;

class CreateUserRequestTest extends TestCase
{

    use RefreshDatabase;
    use AuthenticatedUser;

    public function setUp() : void {
        parent::setUp();
        
        $this->setUpUser();
    }

    public function testSuccessResponse(): void
    {
        $response = $this->postJson('/api/v1/user', [
            "first_name" => "Teste",
            "last_name" => "Teste",
            "email" => "teste@email.com",
            "password" => "password",
            "password_confirmation" => "password",
            "profile_photo_path" => '',
            "theme" => 'light'
        ]);
        $response->assertStatus(201);
    }

        /**
     * @dataProvider dataSetToFailResponse
     */
    public function testFailResponse($data, $expected): void
    {
        $response = $this->post('/api/v1/user', $data, [
            'accept' => 'application/json'
        ]);

        $response->assertStatus(422);
        $response->assertJson($expected);
    }

    public static function dataSetToFailResponse(): array
    {
        return [
            'empty request' => [
                'data' => [],
                'expected' => [
                    "message" => "The first name field is required. (and 3 more errors)",
                    "errors" => [
                        "first_name" => ["The first name field is required."],
                        "last_name" => ["The last name field is required."],
                        "email" => ["The email field is required."],
                        "password" => ["The password field is required."],
                    ]
                ]
            ],
            'with email and no password' => [
                'data' => [
                    'email' => 'email@test.com'
                ],
                'expected' => [
                    "message" => "The first name field is required. (and 2 more errors)",
                    "errors" => [
                        "first_name" => ["The first name field is required."],
                        "last_name" => ["The last name field is required."],
                        "password" => ["The password field is required."],
                    ]
                ]
            ],
            'with password and no email' => [
                'data' => [
                    'password' => '123456789'
                ],
                'expected' => [
                    "message" => "The first name field is required. (and 2 more errors)",
                    "errors" => [
                        "first_name" => ["The first name field is required."],
                        "last_name" => ["The last name field is required."],
                        "email" => ["The email field is required."],
                    ]
                ]
            ],
            'with first name, no password, and no email' => [
                'data' => [
                    'first_name' => 'name'
                ],
                'expected' => [
                    "message" => "The last name field is required. (and 2 more errors)",
                    "errors" => [
                        "last_name" => ["The last name field is required."],
                        "email" => ["The email field is required."],
                        "password" => ["The password field is required."],
                    ]
                ]
            ]
        ];
    }
}
