<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Modules\Admin\Service\AdminService;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Message\Models\Message;

class AdminController extends CoreController
{
    
    private AdminService $admin_service;
    
    public function __construct(AdminService $admin_service)
    {
        $this->admin_service = $admin_service;
    }
    
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $array = $this->admin_service->index();
        
        return view('admin::index')->with('users', json_encode($array));
    }
    
    /**
     * @return JsonResponse
     */
    public function messageFive(): JsonResponse
    {
        $message = Message::whereNull('read_at')->limit(5)->get();
        
        return response()->json($message);
    }
}
