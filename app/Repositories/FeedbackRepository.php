<?php

namespace App\Repositories;

use App\Contracts\IFeedbackRepository;
use App\DTO\FeedbackDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelNotFoundException;
use App\Models\Feedback;
use Illuminate\Http\JsonResponse;

class FeedbackRepository implements IFeedbackRepository
{
    /**
     * @return JsonResponse
     */
    public function getFeedbacks(): JsonResponse
    {
        /** @var array $feedbacks */
        $feedbacks = Feedback::all();

        return response()->json([
            'data' => $feedbacks
        ]);
    }

    public function getFeedbackById(int $feedbackId): ?Feedback
    {

        $feedback = Feedback::find($feedbackId);
        if (!$feedback) {
            throw new ModelNotFoundException(__('feedbacks.feedback_not_found'));
        }
        return $feedback;
    }

    /**
     * @param FeedbackDTO $feedbackDTO
     * @return Feedback
     */
    public function createFeedback(FeedbackDTO $feedbackDTO): Feedback
    {
        try {
            $feedback = new Feedback();
            $feedback->user_id = $feedbackDTO->getUserId();
            $feedback->hotel_id = $feedbackDTO->getHotelId();
            $feedback->description = $feedbackDTO->getDescription();
            $feedback->rating = $feedbackDTO->getRating();
            $feedback->save();
            return $feedback;
        }  catch (\Exception $e) {
            throw new BusinessException(__('feedbacks.failed_to_create_feedback'));
        }
    }

    /**
     * @param FeedbackDTO $feedbackDTO
     * @param int $feedbackId
     * @return Feedback
     * @throws ModelNotFoundException
     */
    public function updateFeedback(FeedbackDTO $feedbackDTO, int $feedbackId): Feedback
    {
        $feedback = Feedback::find($feedbackId);
        if (!$feedback) {
            throw new ModelNotFoundException(__('feedbacks.feedback_not_found'));
        }
        try {
            $feedback->user_id = $feedbackDTO->getUserId();
            $feedback->hotel_id = $feedbackDTO->getHotelId();
            $feedback->description = $feedbackDTO->getDescription();
            $feedback->rating = $feedbackDTO->getRating();
            $feedback->update();
            return $feedback;

        }  catch (\Exception $e) {
            throw new BusinessException(__('feedbacks.failed_to_create_feedback'));
        }
    }

    /**
     * @param int $feedbackId
     * @return void
     * @throws ModelNotFoundException
     */
    public function destroyFeedback(int $feedbackId)
    {

        $feedback = Feedback::find($feedbackId);
        if (!$feedback) {
            throw new ModelNotFoundException(__('feedbacks.feedback_not_found'));
        }
        $feedback->delete();
    }


}
