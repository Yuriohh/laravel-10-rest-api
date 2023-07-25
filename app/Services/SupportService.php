<?php

namespace App\Services;
use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Repositories\SupportRepositoryInterface;
use stdClass;

class SupportService
{
    public function __construct(protected SupportRepositoryInterface $repository)
    {}

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null)
    {
        return $this->repository->paginate(
            page: 1,
            totalPerPage: 15,
            filter: null
        );
    }

    public function getAll(string $filter = null): array|null
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    
    public function create(CreateSupportDTO $dto): stdClass|null
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateSupportDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }
}