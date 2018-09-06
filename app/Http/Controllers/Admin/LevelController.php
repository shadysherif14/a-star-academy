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

        $levels = Level::all();

        return view('admin.levels.index', compact('levels'));
    }

    public function create()
    {
        $level = new Level();

        $schools = Level::select('school')->distinct()->get()->pluck('school');

        return view('admin.levels.create', compact('level', 'schools'));
    }

    public function store(LevelRequest $request)
    {

        $validator = $request->validated();
        
        $level = new Level();

        return $this->saveOrUpdate($request, $level);
    }

    public function show(Level $level)
    {
        return view('admin.levels.show', compact('level'));
    }

    public function edit(Level $level)
    {

        $schools = Level::select('school')->distinct()->get()->pluck('school');

        return view('admin.levels.edit', compact('level', 'schools'));
    }

    public function update(LevelRequest $request, Level $level)
    {

        $request->validated();

        return $this->saveOrUpdate($request, $level);

    }

    public function destroy(Level $level)
    {
        $level->delete();

        return jsonResponse(true);
    }

    private function saveOrUpdate(Request $request, Level $level)
    {
        $level->name = $request->name;

        $level->school = $request->school;
        
        $level->description = $request->description;

        if ($request->file('image')) {

            $image = $request->image->store('public/images/levels');

            $level->image = str_replace_first('public/', '', $image);
        }

        $level->save();

        return response()->json([

            'status' => true,

            'redirect' => route('admin.levels.show', ['level' => $level])
        ]);

    }
}
