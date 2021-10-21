
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div style="width: 900px" class="container max-w-full mx-auto pt-4 ">
     
        <h1 class="text-4xl font-bold mb-4">All products :  </h1>
        <a href="/products-create" class="bg-blue-500 tracking-wide text-white px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow my-4">Add Products</a>
       
        <!-- Validation message -->
        @if(\Session::has('success'))
        <div class="px-4 py-3 leading-normal text-green-700 bg-green-100 rounded-lg" role="alert">
            <p class="font-bold">Success !</p>
            <p> {{ \Session::get('success') }}</p>
        </div>
        @endif
        
        <br>

        <!-- Sort -->
        <span class="font-bold">Sort by :</span>
        <a href="{{ URL::current() }}" class="mx-8" >All</a>
        <a href="{{ URL::current(). '?sort=name' }}" class="mx-8" >Name</a>
        <a href="{{ URL::current(). '?sort=price' }}" class="mx-8" >Price</a>
       
        <table  class="mt-6'">
            <thead class="bg-gray-100">
                <tr>
                <th class="px-6 py-2 text-xs text-gray-500">ID</th>
                <th class="px-6 py-2 text-xs text-gray-500">Name</th>
                <th class="px-6 py-2 text-xs text-gray-500">Description</th>
                <th class="px-6 py-2 text-xs text-gray-500">Price</th>
                <th class="px-6 py-2 text-xs text-gray-500">Category name</th>
                <th class="px-6 py-2 text-xs text-gray-500">Image file name</th>
                <th class="px-6 py-2 text-xs text-gray-500">DELETE</th>
                </tr>
            </thead>
            <tbody  class="bg-white">
            @foreach($products as $product)
                <tr class="whitespace-nowrap">
                <td class="px-6 py-4">{{ $product->id }}</td>
                <td class="px-6 py-4">{{ $product->name }}</td>
                <td class="px-6 py-4">{{ $product->description  }}</td>
                <td class="px-6 py-4">{{ $product->price  }}</td>
                <td class="px-6 py-4">{{ $product->category_name  }}</td>
                <td class="px-6 py-4">{{ $product->image  }}</td>
                <td class="px-6 py-4">
                    <a href="/products/delete/{{ $product->id }}" class="ml-4 bg-red-500 tracking-wide text-white px-6 py-2 inline-block mb-6 shadow-lg rounded hover:shadow"> DELETE </a>
                </td>
                </tr>
            @endforeach  
            </tbody>
        </table>
        
           
    </div>
   
</body>
</html>