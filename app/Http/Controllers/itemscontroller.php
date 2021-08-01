<?php

namespace App\Http\Controllers;

use App\Models\item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class itemscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=\App\Models\item::all();
        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'text'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect('api/items')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        else{

            $item=new item;
            $item->text=$request->input('text');
            $item->body=$request->input('body');
            $item->save();
            return response()->json($item);

        }

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
    
        $validator=Validator::make($request->all(),[
            'text'=>'required'
        ]);

        if ($validator->fails()) {
            return redirect('api/items')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        else{

            $item=item::find($id);
            $item->text=$request->input('text');
            $item->body=$request->input('body');
            $item->save();
            return response()->json($item);

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
        $item=item::find($id);
        $item->delete();

        return array('response'=>'item deleted','success'=>'item removed');
    }
}
