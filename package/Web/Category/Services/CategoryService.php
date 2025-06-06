<?php

namespace Web\Category\Services;

use Web\Category\Contracts\CategoryInterface;

class CategoryService
{
    protected $categoryRepo;

    public function __construct(CategoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function storeCategory($request)
    {
        $data = [
            "title" => $request->title,
            "slug" => $request->slug,
        ];

        return $this->categoryRepo->store($data);
    }

    public function updateCategory($request,$id)
    {
        $category = $this->categoryRepo->findById($id);

        $data = [
            "name" => $request->filled('name') ? $request->name : $category->name,
            "slug" => $request->filled('slug') ? $request->slug : $category->slug,
        ];

        return $this->categoryRepo->update($data,$id);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepo->destroy($id);
    }
}
