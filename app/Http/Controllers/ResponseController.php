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
			->select('keywords.chat_keyword', 'responses.id', 'responses.chat_response')
            ->where('responses.status',1)
            ->where('keywords.status',1)
			->paginate(3);

		return view('admin.response.index', $data);
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
		$validator = Validator::make(
			$request->all(),
			[
				'keywords_id'   => 'required|integer',
				'chat_response' => 'required|string',
            ],
            [
                'keywords_id.required'   => 'Keyword is Required',
                'keywords_id.integer'    => 'The Keyword Must be in Integer',
                'chat_response.required' => 'Response is Required',
                'chat_response.string'   => 'Response Must be in String(A-Z)',
            ]
		);

		if ($validator->passes()) {
			Response::create(
				[
					'keywords_id'   => $request->keywords_id,
					'chat_response' => $request->chat_response,
				]
			);

			return response()->json(
				[
					'status'  => 200,
					'message' => 'Response Created Successfully'
				]
			);
		} else {
			return response()->json(
				[
					'status' => 400,
					'errors' => $validator->messages()
				]
			);
		}

	}

	/**
     * Display the specified resource.
     */
    public function show(Response $response) {
        //
	}

	/**
     * Show the form for editing the specified resource.
     */
	public function edit(Response $response) {

        $data['keywords'] = Keyword::select('id','chat_keyword')
                                     ->where('status',1)
                                     ->get();
        $data['response'] = Response::find($response->id);
        return view('admin.response.edit',$data);
	}

	/**
     * Update the specified resource in storage.
     */
	public function update(Request $request, Response $response) {
         //dd($request->all());
         $validator = Validator::make(
			$request->all(),
			[
				'keywords_id'   => 'required|integer',
				'chat_response' => 'required|string',
            ],
            [
                'keywords_id.required'   => 'Keyword is Required',
                'keywords_id.integer'    => 'The Keyword Must be in Integer',
                'chat_response.required' => 'Response is Required',
                'chat_response.string'   => 'Response Must be in String(A-Z)',
            ]
		);

        if ($validator->passes()) {

            $response->update([
                'keywords_id'   => $request->keywords_id,
                'chat_response' => $request->chat_response,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Response Update Successfully'
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
	public function destroy(Response $response) {
        
        $Response = Response::find($response->id);

        if ($Response) {
            // $Response->status = 0;
            // $Response->save();
            $Response->delete();

            return response()->json(['status'=>200,'message'=>'Response Deleted Successfully']);
        } else {
            return response()->json(['status'=>404,'message'=>'Response Not found']);

        }
	}


    // pagination
    public function pagination()
    {
		$data['responses'] = Response::join('keywords', 'keywords.id', '=', 'responses.keywords_id')
			->select('keywords.chat_keyword', 'responses.id', 'responses.chat_response')
            ->where('responses.status',1)
            ->where('keywords.status',1)
			->paginate(3);
        return view('admin.response.pagination',$data);
    }
}
