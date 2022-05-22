<?php

namespace Console\App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Console\App\Service\SedCommandService;
use Console\App\Validator\SedCommandValidator;

class SedCommand extends Command implements ISedCommand
{
    /**
     * @var SedCommandService $sedCommandService
     */
    private $sedCommandService;

    const FLAG_IGNORE = 'ignore-output';

    public function __construct(string $name = null)
    {
        parent::__construct($name);

        $this->sedCommandService = new SedCommandService(new SedCommandValidator());
    }

    public function configure()
    {
        $this->setName('sed')
            ->setDescription('Sed command.')
            ->addArgument('parameters', InputArgument::REQUIRED, 'Pass the replacement parameters.')
            ->addArgument('filename', InputArgument::REQUIRED, 'Pass the filename.')
            ->addOption('i', null, InputOption::VALUE_OPTIONAL,'Do not output the file content.', false);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $params['command'] = $input->getArgument('command');
        $params['parameters'] = $input->getArgument('parameters');
        $params['filename'] = $input->getArgument('filename');
        $params['flag-ignore'] = null;

        $flag = $input->getOption('i');

        if ($flag !== false) {
            $params['flag-ignore'] = self::FLAG_IGNORE;
        }

        try {
            $res = $this->sedCommandService->handle($params);
            $output->writeln($this->sedCommandService->outputResult($res));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return 1;
    }
}
