<?php

namespace ThirdBridge\FileProcessing;

use ThirdBridge\Model\User;

interface FileProcessingInterface
{
    public function readNextUser():? User;
}
