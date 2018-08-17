<?php

namespace App\Http\Controllers\User;

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

        if (request()->is('admin/*')) {

            return view('admin.levels.index', compact('levels'));
        }

        return view('app.levels.index', compact('levels'));

    }

    public function create()
    {
        $level = new Level();

        return view('admin.levels.create', compact('level'));
    }

    public function store(LevelRequest $request)
    {

        $validator = $request->validated();

        $level = new Level();

        return $this->saveOrUpdate($request, $level);
    }

    public function show(Level $level)
    {

        if (request()->is('admin/*')) {

            return view('admin.levels.show', compact('level'));
        }

        return view('levels.show', compact('level'));

    }

    public function edit(Level $level)
    {

        return view('admin.levels.edit', compact('level'));
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
