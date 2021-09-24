<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Awards;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator,Session;
use Yajra\DataTables\Facades\DataTables;

class awardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('awards.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('awards.create');
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
                'title'       => 'Başlık',
                'content'     => 'İçerik',
                'link'        => 'Link',
                'image'       => 'Resimler',
            );

            $rules = array(
                'title'       => 'required',
                'content'     => 'required',
                'link'        => 'nullable|url',
                'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            );


            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $image        = $request->file('image');
            $imageName    = Helpers::seflink($request->get('title')).'-'.time().'.'.$image->extension();
            $target_file   = 'images/front/awards';
            $imageName    = $target_file.'/'.$imageName;
            $image->move($target_file,$imageName);

            $awards              = new Awards;
            $awards->title       = $request->get('title');
            $awards->content     = $request->get('content');
            $awards->link        = $request->get('link');
            $awards->image       = $imageName;
            $awards->save();

            Session::flash('message', array('Başarılı!','Ödül kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('awards.index');
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
        $awards = Awards::find($id);
        return view('awards.edit',compact('awards'));
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
                'title'       => 'Başlık',
                'content'     => 'İçerik',
                'link'        => 'Link',
            );

            $rules = array(
                'title'       => 'required',
                'content'     => 'required',
                'link'        => 'nullable|url',
            );

            $awards       = Awards::find($id);

            if(empty($awards->image))
            {
                $attribute['image'] = 'Resim';
                $rules['image']     = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024';
            }

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if(empty($awards->image))
            {
                $image        = $request->file('image');
                $imageName    = Helpers::seflink($request->get('title')).'-'.time().'.'.$image->extension();
                $target_file   = 'images/front/awards';
                $imageName    = $target_file.'/'.$imageName;
                $image->move($target_file,$imageName);
                $awards->image    = $imageName;
            }

            $awards->title       = $request->get('title');
            $awards->content     = $request->get('content');
            $awards->link        = $request->get('link');
            $awards->save();

            Session::flash('message', array('Başarılı!','Ödül kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('awards.index');
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
            $awards = Awards::find($id);
            Helpers::fileDelete($awards->image);
            $awards->delete();

            session()->flash('flash_message', array('Başarılı!','Ödül silindi.', 'success'));
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }
        return redirect()->route('awards.index');
    }

    public function destroyImage($id)
    {
        try
        {
            $awards = Awards::find($id);
            Helpers::fileDelete($awards->image);
            $awards->image    = null;
            $awards->save();

            session()->flash('flash_message', array('Başarılı!','Resim silindi.', 'success'));
        }
        catch (\Exception $e)
        {
            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }
        return redirect()->route('awards.edit',$awards->id);
    }

    public function datatable()
    {
        return Datatables::of(Awards::get())
            ->editColumn('created_at', function ($awards) {
                return $awards->updated_at ? with(new Carbon($awards->updated_at))->format('d-m-Y') : '';
            })
            ->addColumn('actions', function ($awards) {
                $actions  = '<a href="'.route('awards.edit',$awards->id).'" class="inline-flex items-center px-1 py-1 bg-blue-800 mr-2 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">edit</span></a>';
                $actions .= '<a data-id="'.$awards->id.'" onclick="return confirm(\' '.$awards->title.' isimli ödülü silmek istediğinize emin misiniz? \')" href="'.route('award.destroy',$awards->id).'" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span></a>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function sortable(Request $request)
    {
        $posts = Awards::all();

        foreach ($posts as $post) {
            foreach ($request->order as $order) {
                if ($order['id'] == $post->id) {
                    $post->update(['order' => $order['position']]);
                }
            }
        }

        return response()->json([
            'result' => 1,
        ]);
    }
}
