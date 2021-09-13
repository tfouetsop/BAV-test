<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\ProductRepository;
//use Illuminate\Support\Facades\DB;
use Redirect,Response,DB;
use File;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->middleware('auth');
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$products = $this->productRepository->getPaginate();

        return view('product.index', compact('products'));*/

        if(request()->ajax()) {
            return datatables()->of(Product::select('*'))
            ->addColumn('image', 'image')
            ->addColumn('action', 'action')
            ->rawColumns(['image','action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('product.list');
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
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
     
        $productId = $request->product_id;
     
        $details = [
            'libelle' => $request->libelle, 
            'prix' => $request->prix,
            'quantite' => $request->quantite, 
            'description' => $request->description
        ];
     
        if ($files = $request->file('image')) {
            
           //delete old file
           \File::delete('public/product/'.$request->hidden_image);
         
           //insert new file
           $destinationPath = 'public/product/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $details['image'] = "$profileImage";
        }
         
        $product   =   Product::updateOrCreate(['id' => $productId], $details);  
               
        return Response::json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $product  = Product::where($where)->first();
      
        return Response::json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::where('id',$id)->first(['image']);
        \File::delete('public/product/'.$data->image);
        $product = Product::where('id',$id)->delete();
      
        return Response::json($product);
    }
}
