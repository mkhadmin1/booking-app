<?php

namespace App\Http\Controllers\Feedback;

use App\DTO\FeedbackDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use App\Services\FeedbackService;
use Illuminate\Http\JsonResponse;

class FeedbackController extends Controller
{
    /**
     * @param FeedbackService $service
     * @return JsonResponse
     */
    public function index(FeedbackService $service): JsonResponse
    {
        return $service->getAllFeedbacks();
    }

    /**
     * @param int $feedbackId
     * @param FeedbackService $service
     * @return \App\Models\Feedback
     */
    public function show(int $feedbackId, FeedbackService $service): Feedback
    {
        return $service->getFeedback($feedbackId);
    }

    /**
     * @param StoreFeedbackRequest $request
     * @param FeedbackService $service
     * @return JsonResponse
     */
    public function store(StoreFeedbackRequest $request, FeedbackService $service): JsonResponse
    {
        $feedbackDTO = $request->validated();
        $service->execute(FeedbackDTO::fromArray($feedbackDTO));
        return response()->json(['message' => __('feedbacks.feedback_created_success')], 201);
    }

    /**
     * @param UpdateFeedbackRequest $request
     * @param int $feedbackId
     * @param FeedbackService $service
     * @return JsonResponse
     */
    public function update(UpdateFeedbackRequest $request, int $feedbackId, FeedbackService $service): JsonResponse
    {
        $service->update(FeedbackDTO::fromArray($request->validated()), $feedbackId);
        return response()->json(['message' => __('feedbacks.feedback_updated_success')], 201);
    }

    /**
     * @param FeedbackService $service
     * @param int $feedbackId
     * @return JsonResponse
     */
    public function destroy(FeedbackService $service, int $feedbackId): JsonResponse
    {
        $service->destroy($feedbackId);
        return response()->json(['message' => __('feedbacks.feedback_deleted_success')], 201);
    }
}
