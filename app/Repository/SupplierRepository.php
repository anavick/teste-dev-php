<?php

namespace App\Repository;

use App\Models\Supplier;
use App\Services\BrasilApiService;
use Exception;

class SupplierRepository
{
    private $brasilApiService;

    public function __construct(BrasilApiService $brasilApiService)
    {
        $this->brasilApiService = $brasilApiService;
    }

    public function findByCnpj(string $cnpj)
    {
        try {
            $cnpjInfo = $this->brasilApiService->getCnpjInfo($cnpj);

            return [
                'name_company' => $cnpjInfo['razao_social'] ?? null,
                'trading_name' => $cnpjInfo['nome_fantasia'] ?? null,
                'cnpj' => $cnpjInfo['cnpj'] ?? null,
                'address' => $cnpjInfo['logradouro'] ?? null,
                'number' => $cnpjInfo['numero'] ?? null,
                'complement' => $cnpjInfo['complemento'] ?? null,
                'neighborhood' => $cnpjInfo['bairro'] ?? null,
                'city' => $cnpjInfo['municipio'] ?? null,
                'state' => $cnpjInfo['uf'] ?? null,
                'zip_code' => $cnpjInfo['cep'] ?? null,
                'phone' => $cnpjInfo['ddd_telefone_1'] ?? null,
                'email' => $cnpjInfo['email'] ?? null
            ];
        } catch(Exception $exception) {
            throw new Exception('Erro ao consultar CNPJ :( ' . $exception->getMessage());
        }
    }

    public function getAll(array $filters)
    {
        try {
            $builder = Supplier::query();

            if (!empty($filters['name_company'])) {
                $builder->where('name_company', 'like', '%' . $filters['name_company'] . '%');
            }

            if (isset($filters['ativo'])) {
                $builder->where('ativo', $filters['ativo']);
            }

            return $builder->orderBy('id', 'asc')->paginate(15);
        } catch(Exception $exception) {
            throw new Exception('Erro ao listar fornecedores :( ' . $exception->getMessage());
        }
    }

    public function findById(int $id)
    {
        try {
            $supplier = Supplier::find($id);

            if (!$supplier) {
                throw new Exception('Fornecedor não encontrado :( ');
            }
            return $supplier;
        } catch(Exception $exception) {
            throw new Exception('Erro ao buscar fornecedor :( ' . $exception->getMessage());
        }
    }

    public function existsByCnpj(string $cnpj): bool
    {
        return Supplier::where('cnpj', $cnpj)->exists();
    }

    public function create(array $data)
    {
        try {
            if ($this->existsByCnpj($data['cnpj'])) {
                throw new Exception('Já existe um fornecedor cadastrado com este CNPJ.');
            }
            return Supplier::create($data);
        } catch(Exception $exception) {
            throw new Exception('Erro ao criar fornecedor :( ' . $exception->getMessage());
        }
    }

    public function update(int $id, array $data)
    {
        try {
            $supplier = $this->findById($id);
            $supplier->update($data);
            return $supplier;
        } catch(Exception $exception) {
            throw new Exception('Erro ao atualizar fornecedor :( ' . $exception->getMessage());
        }
    }

    public function delete(int $id)
    {
        try {
            $supplier = $this->findById($id);
            return $supplier->delete();
        } catch(Exception $exception) {
            throw new Exception('Erro ao excluir fornecedor :( ' . $exception->getMessage());
        }
    }
}
