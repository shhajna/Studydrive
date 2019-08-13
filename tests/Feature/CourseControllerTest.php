<?php

namespace Tests\Feature;

use App\Model\Course;
use App\Model\Student;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

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
    public function register()
    {
        $course = factory(Course::class)->create([
            'capacity' => 1
        ]);

        $this->get('courses/' . $course->id)->assertJson([
            'data' => [
                'status' => 'available'
            ]
        ]);

        $this->post('courses/' . $course->id . '/register')->assertOk();

        $this->get('courses/' . $course->id)->assertJson([
            'data' => [
                'status' => 'unavailable'
            ]
        ]);

        $this->post('courses/' . $course->id . '/unregister')->assertOk();

        $this->get('courses/' . $course->id)->assertJson([
            'data' => [
                'status' => 'available'
            ]
        ]);
    }

}
