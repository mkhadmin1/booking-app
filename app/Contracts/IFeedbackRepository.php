<?php

namespace App\Contracts;

use App\DTO\FeedbackDTO;
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

    public function createFeedback(FeedbackDTO $feedbackDTO): Feedback;

    public function updateFeedback(FeedbackDTO $feedbackDTO, int $id): Feedback;

    public function destroyFeedback(int $feedbackId);
}
