<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $levels = Level::all();

        if (\Request::is('admin/levels')) {

            return view('levels.index', compact('levels'));
        }

        return view('levels.index', compact('levels'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('levels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $this->validateData($request);

        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json([

                    'status' => false,
                ]);

            }

            return redirect('/levels/create')

                ->withErrors($validator)

                ->withInput();
        }

        $level = new Level();

        $level = $this->saveOrUpdate($request, $level);

        if ($request->ajax()) {

            return response()->json([

                'status' => true,

                'level' => $level,
            ]);
        }

        return redirect('levels');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        return view('levels.show', compact('level'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        return view('levels.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {

        $validator = $this->validateData($request);

        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json([

                    'status' => false,
                ]);

            }

            return redirect('/levels/edit')

                ->withErrors($validator)

                ->withInput();
        }

        $level = $this->saveOrUpdate($request, $level);

        if ($request->ajax()) {

            return response()->json([

                'status' => true,

                'level' => $level,
            ]);
        }

        return redirect('levels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        $level->delete();
    }

    private function validateData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        return $validator;
    }

    private function saveOrUpdate(Request $request, Level $level)
    {
        $level->name = $request->name;

        $level->slug = str_slug($request->name);

        $level->description = $request->description;

        $level->save();

        return $level;
    }
}
