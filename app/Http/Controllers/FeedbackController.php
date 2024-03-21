<?php

namespace App\Http\Controllers;


use App\DTO\FeedbackDTO;
use App\Http\Resources\FeedbackResource;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Models\Feedback;
use App\Services\FeedbackService;
use Illuminate\Http\JsonResponse;

class FeedbackController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(FeedbackService $service): JsonResponse
    {
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
        $feedbackDTO = $request->validated();
        $service->execute(FeedbackDTO::fromArray($feedbackDTO));
        return response()->json(['message' => __('feedbacks.feedback_created_success')], 201);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackRequest $request, $feedbackId, FeedbackService $service)
    {
        $service->update(FeedbackDTO::fromArray($request->validated()), $feedbackId);

    }

    public function destroy(FeedbackService $service, $feedbackId)
    {
        $service->destroy($feedbackId);

    }

    /**
     * Remove the specified resource from storage.
     */


}
