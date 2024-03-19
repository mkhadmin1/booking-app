<?php

namespace App\Http\Controllers;

use App\Contracts\IFeedbackRepository;
use App\DTO\FeedBackDTO;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Repositories\FeedbackRepository;
use App\Services\CreateFeedbackService;

class FeedbackController extends Controller
{

    private IFeedbackRepository $repository;

    public function __construct()
    {
        $this->repository = new FeedbackRepository();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->getFeedbacks();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedbackRequest $request)

    {
        $service = new CreateFeedbackService();
        $feedback = $service->execute(FeedBackDTO::fromArray($request->validated()));

        return new FeedbackResource($feedback);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $feedbackId)
    {
        $feedback = $this->repository->getFeedbackById($feedbackId);
        return new FeedbackResource($feedback);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */



}
