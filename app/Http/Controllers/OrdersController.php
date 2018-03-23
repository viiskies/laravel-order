<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeOrderStatusRequest;
use App\Invoice;
use App\Mail\OrderConfirmed;
use App\Mail\OrderRejected;
use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Services\InvoiceService;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $checkInvoice;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->checkInvoice = $invoiceService;
    }

    public function index()
    {
        $user=Auth::user();
        if($user->role == 'admin')
        {
            $orders = Order::paginate(config('pagination.value'));
        }else{
            $orders =$user->orders()->paginate(config('pagination.value'));
        }

        return view('orders.orders', [
            'orders'=>$orders,
        ]);
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $products = $order->orderProducts;

        return view('orders.single_order', ['products'=> $products, 'order'=> $order]);
    }

    public function action(ChangeOrderStatusRequest $request, $id)
    {
        $userEmail = Auth::user()->client->email;
        if ($request->action === 'confirm') {
            $status = Order::CONFIRMED;
            Mail::to($userEmail)->send(new OrderConfirmed($id));

        } elseif($request->action === 'reject') {
            $status = Order::REJECTED;
            Mail::to($userEmail)->send(new OrderRejected($id));
        }

        $file = $request->file('invoice');
        if (isset($file))
        {
            $filenameWithExt = $this->checkInvoice->generateName($file);

            Invoice::create($request->except('_token') + [
                    'filename' => $filenameWithExt,
                    'order_id' =>$id,
                ]);

            $file->storeAs('public/invoices', $filenameWithExt);
        }

        Order::findOrFail($id)->update(['status' => $status]);
        return redirect()->route('order.orders');
    }
}
