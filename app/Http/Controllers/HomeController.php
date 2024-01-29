<?php

namespace App\Http\Controllers;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use App\Admin\Inventory;
use App\Admin\Size;
use App\Admin\Sale;
use App\Admin\SecretKey;
use Auth;
use App\Admin\Receipt;
use App\Admin\UnitOfMeasure;
use App\Admin\Category;
use App\Admin\ReceiptNumber;
use RealRashid\SweetAlert\Facades\Alert;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth::user()->station_id != 0)
        {
            if(auth::user()->station_id == 21)
            {
                if(session('error'))
                {
                    Alert::error('Error!', 'Unknown Secret Key');
                }
                $header = 'INCOMING ORDERS';
                $toaster = 0;
                $category = Category::find(auth::user()->station_id);
                $orders = Sale::where([['category_id', auth::user()->station_id],['status',0]])->orWhere([['category_id', 17],['status',0]])
                                                                                                ->orWhere([['category_id', 29],['status',0]])->get();
                $current_orders = count($orders);
                if(session()->has('old_orders'))
                {
                    $old_orders = session()->get('old_orders'); 
                    $new_orders = $current_orders;
                    session(['old_orders' => $current_orders]); 
                } 
                else
                {
                    session(['old_orders' => $current_orders]); 
                    $old_orders = session()->get('old_orders'); 
                    $new_orders = $current_orders;
                }           
                $processed_orders = Sale::where([['category_id', auth::user()->station_id],['status',1]])->orWhere([['category_id', 17],['status',1]])
                                                                                                         ->orWhere([['category_id', 29],['status',1]])->get();
                $waiting_orders = Sale::where([['category_id', auth::user()->station_id],['status',2]])->orWhere([['category_id', 17],['status',2]])
                                                                                                        ->orWhere([['category_id', 29],['status',2]])->get();
                $collected = Sale::where([['category_id', auth::user()->station_id],['status',3]])->orWhere([['category_id', 17],['status',3]])
                                                                                                  ->orWhere([['category_id', 29],['status',3]])->get();
                return view('Station.home_dashboard')->with('category', $category)
                                                ->with('orders', $orders)
                                                ->with('toaster', $toaster)
                                                ->with('old_orders', $old_orders)
                                                ->with('new_orders', $new_orders)
                                                ->with('header', $header)
                                                ->with('collected', $collected)
                                                ->with('waiting_orders', $waiting_orders)
                                                ->with('processed_orders', $processed_orders);

            }
            else
            {
                if(session('error'))
                {
                    Alert::error('Error!', 'Unknown Secret Key');
                }
                $header = 'INCOMING ORDERS';
                $toaster = 0;
                $category = Category::find(auth::user()->station_id);
                $orders = Sale::where([['category_id', auth::user()->station_id],['status',0]])->get();
                $current_orders = count($orders);
                if(session()->has('old_orders'))
                {
                    $old_orders = session()->get('old_orders'); 
                    $new_orders = $current_orders;
                    session(['old_orders' => $current_orders]); 
                } 
                else
                {
                    session(['old_orders' => $current_orders]); 
                    $old_orders = session()->get('old_orders'); 
                    $new_orders = $current_orders;
                }           
                $processed_orders = Sale::where([['category_id', auth::user()->station_id],['status',1]])->get();
                $waiting_orders = Sale::where([['category_id', auth::user()->station_id],['status',2]])->get();
                $collected = Sale::where([['category_id', auth::user()->station_id],['status',3]])->get();
                return view('Station.home_dashboard')->with('category', $category)
                                                ->with('orders', $orders)
                                                ->with('toaster', $toaster)
                                                ->with('old_orders', $old_orders)
                                                ->with('new_orders', $new_orders)
                                                ->with('header', $header)
                                                ->with('collected', $collected)
                                                ->with('waiting_orders', $waiting_orders)
                                                ->with('processed_orders', $processed_orders);
                                            
            }
        }
        else
        {
            if(auth::user()->level_id == 1)
            {
                if(session()->has('receipt'))
                {
                    $current_receipt = session()->get('receipt'); 
                }
                else
                {
                    $new_receipt = rand(100000,999999);
                    session(['receipt' => $new_receipt]); 
                    $current_receipt = session()->get('receipt'); 
                }
                $header = 'Product Categories';
                $toaster = 0;
                $selected = array();
                $today = date("Y-m-d");
                $secret_key = SecretKey::where([['user_id', auth::user()->id],['date', $today]])->first();
                $receipts = Receipt::where([['user_id',auth::user()->id],['status',1]])->get();
                $invoices = Receipt::where([['user_id',auth::user()->id],['status',0]])->get();
                $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$current_receipt]])->orderby('created_at','asc')->get();
                $categories = Category::all();
                $my_processed_orders = Sale::where([['status',1],['user_id', auth::user()->id]])->get();
                $my_current_orders = count($my_processed_orders);
                if(session()->has('my_old_orders'))
                {
                    $my_old_orders = session()->get('my_old_orders'); 
                    $my_new_orders = count($my_processed_orders);
                    session(['my_old_orders' => $my_current_orders]); 
                } 
                else
                {
                    session(['my_old_orders' => $my_current_orders]); 
                    $my_old_orders = session()->get('my_old_orders'); 
                    $my_new_orders = count($my_processed_orders);
                } 
                return view('Waiter.dashboard')->with('categories', $categories)
                                ->with('toaster', $toaster)
                                ->with('selected', $selected)
                                ->with('secret_key', $secret_key)
                                ->with('my_processed_orders', $my_processed_orders)
                                ->with('my_old_orders', $my_old_orders)
                                ->with('my_new_orders', $my_new_orders)
                                ->with('products', $products)
                                ->with('invoices', $invoices)
                                ->with('receipts', $receipts)
                                ->with('current_receipt', $current_receipt)
                                ->with('header', $header);
            }
            elseif(auth::user()->level_id == 5)
            {
                if(session()->has('receipt'))
                {
                    $current_receipt = session()->get('receipt'); 
                }
                else
                {
                    $new_receipt = rand(100000,999999);
                    session(['receipt' => $new_receipt]); 
                    $current_receipt = session()->get('receipt'); 
                }
                $header = 'Product Categories';
                $toaster = 0;
                $selected = array();
                $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$current_receipt]])->orderby('created_at','asc')->get();
                $categories = Category::all();
                return view('Director.dashboard')->with('categories', $categories)
                                ->with('toaster', $toaster)
                                ->with('selected', $selected)
                                ->with('selected', $selected)
                                ->with('products', $products)
                                ->with('current_receipt', $current_receipt)
                                ->with('header', $header);
            }
            elseif(auth::user()->level_id == 6)
            {
                $receipts = Receipt::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',1]])->get();
                $invoices = Receipt::where('status',0)->get();
              
                return view('Cashier.orders')->with('receipts',$receipts)
                                             ->with('invoices',$invoices);
            }
            elseif(auth::user()->level_id == 7)
            {
                $today = date("Y-m-d");
                $total_receipts = 0;
                $total_mpesa = 0;
                $total_cash = 0;
                $total_invoice = 0;
                $receipts = Receipt::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',1]])->get();
                    foreach($receipts as $receipt)
                    {
                        $total_receipts += $receipt->to_pay;
                    }
                $invoices = Receipt::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',0]])->get();
                    foreach($invoices as $invoice)
                    {
                        $total_invoice += $invoice->to_pay;
                    }
                return view('Cashier.dashboard')->with('receipts',$receipts)
                                                ->with('total_receipts',$total_receipts)
                                                ->with('total_invoice',$total_invoice)
                                                ->with('invoices',$invoices);
            }
            else
            {
                $chart_options = [
                    'chart_title' => 'Sales By Product',
                    'chart_type' => 'bar',
                    'report_type' => 'group_by_relationship',
                    'model' => 'App\Admin\Sale',
                
                    'relationship_name' => 'product', // represents function user() on Sale model
                    'group_by_field' => 'name', // users.name
                
                    'aggregate_function' => 'sum',
                    'aggregate_field' => 'line_total',
                    'filter_field' => 'created_at',
                    'filter_days' => 7, // show only transactions for last 30 days
                    'filter_period' => 'week', // show only transactions for this week
                    'color' => 'white',
                ];

                $chart1 = new LaravelChart($chart_options);

                $chart_options = [
                    'chart_title' => 'Daily Sales',
                    'report_type' => 'group_by_date',
                    'model' => 'App\Admin\Sale',
                    'group_by_field' => 'created_at',
                    'group_by_period' => 'day',
                    'chart_type' => 'line',
                    'aggregate_function' => 'sum',
                    'aggregate_field' => 'line_total',
                    'filter_days' => 7,
                    'filter_period' =>'week',
                    'color' => 'white',
                    
                        ];
            
                $chart2 = new LaravelChart($chart_options);
            
                $chart_options = [
                    'chart_title' => 'Sales By Agent',
                    'chart_type' => 'bar',
                    'report_type' => 'group_by_relationship',
                    'model' => 'App\Admin\Sale',
                
                    'relationship_name' => 'user', // represents function user() on Sale model
                    'group_by_field' => 'name', // users.name
                
                    'aggregate_function' => 'sum',
                    'aggregate_field' => 'line_total',
                ];
            
                $chart3 = new LaravelChart($chart_options);

                $chart_options = [
                    'chart_title' => 'Sales By Category',
                    'chart_type' => 'bar',
                    'report_type' => 'group_by_relationship',
                    'model' => 'App\Admin\Sale',
                
                    'relationship_name' => 'category', // represents function user() on Sale model
                    'group_by_field' => 'name', // users.name
                
                    'aggregate_function' => 'sum',
                    'aggregate_field' => 'line_total',
                ];
            
                $chart4 = new LaravelChart($chart_options);
            
                return view('Admin.dashboard', compact('chart1', 'chart2', 'chart3', 'chart4'));


            }
        }
    }
}