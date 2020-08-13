<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use Validator;
use App\Http\Resources\Feedback as FeedbackResource;

class FeedbackController extends Controller
{

    public $successStatus = 200;


    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedback::all();

        return $this->sendResponse(FeedbackResource::collection($feedbacks), 'All feedbacks retrieved successfully.');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'topic' => 'required',
            'feedback' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $feedbacks = Feedback::create($input);

        return $this->sendResponse(new FeedbackResource($feedbacks), 'Feedback created successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feedback = Feedback::find($id);
        if(is_null($feedback)){
            return $this->sendError('Feedback not found.');
        }

        return $this->sendResponse(new FeedbackResource($feedback), 'Feedback retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        $feedback = Feedback::find($id);


        $validator = Validator::make($request->all(),[
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $data = $request->all();
        $feedback->update($data);

        return $this->sendResponse(new FeedbackResource($feedback), 'feedback updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return $this->sendResponse([], 'Feedback deleted successfully.');
    }
}
