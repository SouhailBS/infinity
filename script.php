<?php

// Code 1:
interface EncoderInterface
{
    public function encode(object|array $data): string;
}

class JsonEncoder implements EncoderInterface
{
    public function encode(object|array $data): string
    {
        $data = $this->prepare($data);
        // encode to json
        return "";
    }

    private function prepare(object|array $data): array
    {
        $data = $this->forceArray($data);
        $data = $this->fixKeys($data);

        return $data;
    }
}

class XmlEncoder implements EncoderInterface
{
    public function encode(object|array $data): string
    {
        $data = $this->prepare($data);
        // encode to xml
        return "";
    }

    private function prepare(object|array $data): array
    {
        $data = $this->fixAttributes($data);

        return $data;
    }
}

class GenericEncoder
{
    public function encodeToFormat(array|object $data, EncoderInterface $encoder)
    {
        return $encoder->encode($data);
    }
}

// Code 2 : a -
interface FileInterface
{
    public function listParentsDirectory(): array;

    public function rename(string $name): void;

}

interface FileOwnerInterface extends FileInterface
{
    public function changeOwner(string $user, string $group): void;
}

class DropboxFile implements FileInterface
{
    public function listParentsDirectory(): array
    {
        //...
        return [];
    }

    public function rename(string $name): void
    {
        //...
    }
}

// b -
interface FileTypeInterface extends FileOwnerInterface
{
    public function handle(): bool;
}

class LinuxFile implements FileTypeInterface
{
    public function __construct(LinuxFile $file)
    {
        if ($file->handle() === true) {
            //...
        }
    }

    public function listParentsDirectory(): array
    {
        //...
        return [];
    }

    public function rename(string $name): void
    {
        //...
    }

    public function changeOwner(string $user, string $group): void
    {
    }

    public function handle(): bool
    {
        // ...
        return false;
    }
}