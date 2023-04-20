<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
class KeywordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['keywords'] = Keyword::select('chat_keyword','id')->where('status',1)->paginate(3);
        return view('admin.keyword.index',$data);
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

            Keyword::create([
                'chat_keyword'  => $request->chat_keyword
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'keyword Created Successfully'
            ]);

        } else {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        
        }


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
        $data['keyword'] = Keyword::find($keyword->id);
        return view('admin.keyword.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keyword $keyword)
    {
         //dd($request->all());
         $validator = Validator::make($request->all(), [
            'chat_keyword'  => 'required|string'
        ]);

        if ($validator->passes()) {

            $keyword->update([
                'chat_keyword'  => $request->chat_keyword
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'keyword Update Successfully'
            ]);

        } else {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keyword $keyword)
    {
        $Keyword = Keyword::find($keyword->id);

        if ($Keyword) {
            // $Keyword->status = 0;
            // $Keyword->save();
            $Keyword->delete();
            return response()->json(['status'=>200,'message'=>'Keyword Deleted Successfully']);
        } else {
            return response()->json(['status'=>404,'message'=>'Keyword Not found']);

        }
    }

    // pagination
    public function pagination()
    {
    $data['keywords'] = Keyword::select('chat_keyword','id')->where('status',1)->paginate(3);
    return view('admin.keyword.pagination',$data);
    }
}
