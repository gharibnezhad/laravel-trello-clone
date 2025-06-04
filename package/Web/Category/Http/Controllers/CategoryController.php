<?php

namespace Web\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Category\Repositories\CategoryRepository;
use Web\Category\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryRepo;
    protected $categoryService;

    public function __construct(CategoryRepository $categoryRepo,CategoryService $categoryService)
    {
        $this->categoryRepo = $categoryRepo;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryRepo->getAllCategory();
        return view('Category::index',compact('categories'));
    }


    public function store(Request $request)
    {
        $this->categoryService->storeCategory($request);

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = $this->categoryRepo->findById($id);

        return view('Category::edit',compact('category'));
    }


    public function update(Request $request,$id)
    {
        $this->categoryService->updateCategory($request,$id);

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect()->route('categories.index');
    }
}
