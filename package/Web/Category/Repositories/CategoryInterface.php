<?php

namespace Web\Category\Repositories;

interface CategoryInterface
{

    public function findById($id);

    public function getAllCategory();

}
