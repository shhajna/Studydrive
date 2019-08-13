<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Resources\StudentResource;
use App\Model\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::paginate(10);
        return StudentResource::collection($students);
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        return new StudentResource($student);
    }

    public function store(StudentCreateRequest $request)
    {
        $student = new Student();

        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->save();

        return response()->json([
            'message' => 'Successfully created!',
            'data' => new StudentResource($student)
        ], Response::HTTP_CREATED);
    }

    public function update($id, StudentUpdateRequest $request)
    {
        $student = Student::findOrFail($id);

        $student->name = $request->name;
        $student->email = $request->email;

        if ($request->password) {
            $student->password = Hash::make($request->password);
        }
        $student->save();

        return response()->json([
            'message' => 'Successfully updated!',
            'data' => new StudentResource($student)
        ], Response::HTTP_ACCEPTED);
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Successfully deleted!',
        ], Response::HTTP_NO_CONTENT);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
