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
    public function getFeedbackById(int $feedbackId): ?Feedback
    {

        return Feedback::find($feedbackId);
    }

    /**
     * @param FeedbackDTO $feedbackDTO
     * @return Feedback
     * @throws BusinessException
     */
    public function createFeedback($feedback): Feedback
    {
        $feedback->save();
        return $feedback;
    }

    /**
     * @param FeedbackDTO $feedbackDTO
     * @param int $feedbackId
     * @return Feedback
     * @throws ModelNotFoundException
     */
    public function updateFeedback($feedbackId): Feedback
    {
        return Feedback::find($feedbackId);

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
