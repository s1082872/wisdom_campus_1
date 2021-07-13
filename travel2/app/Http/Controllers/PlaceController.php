<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Support\Facades\Gate;
class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Gate::allows('admin')) {

            $places = Place::all();

            return view('places.index', compact('places'));

        }
        if (Gate::allows('user')) {

            $places = Place::all();

            return view('places.userindex', compact('places'));

        }
        $places = Place::all();

        return view('places.userview', compact('places'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    { 
        return view('places.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([ 
            'name'=>'required', 
            'input'=>'required', 
            'photo' => 'required|image|max:2048' 
        ]);
        // * 讀取 upload file
        $image = $request->file('photo');
        // * 存檔 image
        $new_name = 'place_' . now()->format('YmdHis'). rand() . '.' . $image->getClientOriginalExtension();
        $image->move( public_path('images'), $new_name);
        // * 更新對應欄位
        $place = new Place([ 
            'name' => $request->get('name'), 
            'input' => $request->get('input'), 
            'photo_path' => $new_name
        ]); 
        
        $place->save(); 
        return redirect('/places')->with('success', '景點OK！'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $place = Place::find($id);
        
        return view('edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name'=>'required',
            'input'=>'required'
        ]);
        $place = Place::find($id);
        $place->name = $request->get('name');
        $place->input = $request->get('input');
        $place->save(); 
        return redirect('/places')->with('success', '更新OK！');
        $this->authorize('update', $place);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(Gate::allows('admin')){
           $place = Place::find($id);

        $place->delete();

        return redirect('/places')->with('success', 'place deleted!'); 
        }
        if (Gate::denies('admin')) {

            return '非系統管理者！';

        }
        
    }
}
