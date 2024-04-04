<?php

namespace App\Services;

use App\Contracts\IFeedbackRepository;
use App\DTO\FeedBackDTO;
use App\Exceptions\BusinessException;
use App\Exceptions\ModelNotFoundException;
use App\Models\Feedback;
use Illuminate\Http\JsonResponse;

class FeedbackService

{
    private IFeedbackRepository $repository;

    public function __construct(IFeedbackRepository $repository)
    {
        $this->repository = $repository;
    }


    public function getFeedback(int $feedbackId): ?Feedback
    {
        $feedback = $this->repository->getFeedbackById($feedbackId);
        if (!$feedback) {
            throw new ModelNotFoundException(__('feedbacks.feedback_not_found'));
        }
        return $feedback;
    }

    public function execute(FeedbackDTO $feedbackDTO): Feedback
    {
        try {
            $feedback = new Feedback();
            $feedback->user_id = $feedbackDTO->getUserId();
            $feedback->hotel_id = $feedbackDTO->getHotelId();
            $feedback->description = $feedbackDTO->getDescription();
            $feedback->rating = $feedbackDTO->getRating();
            return $this->repository->createFeedback($feedback);
        }  catch (\Exception $e) {
            throw new BusinessException(__('feedbacks.failed_to_create_feedback'));
        }
    }


    public function update(FeedbackDTO $feedbackDTO, int $feedbackId)
    {
        $feedback = $this->repository->updateFeedback($feedbackDTO, $feedbackId);
        if (!$feedback) {
            throw new ModelNotFoundException(__('feedbacks.feedback_not_found'));
        }
        try {
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

    public function deleteFeedback(int $feedbackId)
    {
        return $this->repository->destroyFeedback($feedbackId);
    }
}
