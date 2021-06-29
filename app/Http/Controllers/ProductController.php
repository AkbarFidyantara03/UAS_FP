<?php
  
namespace App\Http\Controllers;
  
use App\Product;
use Illuminate\Http\Request;
  
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
  
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $req)
    {
        $path = $req->file('berkas')->storeAs('', $req->file('berkas')->getClientOriginalName(), 'public');
        
        return view('hasil-upload', ['path' => $path]);
    }
    
    public function create()
    {
        return view('products.create');
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $nm = $request->foto;
        $namaFile = time().rand(100,999).".".$nm->getClientOriginalExtension();

            $dtUpload = new Product;
            $dtUpload->nomer = $request->nomer;
            $dtUpload->judul = $request->judul;
            $dtUpload->tanggal  = $request->tanggal;
            $dtUpload->foto = $namaFile;

            $nm->move(public_path().'/img', $namaFile);
            $dtUpload->save();

            return redirect('products');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    public function cetak()
    {
        
        $productcetak = Product::latest()->paginate(5);

        return view('products.laporan', compact('productcetak'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
   
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
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
        $request->validate([
            'plat' => 'required',
            'merek' => 'required',
            'tipe' => 'required',
            'foto'
        ]);
  
        $product->update($request->all());
  
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
  
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}