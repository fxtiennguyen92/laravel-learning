<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Image;


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
            'image' => 'required|image|max:2048', // ảnh <= 2MB
        ]);

        // Kiểm tra skills không trùng lặp
        $skillsInput = $request->input('skills', []);
        // loại bỏ các giá trị trùng lặp trong mảng
        $uniqueSkills = array_unique($skillsInput);

        $project = Project::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        //save img to public/storage
        $path = $request->file('image')->store('public');
        $publicPath = str_replace('', '', $path);
        // create db for img 
        $image = Image::create([
            'category'=> 'Project',
            'src' => $publicPath,
            // 'pro'=> $uniqueSkills,
        ]);
        // 1-1 image_project
        $image->project()->save($project);


        foreach ($uniqueSkills as $skillName) {
            if (!empty($skillName)) {
                // if skill is new, create it
                $skill = Skill::firstOrCreate(['name' => $skillName]);
                // n-n projects_skills
                $project->skills()->attach($skill);
            }
        }

        return redirect("projects");
    }
}
