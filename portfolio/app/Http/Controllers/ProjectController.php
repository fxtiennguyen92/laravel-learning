<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Skill;

class ProjectController extends Controller
{
    public function all()
    {
        $projects = Project::with('skills')->get();
        return view("admin.project.list", ["projects" => $projects]);
    }

    public function store()
    {
        return view("admin.project.create");
    }


    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            // * est chaque elt dans arr
            'skills.*' => 'max:50',
            'skills' => 'distinct', // nếu trùng skill sẽ tự động bỏ qua elt trùng
        ]);

        // Kiểm tra skills không trùng lặp
        $skillsInput = $request->input('skills', []);
        // loại bỏ các giá trị trùng lặp trong mảng
        $uniqueSkills = array_unique($skillsInput);

        $project = Project::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        
        foreach ($uniqueSkills as $skillName) {
            if (!empty($skillName)) {
                // if skill is new, create it
                $skill = Skill::firstOrCreate(['name' => $skillName]);
                $project->skills()->attach($skill);
            }
        }
        return redirect("projects");
    }
}
