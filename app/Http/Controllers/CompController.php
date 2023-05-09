<?php

namespace App\Http\Controllers;

use App\Models\Comp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CompController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Crud";
        $comps = Comp::all();
        $i = 1;
        return view('comp.index', compact('title', 'comps', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create-Crud";
        return view('comp.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return dd($request);
        Comp::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'image'=>$request->file('image')->store('comp-image')
        ]);
        return redirect()->route('comp.index');
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
        $title = "Edit-Crud";
        $comps = Comp::findOrFail($id);
        return view('comp.edit',compact('title','comps'));
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
        if(empty($request->file('image'))){
            $comps = Comp::findOrFail($id);
            $comps->update([
                'name'=>$request->name,
                'price'=>$request->price,
            ]);
            return Redirect()->route('comp.index');
        }
        else{
            $comps = Comp::findOrFail($id);
            Storage::delete($comps->image);
            $comps->update([
                'name'=>$request->name,
                'price'=>$request->price,
                'image'=>$request->file('image')->store('comp-image')
            ]);
            return redirect()->route('comp.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comps = Comp::findOrFail($id);
        Storage::delete($comps->image);
        $comps -> delete();
        return redirect()->route('comp.index');
    }
}
