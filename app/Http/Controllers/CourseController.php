<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseCreateRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\CourseResource;
use App\Model\Course;
use App\Model\Registration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(10);
        return CourseResource::collection($courses);
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return new CourseResource($course);
    }

    public function store(CourseCreateRequest $request)
    {
        $course = new Course();
        $course->name = strtolower($request->name);
        $course->capacity = $request->capacity;
        $course->save();

        return response()->json([
            'message' => 'Successfully created!',
            'data' => new CourseResource($course)
        ], Response::HTTP_CREATED);
    }

    public function update(CourseUpdateRequest $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->name = strtolower($request->name);
        $course->capacity = $request->capacity;
        $course->save();

        return response()->json([
            'message' => 'Successfully updated!',
            'data' => new CourseResource($course)
        ], Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        Course::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Successfully deleted!',
        ], Response::HTTP_NO_CONTENT);
    }

    public function register(Request $request, $course_id)
    {
        $registration = new Registration();
        $registration->student_id = $request->user()->id;
        $registration->course_id = $course_id;
        $registration->registered_on = Carbon::now();
        $registration->save();

        return response()->json([
            'message' => 'Registered successfully'
        ]);
    }

    public function unregister(Request $request, $course_id)
    {
        Registration::where('student_id', $request->user()->id)
            ->where('course_id', $course_id)->delete();

        return response()->json([
            'message' => 'Unregistered successfully'
        ]);
    }
}
