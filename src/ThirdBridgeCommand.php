<?php

namespace ThirdBridge;

use PHPUnit\Framework\Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ThirdBridge\FileProcessing\AbstractFileProcessing;
use ThirdBridge\FileProcessing\CsvFileProcessing;
use ThirdBridge\FileProcessing\XmlFileProcessing;
use ThirdBridge\FileProcessing\YmlFileProcessing;
use ThirdBridge\Model\User;

class ThirdBridgeCommand extends Command
{
    const CMD_NAME = 'thirdbridge:file-reader';

    /** @var string */
    protected $file;
    /** @var AbstractFileProcessing */
    protected $fileProcessor;
    /** @var OutputInterface */
    protected $output;

    protected function configure()
    {
        $this
            ->setName(self::CMD_NAME)
            ->setDescription('reads file in .csv .xml .yml format')
            ->setHelp('this command is just to pass a test')
            ->addArgument('file', InputArgument::REQUIRED, 'the file to be processed')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output        = $output;
        $this->file          = $input->getArgument('file');
        $this->fileProcessor = $this->fileProcessingFactory();
        while (($user = $this->fileProcessor->readNextUser())!== null){
            $this->formatOutput($user);
        }

        return 0;
    }

    protected function fileProcessingFactory(): AbstractFileProcessing
    {
        $len = strlen($this->file);
        $ext = substr($this->file, $len-4, $len);
        switch ($ext) {
            case '.csv':
                return new CsvFileProcessing($this->file);
                break;
            case '.xml':
                return new XmlFileProcessing($this->file);
                break;
            case '.yml':
                return new YmlFileProcessing($this->file);
                break;
            default:
                throw new Exception("file format not supported: {$this->file}");
        }
    }

    protected function formatOutput(User $user)
    {
        $this->output->writeln("Name    : {$user->getName()}");
        $this->output->writeln('isActive: ' . ($user->isActive()? 'true': 'false'));
        $this->output->writeln("Value   : {$user->getValue()}");
    }
}
