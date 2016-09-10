<?php

namespace Skeleton\Models\FileSystem;

use Aws\S3\S3Client;

class S3StreamHandler implements StreamHandler
{
    private $client;

    public function __construct(S3Client $client)
    {
        $this->client = $client;
        $this->client->registerStreamWrapper();
    }

    public function pwd()
    {
        // TODO: Implement pwd() method.
    }

    public function listDirectory()
    {
        // TODO: Implement listDirectory() method.
    }

    public function createDirectory()
    {
        // TODO: Implement createDirectory() method.
    }

    public function downloadFile()
    {
        // TODO: Implement downloadFile() method.
    }

    public function uploadFile()
    {
        // TODO: Implement uploadFile() method.
    }
}
