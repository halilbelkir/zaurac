<?php

namespace App\Http\Controllers;

use Carbon\Traits\Creator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Validator,Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        try
        {
            $attribute = array(
                'ad'       => 'Ad',
                'aciklama' => 'Açıklama',
                'seflink'   => 'Seflink',
            );

            $rules = array(
                'ad'       => 'required',
                'aciklama' => 'required',
                'seflink'   => 'required|unique:products,seflink',
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $products            = new Products;
            $products->ad        = $request->get('ad');
            $products->aciklama  = $request->get('aciklama');
            $products->seflink    = $request->get('seflink');
            $products->save();

            Session::flash('message', array('Başarılı!','Ürün kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('products.index');
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
        $products = Products::find($id);
        return view('products.edit',compact('products'));
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
        try
        {
            $attribute = array(
                'ad'       => 'Ad',
                'aciklama' => 'Açıklama',
                'seflink'   => 'Seflink',
            );

            $rules = array(
                'ad'       => 'required',
                'aciklama' => 'required',
                'seflink'   => 'required|unique:products,seflink,'.$id,
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $products            = Products::find($id);
            $products->ad        = $request->get('ad');
            $products->aciklama  = $request->get('aciklama');
            $products->seflink    = $request->get('seflink');
            $products->save();

            Session::flash('message', array('Başarılı!','Ürün kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $products = Products::find($id);
            $products->delete();

            session()->flash('flash_message', array('Başarılı!','Ürün silindi.', 'success'));
        }

        catch (\Exception $e){

            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));

        }

        return redirect()->route('products.index');
    }

    public function datatable()
    {
        return Datatables::of(Products::get())
            ->editColumn('created_at', function ($products) {
                return $products->updated_at ? with(new Carbon($products->updated_at))->format('d-m-Y') : '';
            })
            ->addColumn('actions', function ($products) {
                $actions  = '<a  href="'.route('products.edit',$products->id).'" class="inline-flex items-center px-1 py-1 bg-blue-800 mr-2 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">edit</span></a>';
                $actions .= '<a onclick="return confirm(\' '.$products->ad.' isimli ürünü silmek istediğinize emin misiniz? \')" href="'.route('product.destroy',$products->id).'" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span></a>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}
