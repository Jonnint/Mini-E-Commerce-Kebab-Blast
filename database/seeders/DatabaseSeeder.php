<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        \App\Models\User::create([
            'name' => 'Admin Kebab Blast',
            'email' => 'admin@kebabblast.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create dummy products
        // Taruh gambar di folder public/images/
        // Contoh: public/images/kebab-original.jpg
        Product::create([
            'name' => 'Kebab Original',
            'price' => 18000,
            'stock' => 50,
            'description' => 'Kebab klasik dengan daging sapi pilihan, sayuran segar, dan saus spesial yang bikin ketagihan',
            'image' => 'images/kebabori.png',
        ]);

        Product::create([
            'name' => 'Kebab Jumbo',
            'price' => 25000,
            'stock' => 30,
            'description' => 'Kebab ukuran jumbo dengan porsi daging dan sayuran lebih banyak, cocok untuk yang lapar berat',
            'image' => 'images/kebabjumbo.png',
        ]);

        Product::create([
            'name' => 'Kebab Cheese',
            'price' => 22000,
            'stock' => 40,
            'description' => 'Kebab dengan keju mozzarella yang meleleh di setiap gigitan, perpaduan sempurna pedas dan gurih',
            'image' => 'images/kebabkeju.png',
        ]);

        Product::create([
            'name' => 'Burger Blast',
            'price' => 20000,
            'stock' => 35,
            'description' => 'Burger dengan patty daging sapi juicy dan saus pedas khas Kebab Blast yang bikin nagih',
            'image' => 'images/burger.png',
        ]);

        Product::create([
            'name' => 'Hot Dog',
            'price' => 15000,
            'stock' => 45,
            'description' => 'Hot dog dengan sosis premium dan topping pilihan, sempurna untuk cemilan atau makan siang',
            'image' => 'images/hotdog.png',
        ]);
    }
}
