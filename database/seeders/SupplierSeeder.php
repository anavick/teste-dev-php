<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'João Silva',
                'name_company' => 'João Comércio LTDA',
                'email' => 'joao@comercio.com',
                'cnpj' => '12345678000100',
                'street' => 'Rua das Flores',
                'number' => '123',
                'complement' => 'Sala 1',
                'neighborhood' => 'Centro',
                'city' => 'Curitiba',
                'state' => 'PR',
                'zip_code' => '80000000',
                'contact' => '41912345678',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maria Souza',
                'name_company' => 'Maria Atacado ME',
                'email' => 'maria@atacado.com',
                'cnpj' => '98765432000111',
                'street' => 'Avenida Brasil',
                'number' => '456',
                'complement' => null,
                'neighborhood' => 'Jardim das Américas',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01000000',
                'contact' => '11987654321',
                'ativo' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carlos Oliveira',
                'name_company' => 'Carlos e Filhos S.A.',
                'email' => 'carlos@empresa.com',
                'cnpj' => '10293847560122',
                'street' => 'Rua do Comércio',
                'number' => '789',
                'complement' => 'Galpão',
                'neighborhood' => 'Industrial',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'zip_code' => '30000000',
                'contact' => '31987654321',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
