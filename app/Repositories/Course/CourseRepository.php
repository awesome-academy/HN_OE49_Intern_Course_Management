<?php

namespace App\Repositories\Course;

use App\Repositories\BaseRepository;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function getModel()
    {
        return Course::class;
    }

    public function getAllCourseWithLecturer()
    {
        return Course::with(['users' => function ($query) {
            return $query->where('role_id', config('auth.roles.lecturer'));
        }])->get();
    }

    public function getStudentOfCourse($course)
    {
        return $course->users
            ->where('role_id', config('auth.roles.student'));
    }

    public function getCourseWithLecturer($id)
    {
        return Course::with(['users' => function ($query) {
            return $query->where('role_id', config('auth.roles.lecturer'));
        }])->findOrFail($id);
    }

    public function getLecturerOfCourse($id)
    {
        $course = Course::findOrFail($id);
        $lecturer = $course
            ->users()
            ->where('role_id', config('auth.roles.lecturer'))
            ->first();

        return $lecturer;
    }

    public function create($attributes = [])
    {
        DB::table('courses')->insert([
            'name' => $attributes['name'],
            'credits' => $attributes['credits'],
            'numbers' => $attributes['numbers'],
            'semester_id' => $attributes['semester_id'],
            'slot' => 0,
        ]);
        $count = Course::all()->count();
        $course = $this->find($count);
        $course->users()->attach($attributes['user']);

        return $count;
    }

    public function update($id, $attributes = [])
    {
        DB::table('courses')
            ->where('id', $id)
            ->update([
                'name' => $attributes['name'],
                'credits' => $attributes['credits'],
                'numbers' => $attributes['numbers'],
                'semester_id' => $attributes['semester_id'],
            ]);
    }

    public function delete($id)
    {
        $course = $this->find($id);
        $course->users()->detach();
        $course->delete();
    }
}
