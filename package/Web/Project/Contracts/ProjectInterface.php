<?php

namespace Web\Project\Contracts;

interface ProjectInterface
{

    public function findById($id);

    public function getAllProject();


    public function update(array $data,$id);

    public function store(array $data);

    public function destroy($id);
}
