<?php

namespace Web\Category\Interfaces;

interface CategoryInterface
{

    public function findById($id);

    public function getAllCategory();

    public function store(array $data);

    public function update(array $data,$id);

    public function destroy($id);

}
