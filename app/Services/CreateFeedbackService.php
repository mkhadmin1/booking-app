<?php

namespace App\Services;

use App\Contracts\IFeedbackRepository;
use App\DTO\FeedBackDTO;
use App\Models\Feedback;
use App\Repositories\FeedbackRepository;

class CreateFeedbackService

{
    private IFeedbackRepository $repository;
    public function __construct() {
        $this->repository = new FeedbackRepository();
    }

    public function execute(FeedBackDTO $feedBackDTO): Feedback
    {
        return $this->repository->createFeedback($feedBackDTO);
    }
}
