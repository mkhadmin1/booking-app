<?php

namespace App\Repositories;

use App\Contracts\IFeedbackRepository;
use App\DTO\FeedBackDTO;
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
           'data'=> $feedbacks
       ]);
    }
    public function getFeedbackById(int $feedbackId): ?Feedback
    {
        /** @var Feedback|null $feedback */
        $feedback = Feedback::query()->find($feedbackId);

        return $feedback;
    }

    public function createFeedback(FeedBackDTO $feedBackDTO): Feedback
    {
        $feedBack = new Feedback();
        $feedBack->user_id = $feedBackDTO->getUserId();
        $feedBack->hotel_id = $feedBackDTO->getHotelId();
        $feedBack->description = $feedBackDTO->getDescription();
        $feedBack->rating = $feedBackDTO->getRating();

        $feedBack->save();
        return $feedBack;
    }



//    public function getFeedbackByHotelId(int $id): ?Feedback
//    {
//        /** @var Feedback $feedback */
//        $feedback = Feedback::query()->where('hotel_id', $id)->first();
//
//        return $feedback;
//    }
}
