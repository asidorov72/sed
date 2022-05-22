<?php

namespace Console\App\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface ISedCommand
{
    public function configure();
    public function execute(InputInterface $input, OutputInterface $output);
}