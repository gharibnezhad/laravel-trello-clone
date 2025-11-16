<?php

namespace Web\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Web\Category\Models\Category;
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
        $this->authorize('index',Category::class);
        $categories = $this->categoryRepo->getAllCategory();
        return view('Category::panel.index',compact('categories'));
    }

    public function show(Category $category)
    {
        // todo show single category
    }


    public function store(Request $request)
    {
        $this->authorize('index',Category::class);
        $this->categoryService->storeCategory($request);
        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        $category = $this->categoryRepo->findById($category->id);
        $this->authorize('index',$category);
        return view('Category::panel.edit',compact('category'));
    }


    public function update(Request $request,Category $category)
    {
        $this->authorize('index',$category);
        $this->categoryService->updateCategory($request,$category->id);
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $this->authorize('index',$category);
        $this->categoryService->deleteCategory($category->id);
        return redirect()->route('categories.index');
    }
}
