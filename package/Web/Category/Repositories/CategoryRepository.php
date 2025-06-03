<?php

namespace Web\Category\Repositories;

use Web\Category\Models\Category;

class CategoryRepository implements CategoryInterface
{

    public function findById($id)
    {
       return Category::findOrFail($id);
    }

    public function getAllCategory()
    {
        return Category::all();
    }

    public function store($request)
    {
        return Category::create([
            "title" => $request->title,
            "slug" => $request->slug,
        ]);

    }
}
