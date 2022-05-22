<?php

namespace Console\App\Service;

interface ICommandHandler
{
    public function handle(array $params):array;
}