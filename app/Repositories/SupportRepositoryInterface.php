<?php

namespace App\Repositories;
use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use stdClass;

interface SupportRepositoryInterface
{
    public function getAll(string $filter = null): array|null;
    public function findOne(string $id): stdClass|null;
    public function create(CreateSupportDTO $dto): stdClass|null;
    public function update(UpdateSupportDTO $dto): stdClass|null;
    public function delete(string $id): void;
}
