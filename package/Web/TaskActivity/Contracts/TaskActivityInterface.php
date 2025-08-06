<?php

namespace Web\TaskActivity\Contracts;

interface TaskActivityInterface
{

    public function getAll();

    public function delete($id);

}
