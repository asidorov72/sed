<?php
/**
 * @author Alexander Sidorov
 * @email alexsidorov1972@gmail.com
 * @date 16-05-2022
 */

namespace Console\App\Test;

use Console\App\Helper\FileHelper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Console\App\Command\SedCommand;
use Console\App\Helper\StringHelper;

class SedCommandTest extends TestCase
{
    const TEST_FILE_NAME = 'test.txt';

    public function testExecuteSuccess()
    {
        $application = new Application();
        $application->add(new SedCommand());

        $command = $application->find('sed');
        $commandTester = new CommandTester($command);

        // Generates mock text
        $text = StringHelper::generateRandomText();
        // Put it into the test file
        $file = FileHelper::setRealPath(self::TEST_FILE_NAME);
        file_put_contents($file, $text);

        $textArr = explode(' ', $text);
        $search = $textArr[0];
        $replace = $textArr[1];

        $res = $commandTester->execute(
            [
                'command' => $command->getName(),
                'parameters' => "s/$search/$replace/",
                'filename' => 'test.txt'
            ]
        );

        $this->assertTrue($res === 0);
    }

    public function testExecuteFailed()
    {
        $application = new Application();
        $application->add(new SedCommand());

        $command = $application->find('sed');
        $commandTester = new CommandTester($command);

        $res = $commandTester->execute(
            [
                'command' => $command->getName(),
                'parameters' => 'wrong_parameters',
                'filename' => 'nofile.txt'
            ]
        );

        $this->assertTrue($res === 2);
    }
}