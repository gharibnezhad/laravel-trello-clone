<?php
namespace Web\TaskActivity\Http\Controllers;



use App\Http\Controllers\Controller;
use Web\TaskActivity\Models\TaskActivity;
use Web\TaskActivity\Services\TaskActivityService;

class TaskActivityController extends Controller
{

    protected $activitiyService;

    public function __construct(TaskActivityService $activityService)
    {
        $this->activitiyService = $activityService;
    }

    public function index()
    {
        $this->authorize('index',TaskActivity::class);
        $taskActivities = $this->activitiyService->all();
        return view('TaskActivities::index',compact('taskActivities'));
    }

    public function destroy($id)
    {
        $this->authorize('index',TaskActivity::class);
        $this->activitiyService->delete($id);
        return redirect()->route('taskActivities.index');
    }
}
