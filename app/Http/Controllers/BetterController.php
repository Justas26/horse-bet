<?php

namespace App\Http\Controllers;

use App\Models\Better;
use Illuminate\Http\Request;
use Validator;
use App\Models\Horse;
use Intervention\Image\ImageManagerStatic as Image;
use Str;

class BetterController extends Controller
{
    const RESULTS_IN_PAGE = 9;
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $betters = Better::orderBy('bet', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        $horses = Horse::all();
        if ($request->filter && 'horse' == $request->filter) {
            $betters = Better::where('horse_id', $request->horse_id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        }
        return view('better.index', ['betters' => $betters, 'horses' => $horses]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $horses = Horse::orderBy('name')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        return view('better.create', ['horses' => $horses]);
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
                'surname' => ['required', 'min:3', 'max:150'],
                'bet' => ['required', 'numeric', 'digits_between:0,9'],
            ],
            [
                'name.required' => 'name required',
                'surname.required' => 'suarname required',
                'bet.required' => 'bet required',
                'name.min' => 'too short better name',
                'name.max' => 'too long better name',
                'surname.min' => 'too short better suarname',
                'surname.max' => 'too long better suarname',
                'bet.digits_between' => 'Invalid bett format',

            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $better  = new Better;
        $better->name = $request->name;
        $better->surname = $request->surname;
        $better->bet = $request->bet;
        $better->horse_id = $request->horse_id;
        $better->save();
        return redirect()->route('better.index')->with('success_message', 'succesfully recorded.');
    }
    public function uploadPhoto(Better $better, Request $request)
    {
        if ($request->has('photo')) {
            $img = Image::make($request->file('photo'));
            $fileName = Str::random(5) . ".jpg";
            $folder = public_path('/betterPhoto');
            $img->resize(120, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($folder . '/' . $fileName, 80, 'jpg');
            $better->photo_name = $fileName;
            $better->save();
        }
        return redirect()->route('better.index', ['better' => $better]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function show(Better $better)
    {
        $better = Better::where('id', $better->id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        return view('better.show', ['better' => $better]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function edit(Better $better)
    {
        $horses = Horse::all();
        return view('better.edit', ['better' => $better, 'horses' => $horses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Better $better)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'min:3', 'max:100'],
                'surname' => ['required', 'min:3', 'max:150'],
                'bet' => ['required', 'numeric', 'digits_between:0,9'],
            ],
            [
                'name.required' => 'name required',
                'surname.required' => 'suarname required',
                'bet.required' => 'bet required',
                'name.min' => 'too short better name',
                'name.max' => 'too long better name',
                'surname.min' => 'too short better suarname',
                'surname.max' => 'too long better suarname',
                'bet.digits_between' => 'Invalid bett format',

            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }


        $better  = new Better;
        $better->name = $request->name;
        $better->surname = $request->surname;
        $better->bet = $request->bet;
        $better->horse_id = $request->horse_id;
        $better->save();
        return redirect()->route('better.index')->with('success_message', 'succesfully changed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Better  $better
     * @return \Illuminate\Http\Response
     */
    public function destroy(Better $better)
    {
        $better->delete();
        return redirect()->route('better.index')->with('success_message', 'succesfully deleted.');
    }
}
