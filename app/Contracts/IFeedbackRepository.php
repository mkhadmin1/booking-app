<?php

namespace App\Contracts;

use App\DTO\FeedBackDTO;
use App\Models\Feedback;
use Illuminate\Http\JsonResponse;

interface IFeedbackRepository
{
    /**
     * @return JsonResponse
     */
    public function getFeedbacks(): JsonResponse;

    /**
     * @param int $feedbackId
     * @return Feedback|null
     */
    public function getFeedbackById(int $feedbackId): ?Feedback;

    public function createFeedback(FeedBackDTO $feedBackDTO): Feedback;

//    public function getFeedbackByHotelId(int $id): ?Feedback;
}
