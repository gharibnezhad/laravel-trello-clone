<?php

namespace Web\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use Web\Report\Http\Requests\SearchNameTaskListsRequest;
use Web\Report\Services\ReportService;


class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(SearchNameTaskListsRequest $request)
    {
        $data = $this->reportService->loadReportPageData($request->name);
        return view('Report::index', $data);
    }

    public function getAllTasksUsers()
    {
        $users = $this->reportService->getTasksUsers();
        return view('Report::reportTaskUsers', compact('users'));
    }


}
