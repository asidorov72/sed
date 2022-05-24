<?php
/**
 * src/App/Command/ISedCommand.php
 *
 * @author Alexander Sidorov
 * @email alexsidorov1972@gmail.com
 * @date 16-05-2022
 */

namespace Console\App\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface ISedCommand
{
    public function configure();
    public function execute(InputInterface $input, OutputInterface $output);
}