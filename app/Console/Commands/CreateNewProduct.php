<?php

namespace App\Console\Commands;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateNewProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new product through Artisan';

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
        try{

            //Get all category
            $all_category = DB::table('categories')
                            ->select('id', 'name')
                            ->get();
            $all_category = json_decode(json_encode($all_category), true);;
             

            //Ask for name through the CLI 
            $name = $this->ask('What is the product name?: ');

            // Name validation
            $find_name = Product::where('name', '=',$name)
                                ->first();
            if ($find_name)
            {
                $this->error("This product is already exist .");
                return 1;
            }
            //Ask for description through the CLI 
            $description = $this->ask('What is the product description?: ');

            //Ask for price through the CLI 
            $price = $this->ask('What Is the product price?: ');
            
            // Price validation
            while (!(is_numeric($price))){

                $price = $this->ask('!! Please enter a number !! ,  What Is the product price?: ');
            }



            //Ask for category through the CLI with Category validation
            if (count($all_category) == 0) {
                $category_name = $this->ask('What Is the product category name ? no category is available , add a new category or put NULL : ');
            }
            else {
                
                $headers = [ 'id', 'name' ];
                $this->table($headers, $all_category);
                $category_name = $this->ask('What Is the product category name ? , choose a category between these cartegorie above, or put NULL : ');


                // check if category exists or not 
                if ($category_name != 'NULL' )
                {
                    $find_category = DB::table('categories')
                                    ->where('name', $category_name)
                                    ->get();
               
                    if (count($find_category) == 0  ) {
                        $this->error("Non-existent Category name .");
                        return 1;
                    } 
                 }
            }
            
   
           
           
            

            // Eloquent to create a new Product through the CLI
            Product::create([
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'category_name' => $category_name   
            ]);


            //Return a message back 
            $this->info('Product has been created!');
        
        }
        catch(Exception $ex){
            Log::error("Sorry ! , an error occurred, details: {$ex->getMessage()}");

            $this->error('Sorry ! an error occurred, unable to create the product!');
        }

        catch (\Illuminate\Database\QueryException $e) {
            $this->error('Sorry ! an error occurred, unable to create the product!');
        }

    }
}