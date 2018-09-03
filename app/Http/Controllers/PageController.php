<?php

namespace App\Http\Controllers;

use App\Bill;
use App\BillDetail;
use App\Cart;
use App\Customer;
use App\Product;
use App\ProductType;
use App\Slide;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    //

    public function indexView()
    {
        $slide = Slide::all();
        $newProduct = Product::where('new', 1)->take(8)->get();
        $promotionProduct = Product::where('promotion_price', '<>', 0)->paginate(8);
        return view('pages.home', ['slide' => $slide, 'newProduct' => $newProduct, 'promotionProduct' => $promotionProduct]);
    }

    public function categoryView($id)
    {
        $productType = ProductType::find($id);
        $listProductType = ProductType::all();
        $product = Product::where('id_type', $id)->paginate(9);
        return view('pages.category', ['productType' => $productType, 'list' => $product, 'listProductType' => $listProductType]);
    }

    public function productView($id)
    {
        $product = Product::find($id);
        $listRelated = Product::where('id_type', $product->id_type)->inRandomOrder()->take(3)->get();
        $newProduct = Product::where('new', 1)->inRandomOrder()->take(4)->get();
        $promotionProduct = Product::where('promotion_price', '<>', 0)->inRandomOrder()->take(4)->get();
        return view('pages.productDetail', ['product' => $product, 'listRelated' => $listRelated, 'listNew' => $newProduct, 'listPromotion' => $promotionProduct]);
    }

    public function contactView()
    {
        return view('pages.contact');
    }

    public function aboutView()
    {
        return view('pages.about');
    }

    public function addToCart(Request $request, $id)
    {
        $prod = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($prod, $id);
        $request->session()->put('cart', $cart);

        return redirect()->back();
    }

    public function deleteItemCart($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items)) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->back();
    }

    public function orderView()
    {
        return view('pages.order');
    }

    public function order(Request $request)
    {
        $cart = Session::get('cart');

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone_number;
        $customer->note = $request->note;
        $customer->save();

        $bill = new Bill();
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $request->payment_method;
        $bill->note = $request->note;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail();
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            if ($value['item']['promotion_price'] > 0) {
                $bill_detail->unit_price = $value['item']['promotion_price'];
            } else {
                $bill_detail->unit_price = $value['item']['unit_price'];
            }
            $bill_detail->save();
        }

        Session::forget('cart');
        return redirect('/home');
    }

    public function registerView()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $this->validate($request,
            [
                'full_name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:5|max:20',
                'passwordAgain' => 'required|same:password'
            ]
        );
        $user = new User();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->passwordAgain);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->with('status', 'Đăng ký thành công.');
    }

    public function loginView()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/home');
        } else {
            return redirect('/login')->with('status', 'Đăng nhập không thành công.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/home');
    }

    public function search(Request $request)
    {
        $list = Product::where('name', 'like', '%'.$request->search.'%')->orWhere('unit_price', $request->search)->get();
        return view('pages.search', ['list' => $list]);
    }

}
