<?php

namespace Tests\Feature;

use App\Model\Student;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use WithFaker;

    protected $student;

    public function setUp(): void
    {
        parent::setUp();

        $this->student = Student::inRandomOrder()->first();

        Passport::actingAs($this->student);
    }

    /**
     * @test
     */
    public function index()
    {
        $this->get('students')->assertOk();
    }

    /**
     * @test
     */
    public function show()
    {
        $this->get('students/' . $this->student->id)->assertOk()->assertJson([
            'data' => [
                'id' => $this->student->id
            ]
        ]);
    }

    /**
     * @test
     */
    public function store()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $this->post('students', $data)->assertStatus(201)->assertJson([
            'data' => [
                'name' => $data['name'],
                'email' => $data['email'],
            ]
        ]);
    }

    /**
     * @test
     */
    public function update()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email
        ];

        $this->put('students/' . $this->student->id, $data)->assertStatus(202)->assertJson([
            'data' => [
                'name' => $data['name'],
                'email' => $data['email'],
            ]
        ]);
    }

    /**
     * @test
     */
    public function destroy()
    {
        $this->delete('students/' . $this->student->id)->assertStatus(204);
    }
}
