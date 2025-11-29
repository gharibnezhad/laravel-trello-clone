<?php

namespace Web\Category\Services;

use Illuminate\Support\Facades\DB;
use Web\Category\Contracts\CategoryInterface;
use Web\Category\Models\Category;

class CategoryService
{
    protected $categoryRepo;

    public function __construct(CategoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function storeCategory(array $data)
    {
        DB::transaction(function () use ($data){
            return $this->categoryRepo->store($data);
        });
    }

    public function updateCategory(array $data,Category $category)
    {
        DB::transaction(function () use ($data,$category){
            return $this->categoryRepo->update($data,$category->id);
        });
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepo->destroy($id);
    }
}
