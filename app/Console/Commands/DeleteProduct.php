<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a product through Artisan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $headers = [ 'id', 'name', 'description' ];
        $get_products = Product::all(['id', 'name', 'description'])->toArray();
        $this->table($headers, $get_products);

        $product_id = $this->ask('What is the product ID ? ');
        while (!(is_numeric($product_id))){

            $product_id = $this->ask('!! Please enter a number !! ,  What is the product ID? ');
        }

        $product = Product::find($product_id);

        if ($product === null) {
            $this->error("Invalid or non-existent Product ID.");
            return 1;
        }

        if ($this->confirm('Are you sure you want to delete this Product? ' . $product->name)) {
            $product->delete();
            $this->info("Product deleted.");
        }

        return 0;
    }
}
