<?php
 
namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class CreateNewCategory extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new category through Artisan';

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

            //Ask for name through the CLI 
            $name = $this->ask('What is the category name?: ');

             // Name validation
             $find_name = Category::where('name', '=',$name)
                                ->first();
            if ($find_name)
            {
                $this->error("This Category is already exist .");
                return 1;
            }

             //Ask for parent id through the CLI 
            $headers = [ 'id', 'name' ];
            $get_category = Category::all(['id', 'name'])->toArray();
            $this->table($headers, $get_category);
            $parent_id = $this->ask('What is the category parent id?  Or put 0 : ');
            
            // validation parent id
            while (!(is_numeric($parent_id))){

                $parent_id = $this->ask('!! Please enter a number !! ,  What is the Parent Category ID ? Or put 0 ');
            }
            if ($parent_id != 0)
            {
                $parent_category = Category::find($parent_id);
                
                if ($parent_category === null) {
                    $this->error("Invalid or non-existent Parent Category ID.");
                    return 1;
                }
            }
    

            //Use Eloquent to create a new Category through the CLI
            Category::create([
                'name' => $name,
                'parent_id' => $parent_id
                
            ]);


            //Return a message back 
            $this->info('Category has been created!');
        
        }
        catch(Exception $ex){
            Log::error("Sorry ! , an error occurred, details: {$ex->getMessage()}");

            $this->error('Sorry ! an error occurred, unable to create the category!');
        }
        catch (\Illuminate\Database\QueryException $e) {
            $this->error('Sorry ! an error occurred, unable to create the category!');
        }


    }
}
