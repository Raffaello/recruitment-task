<?php

namespace ThirdBridge\FileProcessing;

use Symfony\Component\Config\Loader\FileLoader;
use ThirdBridge\Model\User;

abstract class AbstractFileProcessing implements FileProcessingInterface
{
    /** @var string */
    protected $fileName;
    /** @var array */
    protected $users;
    /** @var  int */
    protected $totalUsers;
    /** @var int */
    protected $currentUser;

    public function __construct(string $filename)
    {
        $this->fileName = $filename;
        if (false === $this->fileExists()) {
            throw new \Exception("The file {$filename} doesn't exists.");
        }

        $this->currentUser = 0;
        $this->readFile();
        $this->totalUsers = count($this->users);
    }

    protected function fileExists(): bool
    {
        return file_exists($this->fileName);
    }

    abstract protected function readFile();

    public function readNextUser():? User
    {
        if ($this->currentUser >= $this->totalUsers) {
            return null;
        }

        $aUser = $this->users[$this->currentUser++];

        return new User($aUser['name'], $aUser['active'], $aUser['value']);
    }
}
