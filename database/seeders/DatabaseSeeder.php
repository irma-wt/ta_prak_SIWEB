<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================
        // Data Dummy Category
        // (minimal 4 data)
        // =====================
        DB::table('categories')->insert([
            [
                'category_id'   => 1,
                'category_name' => 'Anting',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'category_id'   => 2,
                'category_name' => 'Cincin',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'category_id'   => 3,
                'category_name' => 'Gelang',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'category_id'   => 4,
                'category_name' => 'Kalung',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);

        // =====================
        // Data Dummy Brand
        // (minimal 4 data)
        // =====================
        DB::table('brands')->insert([
            [
                'brand_id'   => 1,
                'nama_brand' => 'Swarovski',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'brand_id'   => 2,
                'nama_brand' => 'Pandora',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'brand_id'   => 3,
                'nama_brand' => 'Tiffany & Co',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'brand_id'   => 4,
                'nama_brand' => 'Lovisa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // =====================
        // Data Dummy Product
        // =====================
        DB::table('products')->insert([
            [
                'product_id'    => 1,
                'category_id'   => 1,
                'brand_id'      => 1,
                'product_name'  => 'Anting Mutiara Elegan',
                'product_price' => 185000,
                'product_stock' => 42,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'product_id'    => 2,
                'category_id'   => 2,
                'brand_id'      => 2,
                'product_name'  => 'Cincin Perak Minimalis',
                'product_price' => 220000,
                'product_stock' => 28,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'product_id'    => 3,
                'category_id'   => 3,
                'brand_id'      => 3,
                'product_name'  => 'Gelang Emas Lapis',
                'product_price' => 310000,
                'product_stock' => 15,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'product_id'    => 4,
                'category_id'   => 4,
                'brand_id'      => 4,
                'product_name'  => 'Kalung Berlian Sintetis',
                'product_price' => 275000,
                'product_stock' => 20,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}