<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchCnpjRequest;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repository\SupplierRepository;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private SupplierRepository $supplierRepository;
    private SupplierService $supplierService;

    public function __construct(
        SupplierRepository $supplierRepository,
        SupplierService $supplierService

    ) {

        $this->supplierRepository = $supplierRepository;
        $this->supplierService = $supplierService;
    }

    public function searchCnpj(SearchCnpjRequest $request)
    {
        try {
            $cnpj = $request->validated('cnpj');
            $supplier = $this->supplierRepository->findByCnpj($cnpj);

            return response()->json([
                'success' => 'Sucesso! CNPJ encontrado.',
                'supplier' => $supplier
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erro :(',
                'error' => $exception->getMessage()
            ], 500);
        }
    }


    public function index(Request $request)
    {
        try{
            $dataRequest = $request->only(['name_company', 'ativo']);
            $suppliers = $this->supplierService->getSuppliers($dataRequest);

            return response()->json([
                'message' => 'Sucesso! Fornecedores encontrados.',
                'suppliers' => $suppliers,
            ], 200);
        }catch(Exception $exception){
            return response()->json([
                'message' => 'Erro :(',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function store(StoreSupplierRequest $request)
    {
        try{
            $supplier = $this->supplierService->createSupplier($request->validated());

            return response()->json([
                'message' => 'Sucesso! Fornecedor cadastrado.',
                'supplier' => $supplier,
            ], 201);
        }catch(Exception $exception){
            return response()->json([
                'message' => 'Erro :(',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function show(int $id)
    {
        try{
            $supplier = $this->supplierService->showSupplier($id);

            return response()->json([
                'message' => 'Sucesso! Fornecedor encontrado.',
                'supplier' => $supplier,
            ], 200);
        }catch(Exception $exception){
            return response()->json([
                'message' => 'Erro :(',
                'error' => $exception->getMessage()
            ], 500);
        }catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Erro :( Fornecedor não encontrado.',
            ], 404);
        }
    }
    public function update(UpdateSupplierRequest $request, int $id)
    {
        try{
            $supplier = $this->supplierService->updateSupplier($id, $request->validated());

            return response()->json([
                'message' => 'Sucesso! Fornecedor atualizado.',
                'supplier' => $supplier,
            ], 200);
        }catch(Exception $exception){
            return response()->json([
                'message' => 'Erro :(',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function delete(int $id)
    {
        try{
            $this->supplierService->deleteSupplier($id);

            return response()->json([
                'message' => 'Sucesso! Fornecedor deletado.',
            ], 200);
        }catch(Exception $exception){
            return response()->json([
                'message' => 'Erro :(',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

}
