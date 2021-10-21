<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a category through Artisan';

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
        $headers = [ 'id', 'name', 'parent_id' ];
        $get_category = Category::all(['id', 'name', 'parent_id'])->toArray();
        $this->table($headers, $get_category);

        $category_id = $this->ask('What is the Category ID ? ');
        while (!(is_numeric($category_id))){

            $category_id = $this->ask('!! Please enter a number !! ,  What is the Category ID? ');
        }


        $category = Category::find($category_id);

        if ($category === null) {
            $this->error("Invalid or non-existent Category ID.");
            return 1;
        }

        if ($this->confirm('Are you sure you want to delete this Category?, If you delete this category, all products attached will be NULL on their category column , also  : ' . $category->name)) {
            DB::update('update products set category_name = ?  where category_name = ?', ["NULL", $category->name ]);
            DB::update('update categories set parent_id = ?  where parent_id = ?', [0, $category->id ]);
            $category->delete();
            $this->info("Category deleted.");
        }

        return 0;
    }
}
