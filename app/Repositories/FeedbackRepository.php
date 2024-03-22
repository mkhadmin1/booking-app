<?php

namespace App\Repositories;

use App\Contracts\IFeedbackRepository;
use App\DTO\FeedbackDTO;
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

        return Feedback::query()->find($feedbackId);
    }

    /**
     * @param FeedbackDTO $feedbackDTO
     * @return Feedback
     */
    public function createFeedback(FeedbackDTO $feedbackDTO): Feedback
    {
        $feedback = new Feedback();
        $feedback->user_id = $feedbackDTO->getUserId();
        $feedback->hotel_id = $feedbackDTO->getHotelId();
        $feedback->description = $feedbackDTO->getDescription();
        $feedback->rating = $feedbackDTO->getRating();

        $feedback->save();
        return $feedback;
    }

    /**
     * @param FeedbackDTO $feedbackDTO
     * @param int $feedbackId
     * @return Feedback
     */
    public function updateFeedback(FeedbackDTO $feedbackDTO, int $feedbackId): Feedback
    {
        $feedback = Feedback::find($feedbackId);

        $feedback->user_id = $feedbackDTO->getUserId();
        $feedback->hotel_id = $feedbackDTO->getHotelId();
        $feedback->description = $feedbackDTO->getDescription();
        $feedback->rating = $feedbackDTO->getRating();

        $feedback->update();

        return $feedback;
    }

    /**
     * @param int $feedbackId
     * @return void
     */
    public function destroyFeedback(int $feedbackId)
    {

        $feedback = Feedback::find($feedbackId);
        $feedback->delete();
    }


}
