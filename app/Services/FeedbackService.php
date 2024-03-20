<?php

namespace App\Services;

use App\Contracts\IFeedbackRepository;
use App\DTO\FeedBackDTO;
use App\Models\Feedback;
use App\Repositories\FeedbackRepository;

class FeedbackService

{
    private IFeedbackRepository $repository;

    public function __construct(IFeedbackRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllFeedbacks()
    {
        return $this->repository->getFeedbacks();
    }

    public function getFeedback(int $feedbackId)
    {
        return $this->repository->getFeedbackById($feedbackId);
    }

    public function execute(FeedbackDTO $feedbackDTO): Feedback
    {
        return $this->repository->createFeedback($feedbackDTO);
    }


    public function update(FeedbackDTO $feedbackDTO, int $feedbackId)
    {
        return $this->repository->updateFeedback($feedbackDTO, $feedbackId);
    }

    public function destroy(int $feedbackId)
    {
        return $this->repository->destroyFeedback($feedbackId);
    }
}
