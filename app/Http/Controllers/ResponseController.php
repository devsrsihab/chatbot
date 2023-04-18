<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\Response;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['responses'] = Response::join('keywords', 'keywords.id', '=', 'responses.keywords_id')
                                        ->get(
                                                [
                                                    'keywords.chat_keyword', 
                                                    'responses.id',
                                                    'responses.chat_response'
                                                ]
                                            );
        return view('admin.response.view',$data);
        // $userText ='Hey';
        // $responses = Response::join('keywords', 'keywords.id', '=', 'responses.keywords_id')
        // ->where('keywords.chat_keyword','like',"%$userText%")
        // ->limit(1)
        // ->inRandomOrder()
        // ->get(['responses.chat_response'])
        // ->toArray();  

        // dd($responses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['keywords'] = Keyword::get();
        return view('admin.response.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keywords_id'  => 'required|integer',
            'chat_response'  => 'required|string',
        ]);

        if ($validator->passes()) {
            Response::create([
                'keywords_id'     => $request->keywords_id,
                'chat_response'     => $request->chat_response,
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
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        //
    }
}
