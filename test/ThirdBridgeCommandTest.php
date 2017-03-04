<?php

namespace ThirdBridge\test;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use ThirdBridge\ThirdBridgeCommand;

class ThirdBridgeCommandTest extends TestCase
{
    const EXP_OUTPUT = "Name    : John
isActive: true
Value   : 500
Name    : Mark
isActive: true
Value   : 250
Name    : Paul
isActive: false
Value   : 100
Name    : Ben
isActive: true
Value   : 150
";

    public function dataProviderCmdExecute()
    {
        return [
            ['data/file.csv'],
            ['data/file.yml'],
            ['data/file.xml']
        ];
    }

    /**
     * @dataProvider dataProviderCmdExecute
     *
     * @param string $filename
     */
    public function testExecute(string $filename)
    {
        $application = new Application();

        $application->add(new ThirdBridgeCommand());

        $command = $application->find(ThirdBridgeCommand::CMD_NAME);
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'file' => $filename,
        ));

        $output = $commandTester->getDisplay();
        static::assertEquals(self::EXP_OUTPUT, $output);
    }
}
