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
        // khkjgjhgjhgjhgjh 
        return view("admin.project.create");
    }


    public function create(Request $request)
    {
        $validated = $request->validate([
            'skills' => 'required|unique:posts|max:40|',
            trans('validation.required', ['attribute' => 'Code']),
        ]);
        // dd($request->all());
        $project = Project::create([
            'title' => $request->input('title'),
            'description'=> $request->input('description'),
        ]);
        $skillsInput = $request->input('skills');
        // if skills is not an array, trans to array
        $skillsArray = is_array($skillsInput) ? $skillsInput : [$skillsInput];
        foreach ($skillsArray as $skillName) {
            // if skill is new, create it
            $skill = Skill::firstOrCreate(['name' => $skillName]);
            $project->skills()->attach($skill);
        }
        return redirect("projects");
    }
}
