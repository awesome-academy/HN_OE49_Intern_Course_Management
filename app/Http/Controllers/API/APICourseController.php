<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddCourseRequest;
use App\Http\Requests\EditCourseRequest;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Repositories\Semester\SemesterRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class APICourseController extends Controller
{
    protected $courseRepo;
    protected $semesterRepo;
    protected $userRepo;
    public function __construct(
        CourseRepositoryInterface $courseRepo,
        SemesterRepositoryInterface $semesterRepo,
        UserRepositoryInterface $userRepo
    ) {
        $this->courseRepo = $courseRepo;
        $this->semesterRepo = $semesterRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseRepo->getAllCourseWithLecturer();

        return response()->json($courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->userRepo->getLecturers();
        $semesters = $this->semesterRepo->getAll();

        return response()->json([
            'users' => $users,
            'semesters' => $semesters,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCourseRequest $request)
    {
        try {
            $this->userRepo->find($request->user, [
                'role_id' => config('auth.roles.lecturer')
            ]);
            $this->semesterRepo->find($request->semester);
            $count = $this->courseRepo->create([
                'name' => $request->name,
                'user' => $request->user,
                'credits' => $request->credits,
                'numbers' => $request->numbers,
                'semester_id' => $request->semester,
            ]);

            return response()->json([
                'message' => 'Add successfully',
                'count' => $count,
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'status_code' => 500,
                'error' => $exception,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = $this->courseRepo->find($id);
        $users = $this->courseRepo->getStudentOfCourse($course);

        return response()->json([
            'course' => $course,
            'users' => $users,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = $this->courseRepo->getCourseWithLecturer($id);
        $lecturers = $this->userRepo->getLecturers();
        $semesters = $this->semesterRepo->getAll();

        return response()->json([
            'course' => $course,
            'lecturers' => $lecturers,
            'semesters' => $semesters,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->userRepo->find($request->user, [
                'role_id' => config('auth.roles.lecturer')
            ]);
            $this->courseRepo->update($id, $request->all());
            $course = $this->courseRepo->getCourseWithLecturer($id);
            if (isset($course->users[0])) {
                if ($course->users[0]->id != $request->user) {
                    $course->users()->detach($course->users[0]->id);
                    $course->users()->attach($request->user);
                }
            } else {
                $course->users()->attach($request->user);
            }

            return response()->json([
                'message' => 'Update successfully',
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'status_code' => 500,
                'error' => $exception,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = $this->courseRepo->delete($id);

            return response()->json([
                'message' => 'Delete successfully',
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'status_code' => 500,
                'error' => $exception,
            ]);
        }
    }
}
