<?php

namespace TsrDoc\Models\FileSystem;

interface StreamHandler
{
    public function pwd();

    public function listDirectory();

    public function createDirectory();

    public function downloadFile();

    public function uploadFile();
}
