<?php

namespace App\Http\Controllers;

use App\Ingridient;
use App\Product;
use Illuminate\Http\Request;
use App\IngridientAmount;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $ingridients = Ingridient::all();
        return view('product.all-products')
        ->with( 'products', $products )
        ->with('ingridients', $ingridients);

    }






    public function allProductsTable()
    {
        $products = Product::all();
        $ingridients = Ingridient::all();

            // function form ingrient html content
             function ingridientContent( $products, $b ){
                    $ingridient_content = "";
                    foreach( $products[$b]->ingridients()->pluck('ingridient_name') as $name ){
                    $ingridient_content .= "
                        <li> ". $name ."</li>
                            ";
                    }
                    return $ingridient_content;
            }

             // function for product content       
             function productContent($products){
                $product_content = "";
                for( $b=0; $b < $products->count(); $b++ ){
                $product_content .= "
                    <tr>
                        <td> ".  $b ." </td>
                        <td>".  $products[$b]->product_name ." </td>
                        <td>
                            <ul>
                            ". ingridientContent( $products, $b )."
                            </ul>
                        </td>
                        <td>". $products[$b]->product_cost."</td>
                        <td>
                            <a class='btn btn-primary btn-sm' data-toggle='modal' data-target='#editProductModlel-". $b."'>Edit</a>
                                <button form='product-delete-form-".$b."' num='". $products[$b]->id ."' id='deleteProductButton-". $b ."' class='btn btn-sm btn-danger'>Delete</button>
                            <form name='product-delete-form-".$b."' id='product-delete-form-".$b."' action='product/".$products[$b]->id."' method='post'>
                                ".csrf_field()."
                                <input type='hidden' name='_method' value='DELETE'>
                            </form>
                        </td>
                    </tr>";
                    }
                    return $product_content;
            }

            // loading the final table for product page
             $content = '<table id="all-user-table" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <td>#</td>
                                <th>product: Name</th>
                                <th>Ingridients</th>
                                <th>Cost</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                               '.  productContent($products) .'
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>';
                return $content;


    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                $rules = array(
                    'product_name' => ['required', 'unique:products'],
                    'product_cost' => ['required', 'integer', 'min:1'],
                  
                    );
            $error  =  Validator::make( $request->all(), $rules );
            if ($error->fails()) {
                return response()->json(['error' => $error->errors()->all()]);
                    }else {
                        $prod = Product::create([
                            'product_name' => $request->product_name,
                            'product_cost' => $request->product_cost,
                        ]);
                        $prod->ingridients()->sync( $request->ingr_arr );
        $word = $request->ingr_amount;
            for ($g=0;  $g < count($word); $g++) {
                 IngridientAmount::create([
                    'ingridient_id' => $word[$g]['ingridient'],
                    'product_id' => $prod->id,
                    'amount' => $word[$g]['amount'],
                 ]);
            }

                return response()->json(['success' => 'data saved successfully']);
                }

        
    }






    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }









    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $errors = [ "error" => "none" ];
        // validate the datag from the form
        $validator = Validator::make($request->all(), [
            'product' => "string|max:20",
        ]);

        if ($validator->fails()) {
            $errors = [ "error" => "found", "response" => $validator->errors() ];
            return response()->json( $errors );
        }

        $old_value = $product->product_name;
        // update to database
        $product->product_name = $request->product;
        $product->save();

       return  response()->json(["success" => "data changed ", "new" => $request->product, "old" => $old_value  ]);
    }







    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
      $product->ingridients()->detach();
        foreach( $product->sales as $sales ){
            if ($sales) {
                    $sales->delete();
                }
            }

        if ( $product->stock ) {
             $product->stock->delete();   
        }

        if ($product->stockTrace) {
             $product->stockTrace->detach() ;
        }
    

        $product->delete();
        return response()->json(['delete' => $product]);
    }
}
