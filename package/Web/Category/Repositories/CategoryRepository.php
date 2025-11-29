<?php

namespace Web\Category\Repositories;

use Web\Category\Contracts\CategoryInterface;
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

    public function store(array $data)
    {
        return Category::create($data);
    }

    public function update(array $data, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        return $category->delete();
    }
}
