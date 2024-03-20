<?php

namespace App\Http\Controllers;

use App\Contracts\IFeedbackRepository;
use App\DTO\FeedbackDTO;
use App\Exceptions\InvalidFeedbackException;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Repositories\FeedbackRepository;
use App\Services\FeedbackService;
use Illuminate\Support\Facades\Lang;

class FeedbackController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(FeedbackService $service)
    {
//        $service = new FeedbackService();
        return $service->getAllFeedbacks();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $feedbackId, FeedbackService $service)
    {
        $feedback = $service->getFeedback($feedbackId);
        return new FeedbackResource($feedback);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedbackRequest $request, FeedbackService $service)

    {
        try {
            $feedbackDTO = $request->validated();
            $feedback = $service->execute(FeedbackDTO::fromArray($feedbackDTO));
            return response()->json(['message' => __('feedbacks.feedback_created_success')], 201);
        } catch (InvalidFeedbackException $e) {
            return throw new $e(__('feedbacks.invalid_feedback'), 400);
        }

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackRequest $request, $feedbackId, FeedbackService $service)
    {
//        try {
//            return $service->updateFeedback(FeedbackDTO::fromArray($request->validated()), $feedbackId);
//        }

    }

    public function destroy(FeedbackService $service, $feedbackId)
    {
        $service->destroy($feedbackId);

    }

    /**
     * Remove the specified resource from storage.
     */


}
