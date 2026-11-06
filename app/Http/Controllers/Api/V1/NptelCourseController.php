<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\NptelCourse;
use Illuminate\Http\Request;

class NptelCourseController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'phase' => 'sometimes|in:I,II',
            'course_type' => 'sometimes|in:web,video',
            'department' => 'sometimes|string|max:255',
            'search' => 'sometimes|string|max:255',
            'per_page' => 'sometimes|integer|min:1|max:100',
        ]);

        $courses = NptelCourse::query()
            ->where('status', 'published')
            ->when(isset($validated['phase']), function ($query) use ($validated) {
                $query->where('phase', $validated['phase']);
            })
            ->when(isset($validated['course_type']), function ($query) use ($validated) {
                $query->where('course_type', $validated['course_type']);
            })
            ->when(isset($validated['department']), function ($query) use ($validated) {
                $query->where('department', $validated['department']);
            })
            ->when(isset($validated['search']), function ($query) use ($validated) {
                $search = $validated['search'];

                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%")
                        ->orWhere('developers', 'like', "%{$search}%");
                });
            })
            ->orderBy('title')
            ->paginate($validated['per_page'] ?? 15);

        return response()->json($courses);
    }

    public function show(string $slug)
    {
        $course = NptelCourse::query()
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json([
            'data' => $course,
        ]);
    }
}