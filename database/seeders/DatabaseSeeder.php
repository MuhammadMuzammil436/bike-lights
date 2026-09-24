<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Inventory;
use App\Models\Location;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@bikelights.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        $staff = User::create([
            'name' => 'Shop Staff',
            'email' => 'staff@bikelights.test',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */

        $customer = Customer::create([
            'name' => 'Ali Khan',
            'email' => 'ali@example.com',
            'google_id' => 'google-demo-001',
            'phone' => '03001234567',
            'is_active' => true,
        ]);

        $shopCustomer = Customer::create([
            'name' => 'Ahmed Raza',
            'email' => 'ahmed@example.com',
            'phone' => '03111234567',
            'is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Addresses
        |--------------------------------------------------------------------------
        */

        CustomerAddress::create([
            'customer_id' => $customer->id,
            'label' => 'Home',
            'recipient_name' => 'Ali Khan',
            'phone' => '03001234567',
            'address_line_1' => 'House 123, Block A',
            'city' => 'Karachi',
            'state' => 'Sindh',
            'postal_code' => '74000',
            'country' => 'Pakistan',
            'is_default' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Locations
        |--------------------------------------------------------------------------
        */

        $shop = Location::create([
            'name' => 'Main Shop',
            'type' => 'shop',
            'address' => 'Main Market, Karachi',
            'phone' => '02112345678',
            'is_active' => true,
        ]);

        $warehouse = Location::create([
            'name' => 'Main Warehouse',
            'type' => 'warehouse',
            'address' => 'Industrial Area, Karachi',
            'phone' => '02187654321',
            'is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        $frontLight = Product::create([
            'name' => 'Bike Light Pro',
            'slug' => 'bike-light-pro',
            'sku' => 'BL-PRO-001',
            'description' => 'High brightness rechargeable bike front light.',
            'price' => 5000,
            'compare_at_price' => 6000,
            'stock_alert_quantity' => 5,
            'is_active' => true,
        ]);

        $rearLight = Product::create([
            'name' => 'Bike Rear Light',
            'slug' => 'bike-rear-light',
            'sku' => 'BL-REAR-001',
            'description' => 'Rechargeable rear safety bike light.',
            'price' => 2500,
            'compare_at_price' => 3000,
            'stock_alert_quantity' => 5,
            'is_active' => true,
        ]);

        $combo = Product::create([
            'name' => 'Bike Light Combo',
            'slug' => 'bike-light-combo',
            'sku' => 'BL-COMBO-001',
            'description' => 'Front and rear bike light combo.',
            'price' => 7000,
            'compare_at_price' => 8000,
            'stock_alert_quantity' => 3,
            'is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Inventory
        |--------------------------------------------------------------------------
        */

        Inventory::create([
            'product_id' => $frontLight->id,
            'location_id' => $shop->id,
            'quantity' => 10,
            'reserved_quantity' => 0,
        ]);

        Inventory::create([
            'product_id' => $frontLight->id,
            'location_id' => $warehouse->id,
            'quantity' => 50,
            'reserved_quantity' => 0,
        ]);

        Inventory::create([
            'product_id' => $rearLight->id,
            'location_id' => $shop->id,
            'quantity' => 15,
            'reserved_quantity' => 0,
        ]);

        Inventory::create([
            'product_id' => $rearLight->id,
            'location_id' => $warehouse->id,
            'quantity' => 40,
            'reserved_quantity' => 0,
        ]);

        Inventory::create([
            'product_id' => $combo->id,
            'location_id' => $shop->id,
            'quantity' => 5,
            'reserved_quantity' => 0,
        ]);

        Inventory::create([
            'product_id' => $combo->id,
            'location_id' => $warehouse->id,
            'quantity' => 20,
            'reserved_quantity' => 0,
        ]);
    }
}
