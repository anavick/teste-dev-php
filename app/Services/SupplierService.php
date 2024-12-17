<?php

namespace App\Services;

use App\Repository\SupplierRepository;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getSuppliers(array $filters)
    {
        return $this->supplierRepository->getAll($filters);
    }

    public function showSupplier(int $id)
    {
        return $this->supplierRepository->findById($id);
    }

    public function createSupplier(array $data)
    {
        return $this->supplierRepository->create($data);
    }

    public function updateSupplier(int $id, array $data)
    {
        return $this->supplierRepository->update($id, $data);
    }

    public function deleteSupplier(int $id)
    {
        return $this->supplierRepository->delete($id);
    }
}
