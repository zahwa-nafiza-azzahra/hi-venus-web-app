<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $this->category = Category::create([
        'name' => 'Kawaii Dress',
        'slug' => 'kawaii-dress',
    ]);

    $this->product = Product::create([
        'category_id' => $this->category->id,
        'name'        => 'Sakura Dress',
        'slug'        => 'sakura-dress',
        'description' => 'A very cute dress',
        'price'       => 150000,
        'image'       => null,
    ]);
});

test('admin dapat menghapus produk dan diredirect dengan pesan sukses', function () {
    $this->actingAs($this->admin);

    $response = $this->delete(route('admin.products.destroy', $this->product->id));

    $response->assertRedirect(route('admin.products.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseMissing('products', [
        'id' => $this->product->id,
    ]);
});

test('tamu tidak bisa menghapus produk dan diredirect ke login', function () {
    $response = $this->delete(route('admin.products.destroy', $this->product->id));

    $response->assertRedirect('/login');

    $this->assertDatabaseHas('products', [
        'id' => $this->product->id,
    ]);
});

test('produk yang dihapus tidak bisa diakses setelah dihapus', function () {
    $this->actingAs($this->admin);

    $productId = $this->product->id;
    $this->delete(route('admin.products.destroy', $productId));

    $this->assertNull(Product::find($productId));
});
