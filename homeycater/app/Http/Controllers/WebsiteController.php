<?php

namespace App\Http\Controllers;

use App\Models\CaterMenu;
use App\Models\FoodCategory;
use App\Models\FoodDish;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Owenoj\LaravelGetId3\GetId3;
use Validator;
use App\Models\Contact;
use App\Models\Cater;
use Mockery\Undefined;
use App\Models\GuestDetail;
use App\Models\Ad;
use App\Models\UserRating;
use Mail;
use App\Models\CaterMessage;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class WebsiteController extends Controller
{
    public function index() {
        $categories = FoodCategory::orderBy('position', 'asc')->paginate(6);
        return view('front.home', compact('categories'));
    }

    public function allCategories() {
        $categories = FoodCategory::orderBy('position', 'asc')->paginate(6);
        return view('front.foods.category-listing', compact('categories'));
    }

    public function allDishes($slug=null) {
        $category = FoodCategory::where('slug', $slug)->first();
        if(!empty($category)) {
            $dishes = FoodDish::where('food_category_id', $category->id)->orderBy('name','asc')->paginate(20);
        }else {
            $dishes = FoodDish::orderBy('name','asc')->paginate(20);
        }

        return view('front.foods.dishes', compact('dishes', 'category'));
    }

    public function allCaters(Request $request,$slug=null) {
    $dish = FoodDish::where('slug', $slug)->first();
    if(!empty($dish)) {
        if(!count($request->all()) || $request->has('page')){
            $caters = CaterMenu::where('food_dish_id', $dish->id)->with(['user', 'dish'])->paginate(6);
        }else{
            $data = $request->except(['large_order_catering','food_category']);

            $dish = FoodDish::where('slug',$request->slug)->first();
            if(!empty($dish)) {
                $url="";
                if(isset($request->food_category ) && $request->food_category != 'undefined'){
                    $category = FoodCategory::where('id',$request->food_category)->first();
                    $url= route('web.dishes',$category->slug);
                    return redirect()->route('web.dishes',$category->slug);

                }
                $caters = CaterMenu::where('food_dish_id', $dish->id)->whereHas('user.cater', function($query) use($request) {
                    $query->when($request->city != 'undefined', function ($query) use ($request) {
                        $query->where('city','LIKE', '%' . $request->city .'%');
                    })
                    ->when($request->town != 'undefined', function ($query) use ($request) {
                        $query->where('town','LIKE', '%' . $request->town .'%');
                    })
                    ->when($request->neighborhood != 'undefined', function ($query) use ($request) {
                        $query->where('neighborhood','LIKE', '%' . $request->neighborhood .'%');
                    })
                    ->when($request->home_delivery != 'undefined', function ($query) use ($request) {
                        $query->where('home_delivery','LIKE', '%' . $request->home_delivery .'%');
                    })
                    ->when($request->large_order_catering != 'undefined', function ($query) use ($request) {
                        $query->where('large_order_catering',$request->large_order_catering);
                    });
                })->with(['user','dish'])->paginate(6);
            }
        }
    }else{
     // $caters = CaterMenu::groupBy('user_id')->with(['user', 'dish'])->get();
    }
    // dd($caters);
    return view('front.foods.cater-listing', compact(['caters','slug']));
    }

    public function allCaterList(Request $request ){
        if((!count($request->all()) && $request->has('page')) || !count($request->all())){
            $caters = Cater::with(['user'])->paginate(12);
        }elseif(count($request->all())){
            if($request->option=='dish_type'){
                $food_dish_id =FoodDish::where('name','LIKE', '%' . $request->keyword .'%')->pluck('id');
                $caters = Cater::whereHas('user.caterMenus',function($q) use ($food_dish_id){
                    $q->whereIn('food_dish_id',$food_dish_id);
                })->with(['user'])->paginate(12);
                //dd($caters);
               
            }else{
                $caters=Cater::where($request->option,'LIKE', '%' . $request->keyword .'%')->paginate(12);
            };
           
        }
        
     
        return view('front.foods.all-cater-listing', compact(['caters']));
        
    }

    public function aboutUs() {
        return view('front.about-us');
    }

    public function contactUs() {
        return view('front.contact-us');
    }

    public function saveContact(Request $request){
         $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' =>'required|digits:10',
            'message' => 'required|min:10',
        ]);
         Contact::create($request->all());
         return redirect()->back()->with('success', 'Mesage Send Successfully');

    }

    public function registerCater() {
        return view('front.cater-registration');
    }

    public function faqs() {
        return view('front.faqs');
    }

    public function advertiseWithUs() {
        return view('front.advertise-with-us');
    }

    public function login() {
        return view('front.login');
    }

    public function loginPost(Request $request) {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if(!empty($user)) {
            if($user->user_type == 'cater') {
                if(Auth::attempt(['email' => $email, 'password' => $password])) {
                    return redirect()->route('web.home')->with('success', 'you will logged in successfully.');
                } else {
                    return redirect()->back()->with('error', 'your credentials could not matched.');
                }
            } else {
                return redirect()->back()->with('error', 'please registered with as cater first.');
            }
        } else {
            return redirect()->back()->with('error', 'your email not matched');
        }

    }


    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('web.login');
    }


    public function profile() {
        $user = User::where('id', auth()->user()->id)->first();
        // dd($user);
        return view('front.profile.user', compact('user'));
    }


    public function fileupload() {
        return view('form');
    }

    public function fileuploadCheck(Request $request) {
        // dd();
        $track = GetId3::fromUploadedFile($request->file('video'));
        dd($track->extractInfo());
    }
    public function CaterById($id){
     $cater = User::with('cater', 'getUserRatings')->findorfail($id);
    //  dd($cater->user_ratting);
     return view('front.foods.cater-profile', compact('cater'));
    }

    public function saveGuestDetail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' =>'required|numeric|digits:10',
        ]);
        GuestDetail::create(['email'=>$request->email,'phone'=>$request->phone]);
        return response()->json(['status'=>1]);

    }

    public function sendEmailToCater(Request $request){
        $cater = User::find($request->cater_id);
       
        $data = [
            'from_email'=>$request->email,
            'name'=>$request->name,'msg'=>$request->message,
            'subject'=>$request->subject,
            'cater_name'=>$cater->name,
            'to_email'=>$cater->email
        ];
        $sent = Mail::send('front.emails.cater_contact_email',$data, function($message) use ($data) {
           $message->to($data['to_email'],$data['cater_name'])->subject($data['subject']);
           $message->from($data['from_email'],'HomeyCater');
        });
         $cater_msg =CaterMessage::create([
            'user_id' => $request->cater_id,
            'name' => $request->name,
            'email'=> $request->email,
            'subject'=> $request->subject,
            'messages'=> $request->message,
        ]);
        return response()->json(['status'=>1]);
    }

    public function rateCater(Request $request, $id) {
        $request->validate([
            'email' => 'required|email',
            'name' =>'required',
            'rating' => 'required'
        ]);
        UserRating::create([ 'user_id' => $id,'email'=>$request->email,'name'=>$request->name, 'ratting' => $request->rating, "reviews" => $request->reviews]);
        return response()->json(['status'=>1]);
    }
}
