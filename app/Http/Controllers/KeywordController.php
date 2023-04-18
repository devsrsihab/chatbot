<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['keywords'] = Keyword::get();
        return view('admin.keyword.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.keyword.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'chat_keyword'  => 'required|string'
        ]);

        if ($validator->passes()) {

            // $obj = new BlogCategory();
            // $obj->name = $request->name;
            // $obj->valid = $request->valid;
            // $obj->save();

            Keyword::create([
                'chat_keyword'     => $request->chat_keyword
            ]);
      Toastr::success('Keyword Created Successfully', 'Success');

    } else {
        $errMsgs = $validator->messages();
        foreach ($errMsgs->all() as $msg) {
            Toastr::error($msg, 'Required');
        }
    }

    return redirect()->back();
}

    /**
     * Display the specified resource.
     */
    public function show(Keyword $keyword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keyword $keyword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keyword $keyword)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keyword $keyword)
    {
        //
    }
}
