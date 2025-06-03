<?php

namespace Web\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Category\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->getAllCategory();
        return view('Category::index',compact('categories'));
    }


    public function store(Request $request)
    {
        $this->categoryRepo->store($request);

        return redirect()->route('categories');
    }
}
