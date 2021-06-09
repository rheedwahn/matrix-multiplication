<?php

namespace Tests\Feature\Api\Matrix;

use Tests\TestCase;

class MatrixMultiplicationTest extends TestCase
{
    protected $json = ["status"=>"success","data"=>[["D","D","G"],["E","F","I"],["G","F","L"]]];

    public function test_an_unauthenticated_user_cannot_access_matrix_multiplication()
    {
        $data = [];
        $response = $this->postJson('/api/matrix-multiplications', $data);
        $response->assertStatus(401);
        $response->assertJsonFragment([
            'message' => 'Unauthenticated.'
        ]);
    }

    public function test_it_validates_matrix_multiplication_request()
    {
        $data = [];
        $user = $this->setUpUser();
        $response = $this->makeAuthPost($user, '/api/matrix-multiplications', $data);
        $response->assertStatus(422);
        $keys = ['first_matrix', 'second_matrix'];
        $response->assertJsonValidationErrors($keys);
    }

    public function test_it_validates_size_of_matrix()
    {
        $data = [
            "first_matrix" => [
                [
                    1, 1, 1
                ],
                [
                    1, 2, 1
                ],
                [
                    3, 1, 2
                ]
            ],
            "second_matrix" => [
                [
                    1, 1, 2
                ],
                [
                    1, 2, 2
                ]
            ]
        ];
        $user = $this->setUpUser();
        $response = $this->makeAuthPost($user, '/api/matrix-multiplications', $data);
        $response->assertStatus(422);
        $keys = ['second_matrix'];
        $response->assertJsonValidationErrors($keys);
    }

    public function test_it_validates_matrix_contains_only_numeric()
    {
        $data = [
            "first_matrix" => [
                [
                    1, 1, 1
                ],
                [
                    1, 2, 1
                ],
                [
                    'C', 1, 2
                ]
            ],
            "second_matrix" => [
                [
                    1, 1, 'A'
                ],
                [
                    1, 2, 2
                ]
            ]
        ];
        $user = $this->setUpUser();
        $response = $this->makeAuthPost($user, '/api/matrix-multiplications', $data);
        $response->assertStatus(422);
        $keys = ['second_matrix', 'second_matrix'];
        $response->assertJsonValidationErrors($keys);
    }

    public function test_it_validates_matrix_range()
    {
        $data = [
            "first_matrix" => [
                [
                    1, 1, 1
                ],
                [
                    1, 2, 1
                ],
                [
                    0, 1, 2
                ]
            ],
            "second_matrix" => [
                [
                    1, 1, 99
                ],
                [
                    1, 2, 2
                ],
                [
                    0, 1, 2
                ]
            ]
        ];
        $user = $this->setUpUser();
        $response = $this->makeAuthPost($user, '/api/matrix-multiplications', $data);
        $response->assertStatus(422);
        $keys = ['second_matrix', 'second_matrix'];
        $response->assertJsonValidationErrors($keys);
    }

    public function test_it_gets_product_of_matrix()
    {
        $data = [
            "first_matrix" => [
                [
                    1, 1, 1
                ],
                [
                    1, 2, 1
                ],
                [
                    2, 1, 2
                ]
            ],
            "second_matrix" => [
                [
                    1, 1, 3
                ],
                [
                    1, 2, 2
                ],
                [
                    2, 1, 2
                ]
            ]
        ];
        $user = $this->setUpUser();
        $response = $this->makeAuthPost($user, '/api/matrix-multiplications', $data);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'status' => 'success'
        ]);
        $response->assertExactJson($this->json);
    }
}
