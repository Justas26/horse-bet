<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Str;


class HorseController extends Controller
{
    const RESULTS_IN_PAGE = 8;
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horses = Horse::orderBy('name', 'asc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        return view('horse.index', ['horses' => $horses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('horse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'min:3', 'max:100'],
                'runs' => ['required', 'digits_between:0,9'],
                'wins' => ['required', 'digits_between:0,9'],

            ],
            [
                'name.required' => 'horse `name` required',
                'runs.required' => 'horse running required',
                'wins.required' => 'horse winnig required',
                'runs.digits_between' => 'invalid run number',
                'wins.digits_between' => 'invalid winning number',


            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        if ($request->runs > $request->wins) {
            return redirect()->route('horse.create')->with('info_message', 'information cant be recorded.');
        } else {
            $horse = new Horse();
            $horse->name = $request->name;
            $horse->runs = $request->runs;
            $horse->wins = $request->wins;
            $horse->about = $request->about;
            $horse->save();
            return redirect()->route('horse.index')->with('success_message', 'succesfully recorded.');
        }
    }
    public function uploadPhoto(Horse $horse, Request $request)
    {
        if ($request->has('photo')) {
            $img = Image::make($request->file('photo'));
            $fileName = Str::random(5) . ".jpg";
            $folder = public_path('/horsePhoto');
            $img->resize(120, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($folder . '/' . $fileName, 80, 'jpg');
            $horse->photo_name = $fileName;
            $horse->save();
        }
        return redirect()->route('horse.index', ['horse' => $horse]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function show(Horse $horse)
    {
        $horse = Horse::where('id', $horse->id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        return view('horse.show', ['horse' => $horse]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function edit(Horse $horse)
    {
        return view('horse.edit', ['horse' => $horse]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horse $horse)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'min:3', 'max:100'],
                'runs' => ['required', 'digits_between:0,9'],
                'wins' => ['required', 'digits_between:0,9'],

            ],
            [
                'name.required' => 'horse `name` required',
                'runs.required' => 'horse running required',
                'wins.required' => 'horse winnig required',
                'runs.digits_between' => 'invalid run number',
                'wins.digits_between' => 'invalid winning number',


            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        if ($request->runs > $request->wins) {
            return redirect()->route('horse.create')->with('info_message', 'information cant be recorded.');
        } else {
            $horse = new Horse();
            $horse->name = $request->name;
            $horse->runs = $request->runs;
            $horse->wins = $request->wins;
            $horse->about = $request->about;
            $horse->save();
            return redirect()->route('horse.index')->with('success_message', 'succesfully deleted.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Horse  $horse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horse $horse)
    {
        if ($horse->horses()->count()) {
            return 'Trinti negalima, nes turi priskirtu siuntu';
        }
        $horse->delete();
        return redirect()->route('horse.index');
    }
}
