<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Validator,Session;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
                'name'                  => 'Ad & Soyad',
                'email'                 => 'E-Mail',
                'password'              => 'Şifre',
                'password_confirmation'  => 'Şifre Tekrar',
            );

            $rules = array(
                'name'                 => 'required',
                'email'                => 'required|email|unique:users,email',
                'password'             => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required|string|min:6',
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $users            = new User;
            $users->name      = $request->get('name');
            $users->email     = $request->get('email');
            $users->password  = bcrypt($request->get('password'));
            $users->save();

            Session::flash('message', array('Başarılı!','Kullanıcı kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('users.edit',compact('users'));
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
                'name'                  => 'Ad & Soyad',
                'email'                 => 'E-Mail',
            );

            $rules = array(
                'name'                 => 'required',
                'email'                => 'required|email|unique:users,email,'.$id,
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $users            = User::find($id);
            $users->name      = $request->get('name');
            $users->email     = $request->get('email');
            $users->save();

            Session::flash('message', array('Başarılı!','Kullanıcı kaydedildi.', 'success'));

        }
        catch (\Exception $e)
        {
            Session::flash('message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }

        return redirect()->route('users.index');
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
            $users = User::find($id);
            $users->delete();

            session()->flash('flash_message', array('Başarılı!','Kullanıcı silindi.', 'success'));
        }

        catch (\Exception $e){

            session()->flash('flash_message', array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));

        }

        return redirect()->route('users.index');
    }

    public function datatable()
    {
        return Datatables::of(User::where('id','!=',Auth::user()->id)->get())
            ->editColumn('created_at', function ($user) {
                return $user->updated_at ? with(new Carbon($user->updated_at))->format('d-m-Y') : '';
            })
            ->addColumn('actions', function ($user) {
                $actions  = '<a  href="'.route('users.edit',$user->id).'" class="inline-flex items-center px-1 py-1 bg-blue-800 mr-2 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-blue-700 hover:text-white active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">edit</span></a>';
                $actions .= '<a onclick="return confirm(\' '.$user->name.' isimli kullanıcıyı silmek istediğinize emin misiniz? \')" href="'.route('user.destroy',$user->id).'" class="inline-flex items-center px-1 py-1 bg-red-800 border border-transparent rounded-md font-normal text-xs text-white uppercase tracking-widest hover:bg-red-700 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition"><span class="material-icons" style="font-size: 18px">delete</span></a>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->toJson();
    }
}
