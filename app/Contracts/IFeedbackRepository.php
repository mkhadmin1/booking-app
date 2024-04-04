<?php

namespace App\Contracts;

use App\DTO\FeedbackDTO;
use App\Models\Feedback;
use Illuminate\Http\JsonResponse;

interface IFeedbackRepository
{
    public function getFeedbackById(int $feedbackId): ?Feedback;

    public function createFeedback($feedback);

    public function updateFeedback($feedbackId);

    public function destroyFeedback(int $feedbackId);
}
