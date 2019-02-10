<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LevelRequest;
use App\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{

    public function index()
    {

        $title = 'Levels';

        $breadcrumbs = 'admin.levels';

        $levels = Level::orderBy('school')->get();

        return view('admin.levels.index', compact('levels', 'title', 'breadcrumbs'));
    }

    public function create()
    {
        $level = new Level();

        $schools = Level::schools();

        $title = 'Add Levels';

        $breadcrumbs = 'admin.levels.add';

        return view('admin.levels.create', compact('level', 'schools', 'title', 'breadcrumbs'));
    }

    public function store(LevelRequest $request)
    {

        $validator = $request->validated();
        
        $level = new Level();

        return $this->persist($request, $level);
    }

    public function edit(Level $level)
    {

        $schools = Level::schools();

        $title = 'Edit Level';

        $breadcrumbs = 'admin.level';

        $breadcrumbArgument = $level; 

        return view('admin.levels.edit', compact('level', 'schools', 'title', 'breadcrumbs', 'breadcrumbArgument'));
    }

    public function update(LevelRequest $request, Level $level)
    {

        return $this->persist($request, $level);

    }

    public function destroy(Level $level)
    {
        $level->delete();

        return jsonResponse(true);
    }

    private function persist(Request $request, Level $level)
    {
        $level->name = $request->name;

        $level->school = $request->school;
        
        if ($request->hasFile('image')) {

            $image = $request->file('image')->store('images/levels', 'public');
        }

        $level->save();

        return response()->json([

            'status' => true,

            'redirect' => action('Admin\LevelController@index')
        ]);

    }
}
