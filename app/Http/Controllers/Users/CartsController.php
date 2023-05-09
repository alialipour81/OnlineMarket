<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Cart\CreateRequestCart;
use App\Http\Requests\Users\Cart\UpdateRequestCart;
use App\Models\Category;
use App\Models\Order;
use App\Pay\zarinpal;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;


class CartsController extends Controller
{
    public function __construct()
    {
        $this->middleware('ContinueShopping')->only('continue');
    }
    public function add(CreateRequestCart $request)
    {
        \Cart::add([
           'id'=>$request->id,
           'name'=>$request->title_fa,
            'price'=>$request->price,
           'quantity'=>$request->quantity,
            'attributes'=>[
                'image'=>$request->image,
                'gr'=>$request->gr,
                'forosh'=>$request->forosh,
                'colors'=>$request->colors,
                'slug'=>$request->slug
            ],
        ]);
        session()->flash('success','محصول با موفقیت به سبد خرید اضافه شد');
        return redirect(route('fronts.cart'));
    }

    public function update(UpdateRequestCart $request)
    {
 if ($request->quantity <= 0){
     \Cart::remove($request->id);
     session()->flash('success','محصول حذف شد');
 }else{
     \Cart::update($request->id,[
         'quantity'=>[
             'relative'=>false,
             'value'=>$request->quantity
         ]
     ]);
     session()->flash('success','محصول با موفقیت  ویرایش شد');
 }
        return redirect(route('fronts.cart'));
    }

    public function remove(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success','محصول با موفقیت  حذف شد');
        return redirect(route('fronts.cart'));
    }

    public function clear()
    {
        \Cart::clear();
        session()->flash('success','همه محصولات  با موفقیت حذف شدند');
        return redirect(route('fronts.cart'));
    }

    public function continue()
    {
        $items = \Cart::getContent();
        $categories = Category::where('parent_id',0)->get();
        return view('fronts.continue-shopping',compact('items','categories'));
    }





    public function request_zarinpal(Request $request)
    {
//        dd($request);
        $MerchantID 	= "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
        $Amount 		= session()->get('total');
        $Description 	= "خرید محصول از فروشگاه آنلاین مارکت  ";
        $Email 			= auth()->user()->email;
        $Mobile 		= auth()->user()->phone;
        $CallbackURL 	= url('zarinpal-callback');
        $ZarinGate 		= false;
        $SandBox 		= true;

        $zp 	= new zarinpal();
        $result = $zp->request($MerchantID, $Amount, $Description, $Email, $Mobile, $CallbackURL, $SandBox, $ZarinGate);

        if (isset($result["Status"]) && $result["Status"] == 100)
        {
            // Success and redirect to pay
            $zp->redirect($result["StartPay"]);
        } else {
            // error
            echo "خطا در ایجاد تراکنش";
        }
    }

    public function zarinpal_callback()
    {
        $MerchantID 	= "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
        $Amount 		= session()->get('total');
        $ZarinGate 		= false;
        $SandBox 		= true;

        $zp 	= new zarinpal();
        $result = $zp->verify($MerchantID, $Amount, $SandBox, $ZarinGate);

        if (isset($result["Status"]) && $result["Status"] == 100)
        {
            $items = \Cart::getContent();
            foreach ($items as $item){
                $ordre = Order::create([
                     'product_id'=>$item->id,
                    'user_id'=>auth()->user()->id,
                    'total'=>session()->get('total'),
                    'quantity'=>$item->quantity,
                    'color'=>$item->attributes->colors,
                    'pay_number'=>$result['Authority']
                ]);
                if(session()->has('discount')){
                    $ordre->discount = session()->get('discount');
                    $ordre->save();
                    session()->forget('discount');
                }
            }
            \Cart::clear();
            session()->flash('success','خرید شما موفقیت آمیز بود محصول طی روز های آینده بدستتان میرسد');
            return redirect(route('fronts.cart'));
        } else {
            // error
            echo "پرداخت ناموفق";
        }

    }


}
