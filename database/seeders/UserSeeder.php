<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create an initial admin account
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'image' => '/default_images/user_profile.webp',
            'role' => 2
        ]);

        // create 3 admin user
        User::factory()
            ->has(Tag::factory()->count(2))
            ->has(Product::factory()->count(3))
            ->count(3)
            ->create([
                'role' => 2,
            ]);

        $tag_ids = Tag::get()->pluck('id'); // get the ids of all tags like [1, 2, 3...]

        $products = Product::get();

        // attach tags to products for many to many
        $products->each(function ($product) use ($tag_ids) {
            $product->tags()->attach($tag_ids->random(2));
        });

        $product_ids = $products->pluck('id');

        // create 6 clients
        $customers = User::factory()
            ->count(6)
            ->create();

        // create orders for the customers
        $customers->each(function ($customer) use($product_ids) {
            Order::factory()->count(3)->create([
                'user_id' => $customer->id,
                'product_id' => $product_ids->random()
            ]);
        });

        $actual_orders_ids = Order::where('status',  'order')->get()->pluck('id'); // get actual orders ids which are not in the cart

        $split_actual_order_ids = $actual_orders_ids->splitIn(2); // the ids are split in two for example [[1, 2, 3], [4, 5, 6]]

        $customer_ids = User::where('role', 1)->get()->pluck('id');

        // create 2 invoices for orders

        $invoice_one = Invoice::factory()->create(['user_id' => $customer_ids->random()]);

        $invoice_one->orders()->attach($split_actual_order_ids[0]); // attach invoice with first half of acutal order ids for many to many

        $invoice_two = Invoice::factory()->create(['user_id' => $customer_ids->random()]);

        $invoice_two->orders()->attach($split_actual_order_ids[1]); // attach invoice with second half of acutal order ids for many to many

        // create blogs
        Blog::factory()->count(10)->create();

    }
}
