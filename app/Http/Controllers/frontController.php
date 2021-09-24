<?php

namespace App\Http\Controllers;

use App\Mail\sendmail;
use App\Models\Awards;
use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\Pages;
use App\Models\References;
use App\Models\Services;
use App\Models\Settings;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Form;
use Carbon\Carbon;
use Cookie,Validator,Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class frontController extends Controller
{
    public $settings;

    public function __construct()
    {
        $this->settings    = Settings::find(1);
    }


    public function index()
    {
        $slider    = Slider::orderBy('order','asc')->get();
        $services  = Services::where('homepage',1)->orderBy('order','asc')->get();
        $clients   = References::limit(8)->orderBy('order','asc')->get();
        $blog      = Blog::limit(3)->orderBy('order','asc')->get();
        return view('front.index',compact('slider','services','clients','blog'));
    }

    public function about()
    {
        $team = Team::orderBy('order','asc')->get();
        return view('front.about',compact('team','title'));
    }

    public function services()
    {
        $services = Services::orderBy('order','asc')->get();
        return view('front.services.index',compact('services'));
    }

    public function service($seflink)
    {
        $service = Services::where('seflink',$seflink)->first();
        return view('front.services.detail',compact('service'));
    }

    public function clients()
    {
        $clients = References::orderBy('order','asc')->get();
        return view('front.clients',compact('clients'));
    }

    public function awards()
    {
        $awards = Awards::orderBy('order','asc')->get();
        return view('front.awards',compact('awards'));
    }

    public function pages($seflink)
    {
        $pages = Pages::where('seflink',$seflink)->first();

        if (!$pages)
        {
            return view('front.notfound',compact('pages'));
        }

        return view('front.pages',compact('pages'));
    }

    public function gallery()
    {
        $gallery = Gallery::orderBy('order','asc')->get();
        return view('front.gallery',compact('gallery'));
    }

    public function blog()
    {
        $blog = Blog::orderBy('order','asc')->get();
        return view('front.blog.index',compact('blog'));
    }

    public function blog_detail($seflink)
    {
        $blog = Blog::where('seflink',$seflink)->first();
        return view('front.blog.detail',compact('blog'));
    }

    public function team_detail($seflink)
    {
        $team = Team::where('seflink',$seflink)->first();
        return view('front.team_detail',compact('team'));
    }

    public function media()
    {
        $media = Media::orderBy('order','asc')->get();
        return view('front.media',compact('media'));
    }

    public function send(Request $request)
    {
        try
        {

            if (Cookie::has('form'))
            {
                return json_encode(array('Başarısız!','Lütfen 2 dakika sonra tekrar deneyiniz.', 'error'));
            }


            $attribute = array(
                'name'    => 'Ad & Soyad',
                'email'   => 'E-Mail',
                'message' => 'Mesajınız',
            );

            $rules = array(
                'name'    => 'required',
                'email'   => 'required|email',
                'message' => 'required',
            );


            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($attribute);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $form          = new Form;
            $form->name    = $request->get('name');
            $form->email   = $request->get('email');
            $form->message = $request->get('message');

            $form->save();



            $settings = $this->settings;
            $datas    = array(
                'name'    => $request->get('name'),
                'email'   => $request->get('email'),
                'message' => $request->get('message'),
                'subject' => 'İletişim Formu'
            );
            Mail::to($settings->recipient_email)->send(new sendmail($datas));

            Cookie::queue('form', true, 1);
            return json_encode(array('Başarılı!','Form Gönderildi. En kısa süre içerisinde sizinle irtibata geçilecek.', 'success'));
        }
        catch (\Exception $e)
        {
            return json_encode(array('Başarısız!','Hata! Lütfen tekrar deneyiniz.', 'error'));
        }
    }

    public function sitemap()
    {
        $blog      = Blog::orderBy('order','asc')->get();
        $services  = Services::orderBy('order','asc')->get();
        $pages     = Pages::all();
        $team      = Team::all();
        $now       = Carbon::now()->toAtomString();
        $content   = view('front.sitemap', compact('now','blog','services','pages','team'));
        return response($content)->header('Content-Type', 'application/xml');
    }
}
