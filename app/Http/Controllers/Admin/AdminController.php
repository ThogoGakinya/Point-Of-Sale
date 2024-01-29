<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Admin\Inventory;
use App\Admin\Size;
use App\Admin\UnitOfMeasure;
use App\Admin\Category;
use App\Admin\CustomerTable;
use App\Admin\CategoryFlavour;
use App\Admin\CategorySize;
use App\Admin\Account;
use App\Admin\Statement;
use App\Admin\Toppings;
use App\Admin\Voids;
use App\Admin\Flavour;
use App\Admin\Receipt;
use App\Admin\Report;
use App\Admin\WaiterReport;
use App\Admin\WaiterItemizedReport;
use App\Admin\CompanyDetail;
use App\Admin\DeliveryRoute;
use App\Admin\DeliveryCharges;
use App\Admin\CombinedReceipt;
use App\Admin\CombinedOrder;
use App\Admin\SecretKey;
use App\Admin\Sale;
use App\User;
use App\Admin\Client;
use App\Admin\Supplier;
use App\Admin\ProductHistory;
use App\Admin\Expense;
use App\Admin\Mpesa;
use App\Admin\Mpesadaily;
use Auth;
use DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //Get all products
       public function fetchInventory()
    {
        if(session('success'))
        {
            toast('Added Successfully','success');
        }
        elseif(session('updated'))
        {
            toast('Updated Successfully','success');
        }
        elseif(session('deleted'))
        {
            toast('Deleted Successfully','success');
        }
        $stock_value = 0;
        $sale_value = 0;
        $profit = 0;
        $products = Inventory::orderBy('created_at','desc')->get();
        foreach($products as $product)
        {
            $stock_value += $product->cost * $product->instock;
            $sale_value += $product->regular_price * $product->instock;
            $profit = $sale_value - $stock_value; 
        }
        $categories = Category::where('status',1)->get();
        $uoms = UnitOfMeasure::all();
        $flavours = Flavour::all();
        $sizes = Size::all();
        return view('Admin.inventory')->with('products', $products)
                                      ->with('categories', $categories)
                                      ->with('uoms', $uoms)
                                      ->with('stock_value', $stock_value)
                                      ->with('sale_value', $sale_value)
                                      ->with('profit', $profit)
                                      ->with('flavours', $flavours)
                                      ->with('sizes', $sizes);
    }

    //Get all settings
    public function fetchSettings()
    {   
        if(session('success'))
        {
            toast('Added Successfully','success');
        }
        elseif(session('updated'))
        {
            toast('Updated Successfully','success');
        }
        elseif(session('deleted'))
        {
            toast('Deleted Successfully','success');
        }
        
        
        $uoms = UnitOfMeasure::all();
        $sizes = Size::all();
        $toppings = Toppings::all();
        $launcher = 0;
        $current_flavour_name = '';
        $current_flavour_id = '';
        $flavours = Flavour::where('status',1)->get();
        $tables = CustomerTable::all();
        $categories = Category::where('status',1)->get(); 
        $category_flavours = array();
       
        return view('Admin.settings')->with('categories', $categories)
                                     ->with('uoms', $uoms)
                                     ->with('toppings', $toppings)
                                     ->with('flavours', $flavours)
                                     ->with('current_flavour_name', $current_flavour_name)
                                     ->with('current_flavour_id', $current_flavour_id)
                                     ->with('launcher', $launcher)
                                     ->with('category_flavours', $category_flavours)
                                     ->with('tables', $tables)
                                     ->with('sizes', $sizes);
    }

    //Add product category
    public function AddCategory(Request $request)
    {
         //Get image names with extension.
        if($request->hasFile('image_name'))
        {  
            $imageName = $request->file('image_name')->getClientOriginalName();
            $imageNameToStore = time().'_'.$imageName;
        }
        else
        {
            $imageName = '';
            $imageNameToStore = 'default_image.jpg';
        }  

         //Uploading the image now
        if($request->hasFile('image_name'))
        {
            $path1 = $request->file('image_name')->storeAs('Documents', $imageNameToStore);
        }
        $category = new Category;
        $category->name = $request->category_name;
        $category->short_form = $request->short;
        $category->image_name = $imageNameToStore;
        $category->save();
        
        return back()->with('success','Added Successfully');
    }

    //Update category
    public function updateCategory(Request $request, $id)
    {
        //Get image names with extension.
        if($request->hasFile('product_image'))
        {  
            $imageName = $request->file('product_image')->getClientOriginalName();
            $imageNameToStore = time().'_'.$imageName;
        }
        else
        {
            $imageName = '';
            $imageNameToStore = $request->old_product_image;
        }
        
             //Uploading the image now
            if($request->hasFile('product_image'))
            {
                $path1 = $request->file('product_image')->storeAs('Documents', $imageNameToStore);
            }
        $category = Category::find($request->category_id);
        $category->name = $request->category_name;
        $category->short_form = $request->short;
        $category->update();
        
        return back()->with('updated','Added Successfully');
    }

    //Update order status
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Sale::find($request->order_id);
        $order->status = $request->status;
        if($request->status == 1)
        {
            $order->processed_time = date("Y-m-d H:i:s"); 
            $order->status = $request->status;
            $order->update();
            return redirect('home');
        }
        if($request->status == 3)
        {
            $order->collection_time = date("Y-m-d H:i:s"); 
            $order->status = $request->status;
            $order->update();
            return redirect('home');
        }
        $order->update();
        
        return redirect('home');
    }


    //destroy category
    public function destroyCategory(Request $request, $id)
    {
        $to_destroy = Category::find($request->category_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }

    //Add product size
    public function AddSize(Request $request)
    {
        $size = new Size;
        $size->name = $request->size_name;
        $size->short_form = $request->short;
        $size->uom_id = $request->uom_id;
        $size->save();
        
        return back()->with('success','Added Successfully');
    }

    //Update size
    public function updateSize(Request $request, $id)
    {
        $size = Size::find($request->size_id);
        $size->name = $request->size_name;
        $size->short_form = $request->short;
        $size->uom_id = $request->uom_id;
        $size->update();
        
        return back()->with('updated','Added Successfully');
    }

    //destroy size
    public function destroySize(Request $request, $id)
    {
        $to_destroy = Size::find($request->size_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }

    //Add product UOM
    public function AddUom(Request $request)
    {
        $uom = new UnitOfMeasure;
        $uom->name = $request->uom_name;
        $uom->short_form = $request->short;
        $uom->category_id = $request->category_id;
        $uom->save();
        
        return back()->with('success','Added Successfully');
    }

    //Update UOM
    public function updateUom(Request $request, $id)
    {
        $uom = UnitOfMeasure::find($request->uom_id);
        $uom->name = $request->uom_name;
        $uom->short_form = $request->short;
        $uom->category_id = $request->category_id;
        $uom->update();
        
        return back()->with('updated','Added Successfully');
    }

    //destroy UOM
    public function destroyUom(Request $request, $id)
    {
        $to_destroy = UnitOfMeasure::find($request->uom_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }

    //Add product Flavour
    public function AddFlavour(Request $request)
    {
        $uom = new Flavour;
        $uom->name = $request->flavour_name;
        $uom->short_form = $request->short;
        $uom->category_id = $request->category_id;
        $uom->save();
        
        return back()->with('success','Added Successfully');
    }

    //Update Flavour
    public function updateFlavour(Request $request, $id)
    {
        $uom = Flavour::find($request->flavour_id);
        $uom->name = $request->flavour_name;
        $uom->short_form = $request->short;
        $uom->category_id = $request->category_id;
        $uom->update();
        
        return back()->with('updated','Added Successfully');
    }

    //destroy UOM
    public function destroyFlavour(Request $request, $id)
    {
        $to_destroy = Flavour::find($request->flavour_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }
    //Add product Topping
    public function AddTopping(Request $request)
    {
        $uom = new Toppings;
        $uom->name = $request->topping_name;
        $uom->short_form = $request->short;
        $uom->uom_id = $request->uom_id;
        $uom->save();
        
        return back()->with('success','Added Successfully');
    }

    //Update Topping 
    public function updateTopping(Request $request, $id)
    {
        $uom = Toppings::find($request->topping_id);
        $uom->name = $request->topping_name;
        $uom->short_form = $request->short;
        $uom->uom_id = $request->uom_id;
        $uom->update();
        
        return back()->with('updated','Added Successfully');
    }

    //destroy Topping
    public function destroyTopping(Request $request, $id)
    {
        $to_destroy = Toppings::find($request->topping_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }
     
    //Add Customer Table
    public function addTable(Request $request)
    {
        $tab = new CustomerTable;
        $tab->name = $request->table_name;
        $tab->capacity = $request->capacity;
        $tab->save();
        
        return back()->with('success','Added Successfully');
    }

    //Update table
    public function updateTable(Request $request, $id)
    {
        $tab = CustomerTable::find($request->table_id);
        $tab->name = $request->table_name;
        $tab->capacity = $request->capacity;
        $tab->update();
        
        return back()->with('updated','Added Successfully');
    }

    //destroy table
    public function destroyTable(Request $request, $id)
    {
        $to_destroy = CustomerTable::find($request->table_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }
     
     //Add New Product
    public function newProduct(Request $request)
    {
         //Get image names with extension.
        if($request->hasFile('product_image'))
        {  
            $imageName = $request->file('product_image')->getClientOriginalName();
            $imageNameToStore = time().'_'.$imageName;
        }
        else
        {
            $imageName = '';
            $imageNameToStore = 'default_image.jpg';
        }
        
             //Uploading the image now
            if($request->hasFile('product_image'))
            {
                $path1 = $request->file('product_image')->storeAs('Documents', $imageNameToStore);
            }
        $inventory = new Inventory;
        $inventory ->name = $request->product_name;
        $inventory ->code = $request->product_code;
        $inventory ->category_id = $request->category_id;
        $inventory ->size_id = $request->size_id;
        $inventory ->uom_id = $request->unit_id;
        $inventory ->flavour_id = $request->flavour_id;
        $inventory ->topping_id = $request->topping_id;
        $inventory ->instock = $request->quantity;
        $inventory ->regular_price = $request->regular_price;
        $inventory ->price_level2 = $request->price_level_2;
        $inventory ->base_stock = $request->base_stock;
        $inventory ->cost = $request->cost_price;
        $inventory ->image_name = $imageNameToStore;
        $inventory->save();
        
        return back()->with('success','Added Successfully');
    }

    //Update Product
    public function updateProduct(Request $request, $id)
    {
         //Get image names with extension.
        if($request->hasFile('product_image'))
        {  
            $imageName = $request->file('product_image')->getClientOriginalName();
            $imageNameToStore = time().'_'.$imageName;
        }
        else
        {
            $imageName = '';
            $imageNameToStore = $request->old_product_image;;
        }
        
             //Uploading the image now
            if($request->hasFile('product_image'))
            {
                $path1 = $request->file('product_image')->storeAs('Documents', $imageNameToStore);
            }
        $inventory = Inventory::find($request->product_id);
        $inventory ->name = $request->product_name;
        $inventory ->code = $request->product_code;
        $inventory ->category_id = $request->category_id;
        $inventory ->size_id = $request->size_id;
        $inventory ->flavour_id = $request->flavour_id;
        $inventory ->uom_id = $request->unit_id;
        $inventory ->instock = $request->quantity;
        $inventory ->regular_price = $request->regular_price;
        $inventory ->price_level2 = $request->price_level_2;
        $inventory ->base_stock = $request->base_stock;
        $inventory ->cost = $request->cost_price;
        $inventory ->image_name = $imageNameToStore;
        $inventory->update();
        
        return back()->with('updated','Updated Successfully');
    }

     //destroy Product
     public function destroyProduct(Request $request, $id)
     {
         $to_destroy = Inventory::find($request->product_id);
         $to_destroy->delete();
         return back()->with('deleted','Deleted Successfully');
     }

     //fetch category
     public function fetchCategoryMembers($id, $mode)
     {
        if(session('error'))
        {
            Alert::error('Oops!', 'No Product found.Please check your search options');
        }
        if(session('error4'))
        {
            Alert::error('Error!', 'Delivery already charged');
        }
        elseif(session('updated'))
        {
            toast('Updated Successfully','success');
        }
        elseif(session('deleted'))
        {
            toast('Deleted Successfully','success');
        }
        $category = Category::find($id);
        $header = $category->name;
        $mode = $mode; 
        $popup_trigger = 0;
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
        $toaster = 1;
        $current_receipt = session()->get('receipt');
        $selected = array();
        $toppings = array();
        $delivery_charges = DeliveryCharges::where('receipt_id',$current_receipt)->get();
        $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$current_receipt]])->orderby('created_at','asc')->get();
        $category_id = $id;
        $sizes = CategorySize::where('category_id',$category_id)->get();
        $flavours = CategoryFlavour::where('category_id',$id)->get();
        $uoms = UnitOfMeasure::where('category_id',$id)->get();
        if($id == 0)
        {
            $inventories = Inventory::all();
        }
        else
        {
            $inventories = Inventory::where('category_id',$category_id)->get();
        }

        return view('Waiter.categories')->with('flavours', $flavours)
                           ->with('toaster', $toaster)
                           ->with('inventories', $inventories)
                           ->with('delivery_charges', $delivery_charges)
                           ->with('my_old_orders', $my_old_orders)
                            ->with('my_new_orders', $my_new_orders)
                            ->with('my_processed_orders', $my_processed_orders)
                           ->with('category_id', $category_id)
                           ->with('current_receipt', $current_receipt)
                           ->with('header', $header)
                           ->with('mode', $mode)
                           ->with('popup_trigger', $popup_trigger)
                           ->with('products', $products)
                           ->with('sizes', $sizes)
                           ->with('toppings', $toppings)
                           ->with('selected', $selected)
                           ->with('uoms', $uoms);
     }

     //find toppings dynamically
     public function findToppings(Request $request)
     {
         $data= Toppings::where('uom_id',$request->id)->get();
         return response()->json($data);
     }

     //find flavours dynamically
     public function findFlavours(Request $request)
     {
         $data= CategoryFlavour::where('category_id',$request->id)->with('flavour')->get();
         return response()->json($data);
     }

     //find units dynamically
     public function findUnits(Request $request)
     {
         $data= UnitOfMeasure::where('category_id',$request->id)->get();
         return response()->json($data);
     }

     //find client data dynamically
     public function findClientData(Request $request)
     {
         $data = Client::find($request->id);
         return response()->json($data);
     }
     
     //find sizes dynamically
     public function findSizes(Request $request)
     {
         $data= CategorySize::where('category_id',$request->id)->with('size')->get();
         return response()->json($data);
     }

      //find route data dynamically
      public function findRouteData(Request $request)
      {
          $data = DeliveryRoute::find($request->id);
          return response()->json($data);
      }

     //Find a product to display for quantitation
     public function findProduct(Request $request)
     {
        $selected = Inventory::where([['flavour_id', $request->flavour_id],['category_id', $request->category_id],
                                    ['uom_id', $request->uom_id],['size_id', $request->size_id]])->get();
        if(count($selected) <= 0)
        {
            return back()->with('error', 'Nothing found');
        }
        else
        {
        $category = Category::find($request->category_id);
        $header = $category->name;
        $toaster = 1;
        $mode = $request->mode;
        $popup_trigger = 1;
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
        $toppings = $request->topping;
        $current_receipt = session()->get('receipt');
        $category_id = $request->category_id;
        $sizes = CategorySize::where('category_id',$category_id)->get();
        $delivery_charges = DeliveryCharges::where('receipt_id',$current_receipt)->get();
        $flavours = CategoryFlavour::where('category_id',$request->category_id)->get();
        $uoms = UnitOfMeasure::where('category_id',$request->category_id)->get();
        $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$current_receipt]])->orderby('created_at','asc')->get();
        return view('Waiter.categories')->with('flavours', $flavours)
                           ->with('toaster', $toaster)
                           ->with('category_id', $category_id)
                           ->with('header', $header)
                           ->with('my_old_orders', $my_old_orders)
                          ->with('my_new_orders', $my_new_orders)
                          ->with('my_processed_orders', $my_processed_orders)
                           ->with('delivery_charges', $delivery_charges)
                           ->with('current_receipt', $current_receipt)
                           ->with('sizes', $sizes)
                           ->with('popup_trigger', $popup_trigger)
                           ->with('toppings', $toppings)
                           ->with('mode', $mode)
                           ->with('selected', $selected)
                           ->with('products', $products)
                           ->with('uoms', $uoms);
        }
    }

  //code for running offers and promotions
      public function addToCartOffers(Request $request)
      {
          $day_today = date("l");
          if($day_today == 'Tuesday')
          {
              $happy_hour_start = strtotime('6:30pm');
              $happy_hour_end = strtotime('8pm');
              $current_time = strtotime('now');
                if($current_time > $happy_hour_start && $current_time < $happy_hour_end )
                {
                      if($request->category_id == 23 || $request->category_id == 24 || $request->category_id == 28 || $request->category_id == 49 ) //Naughty scoops and Cocktails and pizza
                      {
                          $quantity = $request->product_quantity;
                          $new_quantity = $quantity * 2 ;
                          $total_topings = ($request->toppings_amount)*($request->product_quantity);
                          $totals = $request->product_quantity * $request->product_price;
                          $line_total = ($total_topings + $totals );
                      } 
                      else
                      {
                      //Adding choosen product to cart
                          $new_quantity = $request->product_quantity;
                          $total_topings = ($request->toppings_amount)*($request->product_quantity);
                          $totals = $request->product_quantity * $request->product_price;
                          $line_total = ($total_topings + $totals );
                      }
                }
                else
                {
                  if($request->category_id == 28 || $request->category_id == 49) //pizza
                  {
                      $quantity = $request->product_quantity;
                      $new_quantity = $quantity * 2 ;
                      $total_topings = ($request->toppings_amount)*($request->product_quantity);
                      $totals = $request->product_quantity * $request->product_price;
                      $line_total = ($total_topings + $totals );
                  } 
                  else
                  {
                  //Adding choosen product to cart
                      $new_quantity = $request->product_quantity;
                      $total_topings = ($request->toppings_amount)*($request->product_quantity);
                      $totals = $request->product_quantity * $request->product_price;
                      $line_total = ($total_topings + $totals );
                  }
                }
          }
          elseif($day_today == 'Friday')
          {
            $happy_hour_start = strtotime('6:30pm');
            $happy_hour_end = strtotime('8pm');
              $current_time = strtotime('now');
                if($current_time > $happy_hour_start && $current_time < $happy_hour_end )
                {
                      if($request->category_id == 23 || $request->category_id == 24 || $request->category_id == 16 ) //Naughty scoops and Cocktails and burger
                      {
                          $quantity = $request->product_quantity;
                          $new_quantity = $quantity * 2 ;
                          $total_topings = ($request->toppings_amount)*($request->product_quantity);
                          $totals = $request->product_quantity * $request->product_price;
                          $line_total = ($total_topings + $totals );
                      } 
                      else
                      {
                      //Adding choosen product to cart
                          $new_quantity = $request->product_quantity;
                          $total_topings = ($request->toppings_amount)*($request->product_quantity);
                          $totals = $request->product_quantity * $request->product_price;
                          $line_total = ($total_topings + $totals );
                      }
                }
                else
                {
                  if($request->category_id == 16) //burger
                  {
                      $quantity = $request->product_quantity;
                      $new_quantity = $quantity * 2 ;
                      $total_topings = ($request->toppings_amount)*($request->product_quantity);
                      $totals = $request->product_quantity * $request->product_price;
                      $line_total = ($total_topings + $totals );
                  } 
                  else
                  {
                  //Adding choosen product to cart
                      $new_quantity = $request->product_quantity;
                      $total_topings = ($request->toppings_amount)*($request->product_quantity);
                      $totals = $request->product_quantity * $request->product_price;
                      $line_total = ($total_topings + $totals );
                  }
                }
          }
              elseif($day_today == 'Saturday')
          {
              $happy_hour_start = strtotime('6:30pm');
              $happy_hour_end = strtotime('8pm');
              $current_time = strtotime('now');
                if($current_time > $happy_hour_start && $current_time < $happy_hour_end )
                {
                    if($request->category_id == 23 || $request->category_id == 24 || $request->category_id == 21 ) //Naughty scoops and Cocktails and scoops
                    {
                        $quantity = $request->product_quantity;
                        $new_quantity = $quantity * 2 ;
                        $total_topings = ($request->toppings_amount)*($request->product_quantity);
                        $totals = $request->product_quantity * $request->product_price;
                        $line_total = ($total_topings + $totals );
                    } 
                    elseif($request->category_id == 41 || $request->category_id == 40 ) //scoopsmas pizza & scoopsmas burger
                    {
                        $new_quantity = $request->product_quantity;
                        $offer_quantity = ($request->product_quantity)/2;
                        $total_topings = ($request->toppings_amount)*($request->product_quantity);
                        $totals = $offer_quantity * $request->product_price;
                        $line_total = ($total_topings + $totals );
                    } 
                    else
                    {
                    //Adding choosen product to cart
                        $new_quantity = $request->product_quantity;
                        $total_topings = ($request->toppings_amount)*($request->product_quantity);
                        $totals = $request->product_quantity * $request->product_price;
                        $line_total = ($total_topings + $totals );
                    }
                }
                else
                {
                    if($request->category_id == 21) //scoops
                    {
                        $quantity = $request->product_quantity;
                        $new_quantity = $quantity * 2 ;
                        $total_topings = ($request->toppings_amount)*($request->product_quantity);
                        $totals = $request->product_quantity * $request->product_price;
                        $line_total = ($total_topings + $totals );
                    } 
                    elseif($request->category_id == 41 || $request->category_id == 40 ) //scoopsmas pizza & scoopsmas burger
                    {
                        $new_quantity = $request->product_quantity;
                        $offer_quantity = ($request->product_quantity)/2;
                        $total_topings = ($request->toppings_amount)*($request->product_quantity);
                        $totals = $offer_quantity * $request->product_price;
                        $line_total = ($total_topings + $totals );
                    } 
                    else
                    {
                    //Adding choosen product to cart
                        $new_quantity = $request->product_quantity;
                        $total_topings = ($request->toppings_amount)*($request->product_quantity);
                        $totals = $request->product_quantity * $request->product_price;
                        $line_total = ($total_topings + $totals );
                    }
                }
          }
          else
          {
            $happy_hour_start = strtotime('6:30pm');
            $happy_hour_end = strtotime('8pm');
            $current_time = strtotime('now');
                if($current_time > $happy_hour_start && $current_time < $happy_hour_end )
                {
                      if($request->category_id == 23 || $request->category_id == 24 ) //Naughty scoops and Cocktails
                      {
                          $quantity = $request->product_quantity;
                          $new_quantity = $quantity * 2 ;
                          $total_topings = ($request->toppings_amount)*($request->product_quantity);
                          $totals = $request->product_quantity * $request->product_price;
                          $line_total = ($total_topings + $totals );
                      } 
                      elseif($request->category_id == 41 || $request->category_id == 40 ) //scoopsmas pizza & scoopsmas burger
                      {
                          $new_quantity = $request->product_quantity;
                          $offer_quantity = ($request->product_quantity)/2;
                          $total_topings = ($request->toppings_amount)*($request->product_quantity);
                          $totals = $offer_quantity * $request->product_price;
                          $line_total = ($total_topings + $totals );
                      } 
                      else
                      {
                      //Adding choosen product to cart
                          $new_quantity = $request->product_quantity;
                          $total_topings = ($request->toppings_amount)*($request->product_quantity);
                          $totals = $request->product_quantity * $request->product_price;
                          $line_total = ($total_topings + $totals );
                      }
                }
                else
                {
                    if($request->category_id == 41 || $request->category_id == 40 ) //scoopsmas pizza & scoopsmas burger
                      {
                          $new_quantity = $request->product_quantity;
                          $offer_quantity = ($request->product_quantity)/2;
                          $total_topings = ($request->toppings_amount)*($request->product_quantity);
                          $totals = $offer_quantity * $request->product_price;
                          $line_total = ($total_topings + $totals );
                      }
                    else
                    {
                    $new_quantity = $request->product_quantity;
                    $total_topings = ($request->toppings_amount)*($request->product_quantity);
                    $totals = $request->product_quantity * $request->product_price;
                    $line_total = ($total_topings + $totals );
                      }
                }
  
          }
        
          $today = date("Y-m-d");
          $delivery_charges = DeliveryCharges::where('receipt_id',$request->product_receipt)->get();
          $check = Sale::where([['user_id',auth::user()->id],['receipt_no',$request->product_receipt],['product_id',$request->product_id]])->first();
          if($check != '')
          {
              $current_quantity = $check->quantity;
              $new_quantity = $current_quantity + $request->product_quantity;
              $new_line_total = $new_quantity * $request->product_price;
              $check->quantity = $new_quantity;
              $check->line_total = $new_line_total;
              $check->update(); 
              
              Inventory::find($request->product_id)->decrement('instock', $request->product_quantity);
              ProductHistory::where([['product_id',$request->product_id],['receipt_id',$request->product_receipt]])->increment('debit', $request->product_quantity);
              ProductHistory::where([['product_id',$request->product_id],['receipt_id',$request->product_receipt]])->decrement('new_stock', $request->product_quantity);
          }
          else
          {
              $to_add = new Sale;
              $to_add->product_id = $request->product_id;
              $to_add->receipt_no = $request->product_receipt;
              $to_add->quantity = $new_quantity;
              $to_add->user_id = auth::user()->id;
              $to_add->toppings = $request->toppings;
              $to_add->category_id = $request->category_id;
              $to_add->mode = $request->mode;
              $to_add->line_total = $line_total;
              $to_add->save();
  
              $add_history = new ProductHistory;
              $add_history->product_id = $request->product_id;
              $add_history->user_id = auth::user()->id;
              $add_history->debit = $new_quantity;
              $add_history->new_stock = $request->stock - $request->product_quantity;
              $add_history->receipt_id = $request->product_receipt;
              $add_history->save();
      
              Inventory::find($request->product_id)->decrement('instock', $request->product_quantity);
              
          }
  
           //updating table reports
           $report = Report::where([['product_id',$request->product_id],['date',$today]])->first();
           if($report != '')
           {
               $current_report_quantity = $report->quantity;
               $current_count = $report->count;
               $current_amount = $report->amount;
               $new_report_quantity = $current_report_quantity + $new_quantity;
               $new_count = $current_count + 1;
               $new_amount = $current_amount + $line_total;
   
               $report->quantity = $new_report_quantity;
               $report->count = $new_count;
               $report->amount = $new_amount;
               $report->update();  
           }
           else
           {
               $new_report = new Report;
               $new_report->product_id = $request->product_id;
               $new_report->quantity = $new_quantity;
               $new_report->category_id = $request->category_id;
               $new_report->flavour_id = $request->flavour_id;
               $new_report->count = 1;
               $new_report->amount = $line_total;
               $new_report->date = $today;
               $new_report->save();
               
           }
  
           //updating waiter itemized reports
           $waiter_report = WaiterItemizedReport::where([['product_id',$request->product_id],['date',$today],['user_id',auth::user()->id]])->first();
           if($waiter_report != '')
           {
               $current_report_quantity = $waiter_report->quantity;
               $current_count = $waiter_report->count;
               $current_amount = $waiter_report->amount;
               $new_report_quantity = $current_report_quantity + $new_quantity;
               $new_count = $current_count + 1;
               $new_amount = $current_amount + $line_total;
   
               $waiter_report->quantity = $new_report_quantity;
               $waiter_report->count = $new_count;
               $waiter_report->amount = $new_amount;
               $waiter_report->update();  
           }
           else
           {
               $new_report = new WaiterItemizedReport;
               $new_report->user_id = auth::user()->id;
               $new_report->product_id = $request->product_id;
               $new_report->quantity = $new_quantity;
               $new_report->category_id = $request->category_id;
               $new_report->flavour_id = $request->flavour_id;
               $new_report->count = 1;
               $new_report->amount = $line_total;
               $new_report->date = $today;
               $new_report->save();
               
           }
  
           //updating waiter daily totals
           $waiter_totals = WaiterReport::where([['date',$today],['user_id',auth::user()->id]])->first();
           if($waiter_totals != '')
           {
               $current_totals = $waiter_totals->total;
               $new_totals = $current_totals + $line_total;
               $waiter_totals->total = $new_totals;
               $waiter_totals->update();  
           }
           else
           {
               $new_report = new WaiterReport;
               $new_report->user_id = auth::user()->id;
               $new_report->total = $line_total;
               $new_report->date = $today;
               $new_report->save();
               
           }
   
              $category = Category::find($request->category_id);
              $header = $category->name;
              $toaster = 1;
              $category_id = $request->category_id;
              $current_receipt = session()->get('receipt');
              $sizes = CategorySize::where('category_id',$category_id)->get();
              $selected = array();
              $mode = $request->mode;
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
              $popup_trigger = 0;
              $flavours = CategoryFlavour::where('category_id',$request->category_id)->get();
              $uoms = UnitOfMeasure::where('category_id',$request->category_id)->get();
              $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$request->product_receipt]])->orderby('created_at','asc')->get();
              return view('Waiter.categories')->with('flavours', $flavours)
                          ->with('toaster', $toaster)
                          ->with('category_id', $category_id)
                          ->with('header', $header)
                          ->with('mode', $mode)
                          ->with('my_old_orders', $my_old_orders)
                          ->with('my_new_orders', $my_new_orders)
                          ->with('my_processed_orders', $my_processed_orders)
                          ->with('selected', $selected)
                          ->with('popup_trigger', $popup_trigger)
                          ->with('current_receipt', $current_receipt)
                          ->with('delivery_charges', $delivery_charges)
                          ->with('sizes', $sizes)
                          ->with('products', $products)
                          ->with('uoms', $uoms);
      }
 
 
    public function addToCart(Request $request)
    {
        //Adding choosen product to cart
        $today = date("Y-m-d");
        $delivery_charges = DeliveryCharges::where('receipt_id',$request->product_receipt)->get();
        $line_total = $request->product_quantity * $request->product_price;
        $check = Sale::where([['user_id',auth::user()->id],['receipt_no',$request->product_receipt],['product_id',$request->product_id]])->first();
        if($check != '')
        {
            $current_quantity = $check->quantity;
            $new_quantity = $current_quantity + $request->product_quantity;
            $new_line_total = $new_quantity * $request->product_price;
            $check->quantity = $new_quantity;
            $check->line_total = $new_line_total;
            $check->update(); 
            
            Inventory::find($request->product_id)->decrement('instock', $request->product_quantity);
            ProductHistory::where([['product_id',$request->product_id],['receipt_id',$request->product_receipt]])->increment('debit', $request->product_quantity);
            ProductHistory::where([['product_id',$request->product_id],['receipt_id',$request->product_receipt]])->decrement('new_stock', $request->product_quantity);
        }
        else
        {
            $total_topings = ($request->toppings_amount)*($request->product_quantity);
            $totals = $request->product_quantity * $request->product_price;
            $line_t = ($total_topings + $totals );
            $to_add = new Sale;
            $to_add->product_id = $request->product_id;
            $to_add->receipt_no = $request->product_receipt;
            $to_add->quantity = $request->product_quantity;
            $to_add->user_id = auth::user()->id;
            $to_add->toppings = $request->toppings;
            $to_add->category_id = $request->category_id;
            $to_add->mode = $request->mode;
            $line_total = $line_t;
            $to_add->line_total = $line_total;
            $to_add->save();

            $add_history = new ProductHistory;
            $add_history->product_id = $request->product_id;
            $add_history->user_id = auth::user()->id;
            $add_history->debit = $request->product_quantity;
            $add_history->new_stock = $request->stock - $request->product_quantity;
            $add_history->receipt_id = $request->product_receipt;
            $add_history->save();
    
            Inventory::find($request->product_id)->decrement('instock', $request->product_quantity);
            
        }

         //updating table reports
         $report = Report::where([['product_id',$request->product_id],['date',$today]])->first();
         if($report != '')
         {
             $current_report_quantity = $report->quantity;
             $current_count = $report->count;
             $current_amount = $report->amount;
             $new_report_quantity = $current_report_quantity + $request->product_quantity;
             $new_count = $current_count + 1;
             $new_amount = $current_amount + $line_total;
 
             $report->quantity = $new_report_quantity;
             $report->count = $new_count;
             $report->amount = $new_amount;
             $report->update();  
         }
         else
         {
             $new_report = new Report;
             $new_report->product_id = $request->product_id;
             $new_report->quantity = $request->product_quantity;
             $new_report->category_id = $request->category_id;
             $new_report->flavour_id = $request->flavour_id;
             $new_report->count = 1;
             $new_report->amount = $line_total;
             $new_report->date = $today;
             $new_report->save();
             
         }

         //updating waiter itemized reports
         $waiter_report = WaiterItemizedReport::where([['product_id',$request->product_id],['date',$today],['user_id',auth::user()->id]])->first();
         if($waiter_report != '')
         {
             $current_report_quantity = $waiter_report->quantity;
             $current_count = $waiter_report->count;
             $current_amount = $waiter_report->amount;
             $new_report_quantity = $current_report_quantity + $request->product_quantity;
             $new_count = $current_count + 1;
             $new_amount = $current_amount + $line_total;
 
             $waiter_report->quantity = $new_report_quantity;
             $waiter_report->count = $new_count;
             $waiter_report->amount = $new_amount;
             $waiter_report->update();  
         }
         else
         {
             $new_report = new WaiterItemizedReport;
             $new_report->user_id = auth::user()->id;
             $new_report->product_id = $request->product_id;
             $new_report->quantity = $request->product_quantity;
             $new_report->category_id = $request->category_id;
             $new_report->flavour_id = $request->flavour_id;
             $new_report->count = 1;
             $new_report->amount = $line_total;
             $new_report->date = $today;
             $new_report->save();
             
         }

         //updating waiter daily totals
         $waiter_totals = WaiterReport::where([['date',$today],['user_id',auth::user()->id]])->first();
         if($waiter_totals != '')
         {
             $current_totals = $waiter_totals->total;
             $new_totals = $current_totals + $line_total;
             $waiter_totals->total = $new_totals;
             $waiter_totals->update();  
         }
         else
         {
             $new_report = new WaiterReport;
             $new_report->user_id = auth::user()->id;
             $new_report->total = $line_total;
             $new_report->date = $today;
             $new_report->save();
             
         }
 
            $category = Category::find($request->category_id);
            $all_checker = $request->all_checker;
            
            $toaster = 1;
            $category_id = $request->category_id;
            $current_receipt = session()->get('receipt');
            $sizes = CategorySize::where('category_id',$category_id)->get();
            $selected = array();
            $mode = $request->mode;
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
            $popup_trigger = 0;
            $flavours = CategoryFlavour::where('category_id',$request->category_id)->get();
            $uoms = UnitOfMeasure::where('category_id',$request->category_id)->get();
            $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$request->product_receipt]])->orderby('created_at','asc')->get();
            if($all_checker == 0)
            {
                $inventories = Inventory::all();
                $header = "ALL PRODUCTS";
            }
            else
            {
                $inventories = Inventory::where('category_id',$category_id)->get();
                $header = $category->name;
            }
            $toppings = array();
            return view('Waiter.categories')->with('flavours', $flavours)
                        ->with('toaster', $toaster)
                        ->with('category_id', $category_id)
                        ->with('header', $header)
                        ->with('inventories', $inventories)
                        ->with('mode', $mode)
                        ->with('toppings', $toppings)
                        ->with('my_old_orders', $my_old_orders)
                        ->with('my_new_orders', $my_new_orders)
                        ->with('my_processed_orders', $my_processed_orders)
                        ->with('selected', $selected)
                        ->with('popup_trigger', $popup_trigger)
                        ->with('current_receipt', $current_receipt)
                        ->with('delivery_charges', $delivery_charges)
                        ->with('sizes', $sizes)
                        ->with('products', $products)
                        ->with('uoms', $uoms);
    }

    //remove from cart
    public function removeFromCart(Request $request, $id)
    {
        $today = date("Y-m-d");
        $param1 = $request->serving_mode;
        $param2 = $request->category_id;
        $inventory_id = $request->inventory_id;
        $line_total = $request->line_total;

        $to_destroy = Sale::find($request->product_id);
        $to_destroy->delete();

        Inventory::find($request->inventory_id)->increment('instock', $request->product_quantity);
        ProductHistory::where([['product_id',$request->inventory_id],['receipt_id',$request->receipt_id]])->delete();
        
        $report = Report::where([['product_id',$request->inventory_id],['date',$today]])->first();
        $checker = $report->count;
        if($checker == 1)
        {
            $report->delete();
        }
        else
        {
            $report->decrement('quantity',$request->product_quantity);
            $report->decrement('count',1);
            $report->decrement('amount',$line_total);
        }

        $waiter_report = WaiterItemizedReport::where([['product_id',$request->inventory_id],['date',$today],['user_id',auth::user()->id]])->first();
        $waiter_checker = $waiter_report->count;
        if($checker == 1)
        {
            $waiter_report->delete();
        }
        else
        {
            $waiter_report->decrement('quantity',$request->product_quantity);
            $waiter_report->decrement('count',1);
            $waiter_report->decrement('amount',$line_total);
            
        }

        WaiterReport::where([['date',$today],['user_id',auth::user()->id]])->decrement('total',$line_total);

        return redirect('/category/'.$param2 .'/' .$param1);
    
    }

    //remove delivery charges
    public function removeDelivery(Request $request, $id)
    {
        $param1 = $request->serving_mode;
        $param2 = $request->category_id;

        $to_destroy = DeliveryCharges::find($request->delivery_id);
        $to_destroy->delete();

        return redirect('/category/'.$param2 .'/' .$param1);
    
    }

    //complete transaction
    public function completeTransaction(Request $request)
    {
       $current_receipt = $request->receipt_no;
       $category_id = '';
       $items = Sale::where([['user_id', auth::user()->id],['receipt_no',$request->receipt_no]])->get();
       $add_item = new Receipt;
       $add_item->receipt_no = $request->receipt_no;
       $add_item->to_pay = $request->to_pay;
       $add_item->tenderd = $request->tenderd;
       $add_item->change = $request->change;
       $add_item->tax = $request->tax;
       $add_item->serving_mode = $request->serving_mode;
       $add_item->mode = $request->mode;
       $delivery_charges = DeliveryCharges::where('receipt_id',$request->receipt_no)->get();
       $add_item->mpesa_ref = '';
       $add_item->status = $request->status;
       $add_item->mpesa_number = $request->mpesa_number;
       $add_item->user_id = auth::user()->id;
       $add_item->save();
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
        $header = $request->receipt_no;
        $toaster = 2;
        $mode = $header; 
        $popup_trigger = 0; 
        $receipt_trigger = 1; 
        $selected = array();
        $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$header]])->orderby('created_at','asc')->get();
        $categories = Category::where('status',1)->get();

        session()->forget('receipt');

        return view('Waiter.categories')->with('categories', $categories)
                        ->with('toaster', $toaster)
                        ->with('selected', $selected)
                        ->with('current_receipt', $current_receipt)
                        ->with('category_id', $category_id)
                        ->with('products', $products)
                        ->with('my_old_orders', $my_old_orders)
                        ->with('my_new_orders', $my_new_orders)
                        ->with('my_processed_orders', $my_processed_orders)
                        ->with('delivery_charges', $delivery_charges)
                        ->with('items', $items)
                        ->with('request', $request)
                        ->with('popup_trigger', $popup_trigger)
                        ->with('receipt_trigger', $receipt_trigger)
                        ->with('mode',$mode)
                        ->with('header', $header);
    }

    //process invoice
    public function processInvoice(Request $request)
    {
        $current_receipt = $request->receipt_no;
        if($current_receipt == '')
        {
            $receipts = Receipt::where([['user_id',auth::user()->id],['status',1]])->get();
            $invoices = Receipt::where([['user_id',auth::user()->id],['status',0]])->get();
            return view('Waiter.dashboard')->with('invoices',$invoices)->with('receipts',$receipts)->with('error','Receipt processed');
        }
        else
        {
        $category_id = '';
        if($request->add_client ==1 || $request->add_client =='')
        {
            $add = new Client;
            $add->firstname = $request->customer_name;
            $add->phone = $request->customer_telephone;
            $add->address = $request->customer_delivery_address;
            $add->save();

            $client = Client::where([['firstname',$request->customer_name],['phone',$request->customer_telephone],['address',$request->customer_delivery_address]])->first();
            $client_id = $client->id;

            $items = Sale::where([['user_id', auth::user()->id],['receipt_no',$request->receipt_no]])->get();
            $add_item = new Receipt;
            $add_item->receipt_no = $request->receipt_no;
            $add_item->to_pay = $request->to_pay;
            $add_item->tenderd = $request->tenderd;
            $add_item->change = $request->change;
            $add_item->tax = $request->tax;
            $add_item->serving_mode = $request->serving_mode;
            $delivery_charges = DeliveryCharges::where('receipt_id',$request->receipt_no)->get();
            $add_item->mode = $request->mode;
            $add_item->client_id = $client_id;
            $add_item->mpesa_ref = '';
            $add_item->mpesa_number = '';
            $add_item->status = $request->status;
            $add_item->user_id = auth::user()->id;
            $add_item->save();

            $header = $request->receipt_no;
            $toaster = 3;
            $mode = $header; 
            $popup_trigger = 0; 
            $receipt_trigger = 1; 
            $selected = array();
            $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$header]])->orderby('created_at','asc')->get();
            $categories = Category::where('status',1)->get();
        }
        else
        {
            $items = Sale::where([['user_id', auth::user()->id],['receipt_no',$request->receipt_no]])->get();
            $add_item = new Receipt;
            $add_item->receipt_no = $request->receipt_no;
            $add_item->to_pay = $request->to_pay;
            $add_item->tenderd = $request->tenderd;
            $add_item->change = $request->change;
            $add_item->tax = $request->tax;
            $add_item->serving_mode = $request->serving_mode;
            $add_item->mode = $request->mode;
            $add_item->client_id = $request->customer_id;
            $delivery_charges = DeliveryCharges::where('receipt_id',$request->receipt_no)->get();
            $add_item->mpesa_ref = '';
            $add_item->mpesa_number = '';
            $add_item->status = $request->status;
            $add_item->user_id = auth::user()->id;
            $add_item->save();
     
             $header = $request->receipt_no;
             $toaster = 3;
             $mode = $header; 
             $popup_trigger = 0; 
             $receipt_trigger = 1; 
             $selected = array();
             $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$header]])->orderby('created_at','asc')->get();
             $categories = Category::where('status',1)->get();
        }
        

        session()->forget('receipt');
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

        return view('Waiter.categories')->with('categories', $categories)
                        ->with('toaster', $toaster)
                        ->with('selected', $selected)
                        ->with('products', $products)
                        ->with('items', $items)
                        ->with('my_old_orders', $my_old_orders)
                        ->with('my_new_orders', $my_new_orders)
                        ->with('my_processed_orders', $my_processed_orders)
                        ->with('request', $request)
                        ->with('current_receipt', $current_receipt)
                        ->with('popup_trigger', $popup_trigger)
                        ->with('receipt_trigger', $receipt_trigger)
                        ->with('delivery_charges', $delivery_charges)
                        ->with('mode',$mode)
                        ->with('category_id',$category_id)
                        ->with('header', $header);
        }
    }

    //process order receipt
    public function processOrderReceipt(Request $request)
    {
       $current_receipt = $request->receipt_no;
       $category_id = '';
       $items = Sale::where([['user_id', auth::user()->id],['receipt_no',$request->receipt_no]])->get();
       $add_item = new Receipt;
       $add_item->receipt_no = $request->receipt_no;
       $add_item->to_pay = $request->to_pay;
       $add_item->tenderd = $request->tenderd;
       $add_item->change = $request->change;
       $add_item->tax = $request->tax;
       $add_item->serving_mode = $request->serving_mode;
       $add_item->mode = $request->mode;
       $add_item->mpesa_ref = '';
       $add_item->mpesa_number = '';
       $add_item->status = $request->status;
       $add_item->user_id = auth::user()->id;
       $add_item->save();

        $header = $request->receipt_no;
        $toaster = 4;
        $mode = $header; 
        $popup_trigger = 0; 
        $receipt_trigger = 1; 
        $selected = array();
        $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$header]])->orderby('created_at','asc')->get();
        $categories = Category::where('status',1)->get();
        $delivery_charges = DeliveryCharges::where('receipt_id',$request->receipt_no)->get();

        session()->forget('receipt');
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


        return view('Waiter.categories')->with('categories', $categories)
                        ->with('toaster', $toaster)
                        ->with('selected', $selected)
                        ->with('delivery_charges', $delivery_charges)
                        ->with('products', $products)
                        ->with('my_old_orders', $my_old_orders)
                        ->with('my_new_orders', $my_new_orders)
                        ->with('my_processed_orders', $my_processed_orders)
                        ->with('items', $items)
                        ->with('request', $request)
                        ->with('current_receipt', $current_receipt)
                        ->with('popup_trigger', $popup_trigger)
                        ->with('category_id',$category_id)
                        ->with('receipt_trigger', $receipt_trigger)
                        ->with('mode',$mode)
                        ->with('header', $header);
    }
    //pay for invoice
    public function payInvoice(Request $request)
    {
       $add_item = Receipt::find($request->receipt_id);
       $add_item->tenderd = $request->tenderd;
       $add_item->change = $request->change;
       $add_item->mpesa_ref = '';
       $add_item->status = $request->status;
       $add_item->mode = $request->mode;
       $add_item->mpesa_number = $request->mpesa_number;
       $add_item->user_id = auth::user()->id;
       $add_item->update();

        return redirect('/receipts-invoices')->with('success', 'Payment Made Successfully');
     
    }

    //Add company details
    public function submitCompanyDetails(Request $request, $id)
    {
         //Get image names with extension.
        if($request->hasFile('logo'))
        {  
            $imageName = $request->file('logo')->getClientOriginalName();
            $imageNameToStore = time().'_'.$imageName;
        }
        else
        {
            $imageName = '';
            $imageNameToStore = $request->old_logo;
        }
        
             //Uploading the image now
            if($request->hasFile('logo'))
            {
                $path1 = $request->file('logo')->storeAs('Documents', $imageNameToStore);
            }
        $add = CompanyDetail::find($request->data_id);
        $add ->name = $request->company_name;
        $add ->branch = $request->branch;
        $add ->address_one = $request->address_one;
        $add ->address_two = $request->address_two;
        $add ->tel_one = $request->tel_one;
        $add ->tel_two = $request->tel_two;
        $add ->pin = $request->pin;
        $add ->email = $request->email;
        $add ->vat = $request->vat;
        $add ->logo = $imageNameToStore;
        $add->update();
        
        return back()->with('updated','Added Successfully');
    }

    //get selling mode
     public function getMode($id)
     {
         if($id == "sit-inn")
         {
             $tables = CustomerTable::all();
             $mode = $id;
             $category_id ='';
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
             return view('Waiter.customer_tables')->with('tables',$tables)
                                                  ->with('my_old_orders', $my_old_orders)
                                                    ->with('my_new_orders', $my_new_orders)
                                                    ->with('my_processed_orders', $my_processed_orders)
                                                  ->with('mode',$mode)->with('category_id',$category_id);
         }
         else
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
            $mode = $id;
            $category_id ='';
            $popup_trigger = 0;
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
            $selected = array();
            $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$current_receipt]])->orderby('created_at','asc')->get();
            $categories = Category::where('status',1)->get();
            return view('Waiter.categories')->with('categories', $categories)
                            ->with('toaster', $toaster)
                            ->with('selected', $selected)
                            ->with('my_old_orders', $my_old_orders)
                            ->with('my_new_orders', $my_new_orders)
                            ->with('my_processed_orders', $my_processed_orders)
                            ->with('category_id', $category_id)
                            ->with('products', $products)
                            ->with('popup_trigger', $popup_trigger)
                            ->with('mode',$mode)
                            ->with('current_receipt', $current_receipt)
                            ->with('header', $header);
    
         }
     }

     //get categories
     public function getCategories($id)
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
        $mode = $id; 
        $category_id = ''; 
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
        $popup_trigger = 0; 
        $selected = array();
        $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$current_receipt]])->orderby('created_at','asc')->get();
        $categories = Category::where('status',1)->get();
        return view('Waiter.categories')->with('categories', $categories)
                        ->with('toaster', $toaster)
                        ->with('selected', $selected)
                        ->with('my_old_orders', $my_old_orders)
                        ->with('my_new_orders', $my_new_orders)
                        ->with('my_processed_orders', $my_processed_orders)
                        ->with('category_id', $category_id)
                        ->with('products', $products)
                        ->with('popup_trigger', $popup_trigger)
                        ->with('mode',$mode)
                        ->with('current_receipt', $current_receipt)
                        ->with('header', $header);

     }

     public function getReceiptsInvoices()
     {
        if(session('success'))
        {
            Alert::success('Success!', 'Payment made Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'Please select more than one Order');
        }
        elseif(session('good'))
        {
            Alert::success('Success!', 'Orders Combined Successfully');
        }
        elseif(session('empty'))
        {
            Alert::error('Error!', 'Bad Invoive Numbers');
        }
         $receipts = Receipt::where([['user_id',auth::user()->id],['status',1]])->get();
         $invoices = Receipt::where([['user_id',auth::user()->id],['status',0]])->get();
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

         return view('Waiter.receipts_invoices')->with('receipts',$receipts)
                                                ->with('my_old_orders', $my_old_orders)
                                                ->with('my_new_orders', $my_new_orders)
                                                ->with('my_processed_orders', $my_processed_orders)
                                                ->with('invoices',$invoices);
     }

     public function viewInvoice($receipt, $id)
     {
         $invoice_data = Sale::where('receipt_no', $receipt)->get();
         $invoice_details = Receipt::find($id);
         $delivery_charges = DeliveryCharges::where('receipt_id',$receipt)->get();
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

         return view('Waiter.view_invoices')->with('invoice_data',$invoice_data)
                                            ->with('invoice_details',$invoice_details)
                                            ->with('my_old_orders', $my_old_orders)
                                            ->with('my_new_orders', $my_new_orders)
                                            ->with('my_processed_orders', $my_processed_orders)
                                            ->with('delivery_charges',$delivery_charges);
     }

     public function viewReceipt($receipt, $id)
     {
         $receipt_data = Sale::where('receipt_no', $receipt)->get();
         $receipt_details = Receipt::find($id);
         $delivery_charges = DeliveryCharges::where('receipt_id',$receipt)->get();
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


         return view('Waiter.view_receipts')->with('receipt_data',$receipt_data)
                                            ->with('receipt_details',$receipt_details)
                                            ->with('my_old_orders', $my_old_orders)
                                            ->with('my_new_orders', $my_new_orders)
                                            ->with('my_processed_orders', $my_processed_orders)
                                            ->with('delivery_charges',$delivery_charges);
     }

     public function viewFlavour($id)
     {
        if(session('success'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
         $category_flavours = CategoryFlavour::where('flavour_id', $id)->get();
         $categories = Category::where('status',1)->get();
         $current_flavour = Flavour::find($id);
         $current_flavour_name =  $current_flavour->name;
         $current_flavour_id =  $current_flavour->id;
         $launcher = 1;
         $categories = Category::where('status',1)->get();
        $uoms = UnitOfMeasure::all();
        $sizes = Size::all();
        $toppings = Toppings::all();
        $flavours = Flavour::all();
        $tables = CustomerTable::all();  

         return view('Admin.settings')->with('category_flavours',$category_flavours )
                                      ->with('categories',$categories)
                                      ->with('launcher',$launcher)
                                     ->with('uoms', $uoms)
                                     ->with('current_flavour_name', $current_flavour_name)
                                     ->with('current_flavour_id', $current_flavour_id)
                                     ->with('toppings', $toppings)
                                     ->with('flavours', $flavours)
                                     ->with('tables', $tables)
                                     ->with('sizes', $sizes);
     }

     public function assignCategoryFlavour(Request $request)
     {
        $data = $request->all();
        if(count($request->category) > 0)
        {
            foreach($request->category as $entry=>$v)
            {
                $info=array(
                    'flavour_id'=>$request->flavour_id,
                    'category_id'=>$request->category[$entry],
                    );
                CategoryFlavour::insert($info);
            }
        }
        return redirect()->back()->with('success','Data Saved Successfully');
     }

     public function updateCategoryFlavour(Request $request, $id)
     {
        if(count($request->category) > 0)
        {
            $check = CategoryFlavour::where('flavour_id',$request->flavour_id)->delete();
            foreach($request->category as $entry=>$v)
            {
                $info=array(
                    'flavour_id'=>$request->flavour_id,
                    'category_id'=>$request->category[$entry],
                    );
                CategoryFlavour::insert($info); 
            }
        }
        $launcher = 0;
        return back()->with('success','Data Saved Successfully')->with('launcher',$launcher);
     }

     public function recentOrders()
     {
         return view('Admin.realtime_orders');
     }

     public function pos()
     {
        if(session('error'))
        {
            Alert::error('Expired Receipt Number!', 'You might have submitted this receipt,please process another one');
        }
        $today = date("Y-m-d");
        $receipts = Receipt::where([['user_id',auth::user()->id],['status',1]])->get();
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
        $secret_key = SecretKey::where([['user_id', auth::user()->id],['date', $today]])->first();
        $invoices = Receipt::where([['user_id',auth::user()->id],['status',0]])->get();
         return view('Waiter.dashboard')->with('invoices',$invoices)
                                         ->with('receipts',$receipts)
                                         ->with('my_old_orders', $my_old_orders)
                                            ->with('my_new_orders', $my_new_orders)
                                         ->with('my_processed_orders',$my_processed_orders)
                                        ->with('secret_key',$secret_key);
     }

     public function getInvoices()
     {
        if(session('deleted'))
        {
            Alert::success('Success!', 'Bill Recalled Successfully');
        }

         $invoices = Receipt::where('status',1)->orderBy('created_at','DESC')->get();

         return view('Admin.invoices')->with('invoices',$invoices);
     }

     public function getReceipts()
     {
        if(session('success'))
        {
            Alert::success('Success!', 'Payment made Successfully');
        }

         $receipts = Receipt::where('status',0)->orderBy('created_at','DESC')->get();

         return view('Admin.receipts')->with('receipts',$receipts);
     }

     public function receiveStock()
     {
        if(session('success'))
        {
            Alert::success('Success!', 'Stock Received Successfully');
        }

         $stocks = Inventory::all();

         return view('Admin.receive_stock')->with('stocks',$stocks);
     }

     public function sendWhatsapp(Request $request)
     {
        $phone = $request->whatsapp_number;
        $message = $request->whatsapp_message;
        $source = 'The Boozy Bunch';
        $url = 'https://api.whatsapp.com/send?phone='.$phone.'&text='.$message.'&source='.$source.'&data=&app_absent=';

        return redirect($url);
     }

     public function getClients()
     {
        if(session('success'))
        {
            Alert::success('Success!', 'Added Successfully');
        }
        if(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        if(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }


         $clients = Client::all();

         return view('Admin.clients')->with('clients',$clients);
     }

     public function addClient(Request $request)
     {
         $add = new Client;
         $add->firstname = $request->firstname;
         $add->lastname = $request->lastname;
         $add->phone = $request->phone;
         $add->address = $request->address;
         $add->email = $request->email;
         $add->region = $request->region;
         $add->save();

         return back()->with('success', 'Saved Successfully');
     }

     public function updateClient(Request $request, $id)
     {
         $add = Client::find($request->client_id);
         $add->firstname = $request->firstname;
         $add->lastname = $request->lastname;
         $add->phone = $request->phone;
         $add->address = $request->address;
         $add->email = $request->email;
         $add->region = $request->region;
         $add->update();

         return back()->with('updated', 'Updated Successfully');
     }


    //destroy client
    public function destroyClient(Request $request, $id)
    {
        $to_destroy = Client::find($request->client_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }

    public function getSuppliers()
     {
        if(session('success'))
        {
            Alert::success('Success!', 'Added Successfully');
        }
        if(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        if(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }


         $suppliers = Supplier::all();

         return view('Admin.suppliers')->with('suppliers',$suppliers);
     }

     public function addSupplier(Request $request)
     {
         $add = new Supplier;
         $add->companyname = $request->companyname;
         $add->phone = $request->phone;
         $add->address = $request->address;
         $add->email = $request->email;
         $add->products = $request->product;
         $add->pin = $request->pin;
         $add->save();

         return back()->with('success', 'Saved Successfully');
     }

     public function updateSupplier(Request $request, $id)
     {
         $add = Supplier::find($request->supplier_id);
         $add->companyname = $request->companyname;
         $add->phone = $request->phone;
         $add->address = $request->address;
         $add->email = $request->email;
         $add->products = $request->product;
         $add->pin = $request->pin;
         $add->update();

         return back()->with('updated', 'Updated Successfully');
     }


    //destroy supplier
    public function destroySupplier(Request $request, $id)
    {
        $to_destroy = Supplier::find($request->supplier_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }

    //receive stock
    public function updateStock(Request $request, $id)
    {
        $add_history = new ProductHistory;
        $add_history->product_id = $request->stock_id;
        $add_history->user_id = auth::user()->id;
        $add_history->credit = $request->quantity;
        $add_history->new_stock = $request->quantity + $request->instock;
        $add_history->regular_price = $request->regular_price;
        $add_history->price_level_2 = $request->price_level_2;
        $add_history->cost_price = $request->cost_price;
        $add_history->save();

        $update_inventory = Inventory::find($request->stock_id);
        $update_inventory->instock = $request->quantity + $request->instock;
        $update_inventory->regular_price = $request->regular_price;
        $update_inventory->price_level2 = $request->price_level_2;
        $update_inventory->cost = $request->cost_price;
        $update_inventory->update();

        return back()->with('success','Stock received Successfully');
        
    }

    public function productHistory($id)
    {
        $historys = productHistory::where('product_id', $id)->get();
        $product = Inventory::find($id);
        return view('Admin.product_history')->with('historys',$historys)->with('product', $product);
    }

    public function getUsers()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Saved Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'Email already in use');
        }
        elseif(session('no'))
        {
            Alert::error('Error!', 'You can not Delete your Account');
        }
        elseif(session('updated'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
        elseif(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        $users = User::latest('created_at')->get();
        return view('Admin.users')->with('users', $users);
    }

    public function addUser(Request $request)
    {
        $add = new User;
        $add->name = $request->username;
        $add->phone = $request->phone;
        $add->email = $request->email;
        if($request->checker == 1)
        {
            $number = 1;
            $level = $request->level.'_'.$number;
            $station = $request->level;
        }
        else
        {
            $level = $request->level;
            $station = 0;
        }
        $add->level_id = $level;
        $add->station_id = $station;
        $password = $request->input('password');
        $add->password = Hash::make($password);
        $email_check = User::where('email', $request->email)->get();
        if(count($email_check) > 0)
        {
            return back()->with('error', 'Email in Use');
        }
        else
        {
            $add->save();
            return back()->with('success', 'User Added Successfully');
            
        }
    }

    public function updateUser(Request $request, $id)
    {
        $add = User::find($request->user_id);
        $add->name = $request->username;
        $add->phone = $request->phone;
        $add->email = $request->email;
        $add->level_id = $request->level;
        $add->update();

        return back()->with('updated', 'Updated Successfully');
    }


   //destroy supplier
    public function destroyUser(Request $request, $id)
    {
        $to_destroy = User::find($request->user_id);
        if($request->user_id == auth::user()->id)
        {
           return back()->with('no','You can not delete yourself');
        }
       else
       {
           $to_destroy->delete();
           return back()->with('deleted','User Deleted Successfully');   
       }
      
    }

    public function getCategoryProducts($id)
    {
        if($id == 1)
        {
            $products = Inventory::all();
            $category_name = 'All Products';
            return view('Admin.category_products')->with('products',$products)->with('category_name',$category_name);
        }
        $products = Inventory::where('category_id', $id)->get();
        $category = Category::find($id);
        $category_name = $category->name;
        return view('Admin.category_products')->with('products',$products)->with('category_name',$category_name);
    }

    public function dateRangePicker()
    {
        return view('Admin.reports');
    }
   
    public function deliveryRoutes()
    {
        $d_routes = DeliveryRoute::all();
        return view('Admin.delivery_routes')->with('d_routes',$d_routes);
    }

    public function addDeliveryRoute(Request $request)
     {
         $add = new DeliveryRoute;
         $add->name = $request->routename;
         $add->charges = $request->charges;
         $add->save();

         return back()->with('success', 'Saved Successfully');
     }

     public function updateDeliveryRoute(Request $request, $id)
     {
         $add = DeliveryRoute::find($request->delivery_id);
         $add->name = $request->routename;
         $add->charges = $request->charges;
         $add->update();

         return back()->with('updated', 'Updated Successfully');
     }


    //destroy client
    public function destroyDeliveryRoute(Request $request, $id)
    {
        $to_destroy = DeliveryRoute::find($request->delivery_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }

    public function addDeliveryCharges(Request $request)
     {
         $check_receipt = DeliveryCharges::where('receipt_id',$request->receipt_id)->get();
         $param1 = $request->serving_mode;
         $param2 = $request->category_id;
         if(count($check_receipt) > 0)
         {
             return redirect('/category/'.$param2 .'/' .$param1)->with('error4','Delivery assigned');
         }
         else
         {
            if($request->add_route ==1 || $request->add_route == '')
            {
                $add = new DeliveryRoute;
                $add->name = $request->routename;
                $add->charges = $request->charges;
                $add->save(); 

                $get_route = DeliveryRoute::latest()->first();
                $route_id = $get_route->id;

                $new = new DeliveryCharges;
                $new->receipt_id= $request->receipt_id;
                $new->route_id= $route_id;
                $new->charges = $request->charges;
                $new->user_id = auth::user()->id;
                $new->save();

                return redirect('/category/'.$param2 .'/' .$param1);
            }
            else
            {
                $add = new DeliveryCharges;
                $add->receipt_id= $request->receipt_id;
                $add->route_id= $request->route_id;
                $add->charges = $request->charges;
                $add->user_id = auth::user()->id;
                $add->save();

                return redirect('/category/'.$param2 .'/' .$param1);
            }
         } 
     }

     public function changeStatus($id)
     {
            if(auth::user()->station_id == 21)
            {
                if(session('error'))
                {
                    Alert::error('Error!', 'Unknown Secret Key');
                }
                    if($id == 1)
                    {
                        $header = 'INCOMING ORDERS';
                        $toaster = $id;
                    }
                    elseif($id == 2)
                    {
                        $header = 'PROCESSED ORDERS';
                        $toaster = $id;
                    }
                    elseif($id == 3)
                    {
                        $header = 'WAITING ORDERS';
                        $toaster = $id;
                    }
                    elseif($id == 4)
                    {
                        $header = 'COLLECTED ORDERS';
                        $toaster = $id;
                    }
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
                return redirect()->back()->with('category', $category)->with('orders', $orders)
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
                if($id == 1)
                {
                    $header = 'INCOMING ORDERS';
                    $toaster = $id;
                }
                elseif($id == 2)
                {
                    $header = 'PROCESSED ORDERS';
                    $toaster = $id;
                }
                elseif($id == 3)
                {
                    $header = 'WAITING ORDERS';
                    $toaster = $id;
                }
                elseif($id == 4)
                {
                    $header = 'COLLECTED ORDERS';
                    $toaster = $id;
                }
                $orders = Sale::where([['category_id', auth::user()->station_id],['status',0]])->get();
                $current_orders = count($orders);
                    if(session()->has('old_orders'))
                    {
                        $old_orders = session()->get('old_orders'); 
                        $new_orders = count($orders);
                        session(['old_orders' => $current_orders]); 
                    } 
                    else
                    {
                        session(['old_orders' => $current_orders]); 
                        $old_orders = session()->get('old_orders'); 
                        $new_orders = count($orders);
                    } 
                $category = Category::find(auth::user()->station_id);
                $orders = Sale::where([['category_id', auth::user()->station_id],['status',0]])->get();
                $processed_orders = Sale::where([['category_id', auth::user()->station_id],['status',1]])->get();
                $waiting_orders = Sale::where([['category_id', auth::user()->station_id],['status',2]])->get();
                $collected = Sale::where([['category_id', auth::user()->station_id],['status',3]])->get();
                return redirect()->back()->with('category', $category)
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

     public function saveSecret(Request $request)
     {
         $today = date("Y-m-d");
         $secret = new SecretKey;
         $secret->secret_key = $request->secret_key;
         $secret_key = SecretKey::where([['user_id', auth::user()->id],['date', $today]])->get();
         $secret->user_id = auth::user()->id;
         $secret->date = date("Y-m-d");
         $secret->save();

         return redirect('home');
     }

     public function confirmSecret(Request $request)
     {
        $check_key = SecretKey::where('secret_key', $request->secret_key)->first();
        if($check_key != '')
        {
            if(auth::user()->station_id == 21)
            {
                $header = 'COLLECT ORDERS';
                $waiter = User::find($check_key->user_id);
                $toaster = 5;
                $category = Category::find(auth::user()->station_id);
                $orders = Sale::where([['category_id', auth::user()->station_id],['status',0]])->orWhere([['category_id', 17],['status',0]])
                                                                                                ->orWhere([['category_id', 29],['status',0]])->get();
                $myorders = Sale::where([['category_id', auth::user()->station_id],['status',1],['user_id',$check_key->user_id]])
                              ->orWhere([['category_id', 17],['status',1],['user_id',$check_key->user_id]])
                              ->orWhere([['category_id', 29],['status',1],['user_id',$check_key->user_id]])->get();
                $processed_orders = Sale::where([['category_id', auth::user()->station_id],['status',1]])->orWhere([['category_id', 17],['status',1]])
                                                                                                         ->orWhere([['category_id', 29],['status',1]])->get();
                $waiting_orders = Sale::where([['category_id', auth::user()->station_id],['status',2]])->orWhere([['category_id', 17],['status',2]])
                                                                                                        ->orWhere([['category_id', 29],['status',2]])->get();
                $collected = Sale::where([['category_id', auth::user()->station_id],['status',3]])->orWhere([['category_id', 17],['status',3]])
                                                                                                  ->orWhere([['category_id', 29],['status',3]])->get();
                $current_orders = count($orders);
                    if(session()->has('old_orders'))
                    {
                        $old_orders = session()->get('old_orders'); 
                        $new_orders = count($orders);
                        session(['old_orders' => $current_orders]); 
                    } 
                    else
                    {
                        session(['old_orders' => $current_orders]); 
                        $old_orders = session()->get('old_orders'); 
                        $new_orders = count($orders);
                    } 
                    return view('Station.dashboard')->with('category', $category)
                                                ->with('orders', $orders)
                                                ->with('toaster', $toaster)
                                                ->with('myorders', $myorders)
                                                ->with('old_orders', $old_orders)
                                                ->with('new_orders', $new_orders)
                                                ->with('header', $header)
                                                ->with('waiter', $waiter)
                                                ->with('collected', $collected)
                                                ->with('waiting_orders', $waiting_orders)
                                                ->with('processed_orders', $processed_orders);
            }
            else
            {
            $header = 'COLLECT ORDERS';
            $waiter = User::find($check_key->user_id);
            $toaster = 5;
            $category = Category::find(auth::user()->station_id);
            $orders = Sale::where([['category_id', auth::user()->station_id],['status',0]])->get();
            $processed_orders = Sale::where([['category_id', auth::user()->station_id],['status',1]])->get();
            $myorders = Sale::where([['category_id', auth::user()->station_id],['status',1],['user_id',$check_key->user_id]])->get();
            $waiting_orders = Sale::where([['category_id', auth::user()->station_id],['status',2]])->get();
            $collected = Sale::where([['category_id', auth::user()->station_id],['status',3]])->get();
            $orders = Sale::where([['category_id', auth::user()->station_id],['status',0]])->get();
            $current_orders = count($orders);
                if(session()->has('old_orders'))
                {
                    $old_orders = session()->get('old_orders'); 
                    $new_orders = count($orders);
                    session(['old_orders' => $current_orders]); 
                } 
                else
                {
                    session(['old_orders' => $current_orders]); 
                    $old_orders = session()->get('old_orders'); 
                    $new_orders = count($orders);
                } 
            return view('Station.dashboard')->with('category', $category)
                                            ->with('orders', $orders)
                                            ->with('toaster', $toaster)
                                            ->with('myorders', $myorders)
                                            ->with('old_orders', $old_orders)
                                            ->with('new_orders', $new_orders)
                                            ->with('header', $header)
                                            ->with('waiter', $waiter)
                                            ->with('collected', $collected)
                                            ->with('waiting_orders', $waiting_orders)
                                            ->with('processed_orders', $processed_orders);
            }
        }
        else
        {
            return redirect('home')->with('error', 'Unknown Secret Key');
        }
     }

     public function adminStation()
     {
        $today = date("Y-m-d");
        $header = 'INCOMING ORDERS';
        $toaster = 0;
        $category = '';
        $orders = Sale::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',0]])->get();
        $processed_orders = Sale::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',1]])->get();
        $waiting_orders = Sale::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',2]])->get();
        $collected = Sale::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',3]])->get();
        return view('Station.admin_dashboard')->with('category', $category)
                                        ->with('orders', $orders)
                                        ->with('toaster', $toaster)
                                        ->with('header', $header)
                                        ->with('collected', $collected)
                                        ->with('waiting_orders', $waiting_orders)
                                        ->with('processed_orders', $processed_orders);
     }

     public function adminchangeStatus($id)
     {
        
         if($id == 1)
         {
            $header = 'INCOMING ORDERS';
            $toaster = $id;
         }
         elseif($id == 2)
         {
            $header = 'PROCESSED ORDERS';
            $toaster = $id;
        }
         elseif($id == 3)
         {
            $header = 'WAITING ORDERS';
            $toaster = $id;
         }
         elseif($id == 4)
         {
            $header = 'COLLECTED ORDERS';
            $toaster = $id;
         }
            $category = '';
            $orders = Sale::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',0]])->get();
            $processed_orders = Sale::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',1]])->get();
            $waiting_orders = Sale::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',2]])->get();
            $collected = Sale::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',3]])->get();
            return view('Station.admin_dashboard')->with('category', $category)
                                            ->with('orders', $orders)
                                            ->with('toaster', $toaster)
                                            ->with('header', $header)
                                            ->with('collected', $collected)
                                            ->with('waiting_orders', $waiting_orders)
                                            ->with('processed_orders', $processed_orders);
     }

     public function readyOrders()
     {
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
        return view('Waiter.ready_orders')->with('my_processed_orders', $my_processed_orders)
                                         ->with('my_old_orders', $my_old_orders)
                                         ->with('my_new_orders', $my_new_orders);
     }

     public function test()
    {
        // Set params
        $mid = '123123456';
        $store_name = 'YOURMART';
        $store_address = 'Mart Address';
        $store_phone = '1234567890';
        $store_email = 'yourmart@email.com';
        $store_website = 'yourmart.com';
        $tax_percentage = 10;
        $transaction_id = 'TX123ABC456';

        // Set items
        $items = [
            [
                'name' => 'French Fries (tera)',
                'qty' => 2,
                'price' => 65000,
            ],
            [
                'name' => 'Roasted Milk Tea (large)',
                'qty' => 1,
                'price' => 24000,
            ],
            [
                'name' => 'Honey Lime (large)',
                'qty' => 3,
                'price' => 10000,
            ],
            [
                'name' => 'Jasmine Tea (grande)',
                'qty' => 3,
                'price' => 8000,
            ],
        ];

        // Init printer
        $printer = new ReceiptPrinter;
        $printer->init(
            config('receiptprinter.connector_type'),
            config('receiptprinter.connector_descriptor')
        );

        // Set store info
        $printer->setStore($mid, $store_name, $store_address, $store_phone, $store_email, $store_website);

        // Add items
        foreach ($items as $item) {
            $printer->addItem(
                $item['name'],
                $item['qty'],
                $item['price']
            );
        }
        // Set tax
        $printer->setTax($tax_percentage);

        // Calculate total
        $printer->calculateSubTotal();
        $printer->calculateGrandTotal();

        // Set transaction ID
        $printer->setTransactionID($transaction_id);

        // Set qr code
        $printer->setQRcode([
            'tid' => $transaction_id,
        ]);

        // Print receipt
        $printer->printReceipt();
        
    }

    public function combineReceipt(Request $request)
    {
        $total = 0;
        if(count($request->to_combine) > 1)
        {
            foreach($request->to_combine as $entry=>$v)
            {
                $info=array(
                    'combined_receipt_number'=>$request->to_combine[$entry],
                    'amount'=>$request->to_combine_amount[$entry],
                    'new_receipt_no'=>$request->combined_receipt_number,
                    'user_id'=>auth::user()->id,
                    'status'=>0,
                    );
                CombinedReceipt::insert($info);
                $total += $request->to_combine_amount[$entry];
                $change = Sale::where('receipt_no',$request->to_combine[$entry])->first(); 
                if($change != '') 
                {
                    $change->status = 6;
                    $change->receipt_no = $request->combined_receipt_number;
                    $change->update();

                    $change_2 = Receipt::where('receipt_no',$request->to_combine[$entry])->first();
                    $change_2->status = 6;
                    $change_2->receipt_no = $request->combined_receipt_number;
                    $change_2->update();
                }
                else
                {
                    return back()->with('empty','Empty');
                }
                
            }
        $new_receipt = new CombinedOrder;
        $new_receipt->new_receipt_no = $request->combined_receipt_number;
        $new_receipt->status = 0;
        $new_receipt->amount = $total;
        $new_receipt->user_id = auth::user()->id;
        $new_receipt->save();

        return redirect()->back()->with('good','Data Saved Successfully'); 
        }
        else
        {
            return redirect()->back()->with('error','Please select more than one invoice');  
        }
    }

    //show password change form.
    public function getPasswordForm()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Password Changed Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error', 'Wrong Current Password');
        }
        elseif(session('mismatch'))
        {
            Alert::error('Error!', 'Confirmation password does not match with New Password');
        }
        elseif(session('match'))
        {
            Alert::error('Error!', 'New password can not be same as Old Password');
        }
        $my_processed_orders = array();
        $my_old_orders = 0;
        $my_new_orders = 0;
        return view('Waiter.change_password_form')->with('my_processed_orders',$my_processed_orders)
                                                   ->with('my_old_orders',$my_old_orders)
                                                   ->with('my_new_orders',$my_new_orders);
    }

    public function changePassword(Request $request)
    { 
        if(!(Hash::check($request->get('current_password'), Auth::user()->password)))
        { 
            $message = 'wrong current password';
            return back()->with('error', $message);
        }

        if(strcmp($request->get('password'), $request->get('current_password'))==0 )
        { 
            $message = 'New password can not be same as Old Password';
            return back()->with('match', $message);
        }

       if(strcmp($request->get('password'), $request->get('password_confirmation'))==0 )
        { 
            $user = Auth::user();
            $password = $request->get('password');
            $user->password = Hash::make($password);
            $user->update();
             
            $message = 'Password Changed Successfully';
            return back()->with('success', $message);
            
        }
        else
        {
            $message = 'Confirmation password does not match New Password';
            return back()->with('mismatch', $message);
        }
    }

    public function dailySales()
    {
        $total_receipts = 0;
        $total_mpesa = 0;
        $total_cash = 0;
        $total_invoice = 0;
        $total_expenses = 0;
        $today = date("Y-m-d");
        $receipts = Receipt::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',1]])->get();
            foreach($receipts as $receipt)
            {
                $total_receipts += $receipt->to_pay;
            }
        $mpesas = Receipt::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',1],['mode','M-PESA']])->get();
            foreach($mpesas as $mpesa)
            {
                $total_mpesa += $mpesa->to_pay;
            }
        $cashs = Receipt::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',1],['mode','CASH']])->get();
            foreach($cashs as $cash)
            {
                $total_cash += $cash->to_pay;
            }
        $invoices = Receipt::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',0]])->get();
            foreach($invoices as $invoice)
            {
                $total_invoice += $invoice->to_pay;
            }
        $expenses = Expense::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',1]])->get();
            foreach($expenses as $expense)
            {
                $total_expenses += $expense->amount;
            }
        $waiters = WaiterReport::where('created_at', '>=', date('Y-m-d').' 00:00:00')->get();
        $items = Report::where('created_at', '>=', date('Y-m-d').' 00:00:00')->orderBy('product_id','asc')->get();
        return view('Cashier.daily_sales')->with('receipts',$receipts)
                                          ->with('waiters',$waiters)
                                          ->with('items',$items)
                                          ->with('total_invoice',$total_invoice)
                                          ->with('total_cash',$total_cash)
                                          ->with('total_mpesa',$total_mpesa)
                                          ->with('cashs',$cashs)
                                          ->with('mpesas',$mpesas)
                                          ->with('expenses',$expenses)
                                          ->with('total_expenses',$total_expenses)
                                          ->with('total_receipts',$total_receipts)
                                          ->with('invoices',$invoices);
    }

    public function waiterDailySales($id)
    {
        $waiter_daily_sales = WaiterItemizedReport::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['user_id',$id ]])->get();
        $waiter_details = User::find($id);
        $total_receipts = 0;
        $total_mpesa = 0;
        $total_cash = 0;
        $total_invoice = 0;
        $today = date("Y-m-d");
        $receipts = Receipt::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',1],['user_id',$id]])->get();
            foreach($receipts as $receipt)
            {
                $total_receipts += $receipt->to_pay;
            }
        $mpesas = Receipt::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',1],['mode','M-PESA'],['user_id',$id]])->get();
            foreach($mpesas as $mpesa)
            {
                $total_mpesa += $mpesa->to_pay;
            }
        $cashs = Receipt::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',1],['mode','CASH'],['user_id',$id]])->get();
            foreach($cashs as $cash)
            {
                $total_cash += $cash->to_pay;
            }
        $invoices = Receipt::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['status',0],['user_id',$id]])->get();
            foreach($invoices as $invoice)
            {
                $total_invoice += $invoice->to_pay;
            }
        $daily_single_sales = Sale::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['user_id',$id]])->get();
        return view('Cashier.waiter_daily_sales')->with('receipts',$receipts)
                                          ->with('waiter_details',$waiter_details)
                                          ->with('daily_single_sales',$daily_single_sales)
                                          ->with('total_invoice',$total_invoice)
                                          ->with('total_cash',$total_cash)
                                          ->with('total_mpesa',$total_mpesa)
                                          ->with('cashs',$cashs)
                                          ->with('mpesas',$mpesas)
                                          ->with('total_receipts',$total_receipts)
                                          ->with('invoices',$invoices);
    }

    public function productDailySales($id)
    {
        $total_product_sales = 0;
        $product_details = Inventory::find($id);
        $product_sales = Sale::where([['created_at', '>=', date('Y-m-d').' 00:00:00'],['product_id',$id]])->get();
            foreach($product_sales as $product_sale)
            {
                $total_product_sales += $product_sale->line_total;
            }
        return view('Cashier.product_dailysales_history')->with('product_sales',$product_sales)
                                                 ->with('total_product_sales',$total_product_sales)
                                                 ->with('product_details', $product_details);
    }
    public function getRegister()
    {
        $entries = SecretKey::where('created_at', '>=', date('Y-m-d').' 00:00:00')->get();
         return view('Admin.register')->with('entries', $entries);
    }
    
    public function getCategoryDetails($id)
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Saved Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'Flavour Already Added to this category');
        }
        elseif(session('error2'))
        {
            Alert::error('Error!', 'Size Already Added to this category');
        }
        if(session('deleted'))
        {
            Alert::success('Deleted!', 'Deleted Successfully');
        }
        $flavours = CategoryFlavour::where('category_id',$id)->get();
        $all_flavours = Flavour::all();
        $sizes = CategorySize::where('category_id',$id)->get();
        $all_sizes = Size::all();
        $category = Category::find($id);

        return view('Admin.category_details')->with('flavours', $flavours)
                                             ->with('category', $category)
                                             ->with('all_flavours', $all_flavours)
                                             ->with('all_sizes', $all_sizes)
                                             ->with('sizes', $sizes);

    }

    public function addCategoryFlavour(Request $request,$id)
    {
        $checker = CategoryFlavour::where([['category_id',$request->category_id],['flavour_id',$request->flavour_id]])->get();
        if(count($checker) > 0)
        {
            return back()->with('error','Flavour already added');
        }
        else
        {
        $to_add = new CategoryFlavour;
        $to_add->category_id = $request->category_id;
        $to_add->flavour_id = $request->flavour_id;
        $to_add->save();

        return back();
        }
    }

    public function addCategorySize(Request $request,$id)
    {
        $checker = CategorySize::where([['category_id',$request->category_id],['size_id',$request->size_id]])->get();
        if(count($checker) > 0)
        {
            return back()->with('error2','Size already added for this category');
        }
        else
        {
        $to_add = new CategorySize;
        $to_add->category_id = $request->category_id;
        $to_add->size_id = $request->size_id;
        $to_add->save();

        return back()->with('success','Success');
        }
    }

    //destroy category flavour
    public function destroyCategoryFlavour(Request $request, $id)
    {
        $to_destroy = CategoryFlavour::find($request->category_flavour_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }
    //destroy categorysize
    public function destroyCategorySize(Request $request, $id)
    {
        $to_destroy = CategorySize::find($request->category_size_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }
        public function dailySalesByDate(Request $request, $id)
    {
        $total_receipts = 0;
        $total_mpesa = 0;
        $total_cash = 0;
        $total_invoice = 0;
        $total_expenses = 0;
        $date = $id;
        $receipts = Receipt::where([['created_at', '>=', $date.' 00:00:00'],['status',1]])->get();
            foreach($receipts as $receipt)
            {
                $total_receipts += $receipt->to_pay;
            }
        $mpesas = Receipt::where([['created_at', '>=', $date.' 00:00:00'],['status',1],['mode','M-PESA']])->get();
            foreach($mpesas as $mpesa)
            {
                $total_mpesa += $mpesa->to_pay;
            }
        $cashs = Receipt::where([['created_at', '>=', $date.' 00:00:00'],['status',1],['mode','CASH']])->get();
            foreach($cashs as $cash)
            {
                $total_cash += $cash->to_pay;
            }
        $invoices = Receipt::where([['created_at', '>=', $date.' 00:00:00'],['status',0]])->get();
            foreach($invoices as $invoice)
            {
                $total_invoice += $invoice->to_pay;
            }
            $expenses = Expense::where([['created_at', '>=', $date.' 00:00:00'],['status',1]])->get();
        foreach($expenses as $expense)
        {
            $total_expenses += $expense->amount;
        }
        $waiters = WaiterReport::where('created_at', '>=', $date.' 00:00:00')->get();
        $items = Report::where('created_at', '>=', $date.' 00:00:00')->orderBy('category_id','desc')->get();
        return view('Admin.daily_sales')->with('receipts',$receipts)
                                          ->with('waiters',$waiters)
                                          ->with('items',$items)
                                          ->with('total_invoice',$total_invoice)
                                          ->with('total_cash',$total_cash)
                                          ->with('total_mpesa',$total_mpesa)
                                          ->with('cashs',$cashs)
                                          ->with('mpesas',$mpesas)
                                          ->with('date',$date)
                                          ->with('expenses',$expenses)
                                          ->with('total_expenses',$total_expenses)
                                          ->with('total_receipts',$total_receipts)
                                          ->with('invoices',$invoices);

    }
          public function closeOfDay(Request $request, $id)
    {
        $total_receipts = 0;
        $total_mpesa = 0;
        $total_cash = 0;
        $total_invoice = 0;
        $total_expenses = 0;
        $date = $id;
        $voids = Voids::where('created_at', '>=', $date.' 00:00:00')->get();
        $receipts = Receipt::where([['created_at', '>=', $date.' 00:00:00'],['status',1]])->get();
            foreach($receipts as $receipt)
            {
                $total_receipts += $receipt->to_pay;
            }
        $mpesas = Receipt::where([['created_at', '>=', $date.' 00:00:00'],['status',1],['mode','M-PESA']])->get();
            foreach($mpesas as $mpesa)
            {
                $total_mpesa += $mpesa->to_pay;
            }
        $cashs = Receipt::where([['created_at', '>=', $date.' 00:00:00'],['status',1],['mode','CASH']])->get();
            foreach($cashs as $cash)
            {
                $total_cash += $cash->to_pay;
            }
        $invoices = Receipt::where([['created_at', '>=', $date.' 00:00:00'],['status',0]])->get();
            foreach($invoices as $invoice)
            {
                $total_invoice += $invoice->to_pay;
            }
        $expenses = Expense::where([['created_at', '>=', $date.' 00:00:00'],['status',1]])->get();
        foreach($expenses as $expense)
        {
            $total_expenses += $expense->amount;
        }
    $waiters = WaiterReport::where('created_at', '>=', $date.' 00:00:00')->get();
    $inventories = Inventory::all();
        $items = Report::where('created_at', '>=', $date.' 00:00:00')->orderBy('category_id','desc')->get();
        return view('Admin.close_of_day')->with('receipts',$receipts)
                                          ->with('waiters',$waiters)
                                          ->with('items',$items)
                                          ->with('total_invoice',$total_invoice)
                                          ->with('total_cash',$total_cash)
                                          ->with('total_mpesa',$total_mpesa)
                                          ->with('cashs',$cashs)
                                          ->with('voids',$voids)
                                          ->with('inventories',$inventories)
                                          ->with('mpesas',$mpesas)
                                          ->with('expenses',$expenses)
                                          ->with('total_expenses',$total_expenses)
                                          ->with('date',$date)
                                          ->with('total_receipts',$total_receipts)
                                          ->with('invoices',$invoices);

    }
    public function filterByDate(Request $request)
    {
        $total_receipts = 0;
        $total_mpesa = 0;
        $total_cash = 0;
        $total_invoice = 0;
        $total_expenses = 0;
        $date = $request->date;
        $receipts = Receipt::where([[DB::raw('date(created_at)'), $date],['status',1]])->get();
            foreach($receipts as $receipt)
            {
                $total_receipts += $receipt->to_pay;
            }
        $mpesas = Receipt::where([[DB::raw('date(created_at)'), $date],['status',1],['mode','M-PESA']])->get();
            foreach($mpesas as $mpesa)
            {
                $total_mpesa += $mpesa->to_pay;
            }
        $cashs = Receipt::where([[DB::raw('date(created_at)'), $date],['status',1],['mode','CASH']])->get();
            foreach($cashs as $cash)
            {
                $total_cash += $cash->to_pay;
            }
        $invoices = Receipt::where([[DB::raw('date(created_at)'), $date],['status',0]])->get();
            foreach($invoices as $invoice)
            {
                $total_invoice += $invoice->to_pay;
            }
        $expenses = Expense::where([[DB::raw('date(created_at)'), $date],['status',1]])->get();
        foreach($expenses as $expense)
        {
            $total_expenses += $expense->amount;
        }

        $waiters = WaiterReport::where(DB::raw('date(created_at)'), $date)->get();
        $items = Report::where(DB::raw('date(created_at)'), $date)->orderBy('category_id','desc')->get();
        return view('Admin.daily_sales')->with('receipts',$receipts)
                                          ->with('waiters',$waiters)
                                          ->with('items',$items)
                                          ->with('total_invoice',$total_invoice)
                                          ->with('total_cash',$total_cash)
                                          ->with('total_mpesa',$total_mpesa)
                                          ->with('cashs',$cashs)
                                          ->with('mpesas',$mpesas)
                                          ->with('expenses',$expenses)
                                          ->with('total_expenses',$total_expenses)
                                          ->with('date',$date)
                                          ->with('total_receipts',$total_receipts)
                                          ->with('invoices',$invoices);

    }
    
    //recall a transaction
    public function recallBill(Request $request, $id)
    {
        $product_to_update = Sale::where('receipt_no',$request->receipt_no)->get();
        foreach($product_to_update as $entry)
        {
            $that_date = $entry->created_at;
            $array = explode(' ', $that_date);
            $actual_date = $array[0];
            $one = 1;
            Inventory::find($entry->product_id)->increment('instock', $entry->quantity);

            Report::where([['product_id',$entry->product_id],['date',$actual_date]])->decrement('quantity', $entry->quantity);
            Report::where([['product_id',$entry->product_id],['date',$actual_date]])->decrement('count',$one);
            Report::where([['product_id',$entry->product_id],['date',$actual_date]])->decrement('amount',$entry->line_total);

            WaiterReport::where([['date',$actual_date],['user_id',$entry->user_id]])->decrement('total', $entry->line_total);
            
            $voids = new Voids;
            $voids->product_id = $entry->product_id;
            $voids->receipt_no = $entry->receipt_no;
            $voids->quantity = $entry->quantity;
            $voids->user_id = $entry->user_id;
            $voids->line_total = $entry->line_total;
            $voids->toppings = $entry->toppings;
            $voids->recall_id = auth::user()->id;
            $voids->category_id = $entry->category_id;
            $voids->status = $entry->status;
            $voids->mode = $entry->mode;
            $voids->order_time = $entry->created_at;
            $voids->save();
            
        }
         
        $receipt_to_destroy = Receipt::where('receipt_no',$request->receipt_no);
        $receipt_to_destroy->delete();

        $product_to_destroy = Sale::where('receipt_no',$request->receipt_no);
        $product_to_destroy->delete();

        return redirect('invoices')->with('deleted','Deleted Successfully');
    }
    
    public function currentMonthSales(Request $request)
    {
        $total_receipts = 0;
        $total_mpesa = 0;
        $total_cash = 0;
        $total_expenses = 0;
        $total_invoice = 0;
        $month = date('M');
        $month_number = date("n",strtotime($month));
        $year = date('Y');
        
        $receipts = Receipt::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month_number)->where('status',1)->get();
            foreach($receipts as $receipt)
            {
                $total_receipts += $receipt->to_pay;
            }
        $mpesas = Receipt::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month_number)->where([['status',1],['mode','M-PESA']])->get();
            foreach($mpesas as $mpesa)
            {
                $total_mpesa += $mpesa->to_pay;
            }
        $cashs = Receipt::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month_number)->where([['status',1],['mode','CASH']])->get();
            foreach($cashs as $cash)
            {
                $total_cash += $cash->to_pay;
            }
        $expenses = Expense::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month_number)->where('status',1)->get();
            foreach($expenses as $expense)
            {
                $total_expenses += $expense->amount;
            }
        $categories = Category::all();
         $inventories = Inventory::all();
        $items = Report::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month_number)->orderBy('category_id','desc')->get();
        return view('Admin.monthly_sales')->with('receipts',$receipts)
                                          ->with('items',$items)
                                          ->with('total_cash',$total_cash)
                                          ->with('total_mpesa',$total_mpesa)
                                          ->with('cashs',$cashs)
                                          ->with('inventories',$inventories)
                                          ->with('mpesas',$mpesas)
                                            ->with('expenses',$expenses)
                                          ->with('total_expenses',$total_expenses)
                                          ->with('categories',$categories)
                                          ->with('month',$month)
                                          ->with('year',$year)
                                          ->with('total_receipts',$total_receipts);

    }

    public function monthlySales(Request $request)
    {
        $total_receipts = 0;
        $total_mpesa = 0;
        $total_cash = 0;
        $total_invoice = 0;
        $total_expenses = 0;
        $month = $request->month;
        $year = $request->year;
        
        $receipts = Receipt::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->where('status',1)->get();
            foreach($receipts as $receipt)
            {
                $total_receipts += $receipt->to_pay;
            }
        $mpesas = Receipt::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->where([['status',1],['mode','M-PESA']])->get();
            foreach($mpesas as $mpesa)
            {
                $total_mpesa += $mpesa->to_pay;
            }
        $cashs = Receipt::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->where([['status',1],['mode','CASH']])->get();
            foreach($cashs as $cash)
            {
                $total_cash += $cash->to_pay;
            }
        $expenses = Expense::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->where('status',1)->get();
            foreach($expenses as $expense)
            {
                $total_expenses += $expense->amount;
            }
        $categories = Category::all();
         $inventories = Inventory::all();
        $items = Report::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->orderBy('category_id','desc')->get();
        return view('Admin.monthly_sales')->with('receipts',$receipts)
                                          ->with('items',$items)
                                          ->with('total_invoice',$total_invoice)
                                          ->with('total_cash',$total_cash)
                                          ->with('total_mpesa',$total_mpesa)
                                          ->with('cashs',$cashs)
                                          ->with('mpesas',$mpesas)
                                          ->with('categories',$categories)
                                          ->with('month',$month)
                                          ->with('expenses',$expenses)
                                          ->with('total_expenses',$total_expenses)
                                          ->with('inventories',$inventories)
                                          ->with('year',$year)
                                          ->with('total_receipts',$total_receipts);
                                          

    }

    public function fetchExpenses()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Saved Successfully');
        }
        if(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'Flavour Already Added to this category');
        }
        $expenses = Expense::all();
         $accounts = Account::all();
        return view('Admin.expenses')->with('expenses',$expenses)->with('accounts',$accounts);
        
    }

    
    public function addExpense(Request $request)
    {
        $add_expense = new Expense;
        $add_expense->description = $request->description;
        $add_expense->amount = $request->amount;
        $add_expense->account_id = $request->account;
        $add_expense->user_id = auth::user()->id;
        $add_expense->save();

        $balance = Account::find($request->account);
        $current_balance= $balance->current_balance;
        $balance->current_balance = ($current_balance - $request->amount );
        $balance->update();

        $state = new Statement;
        $state->account_id = $request->account;
        $state->user_id = Auth::user()->id;
        $state->debit = $request->amount;
        $state->current_balance = ($current_balance - $request->amount );
        $state->description = $request->description;
        $state->save();

        

        return back()->with('success','Expense Added Successfully');
    }

    //destroy expenses
    public function destroyExpense(Request $request, $id)
    {
        $to_destroy = Expense::find($request->expense_id);
       
        $state = new Statement;
        $state->account_id = $to_destroy->account_id;
        $state->user_id = Auth::user()->id;
        $state->credit = $to_destroy->amount;

        $balance = Account::find($to_destroy->account_id);
        $current_balance= $balance->current_balance;
        $balance->current_balance = ($current_balance + $to_destroy->amount);
        $balance->update();

        $state->current_balance = ($current_balance + $to_destroy->amount);
        $state->description = "Expense reversal_".$to_destroy->description;
        $state->save();

        

        $to_destroy->delete();

        return back()->with('deleted','Deleted Successfully');
    }

    public function fetchAccounts()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Saved Successfully');
        }
        if(session('deleted'))
        {
            Alert::success('Success!', 'Deleted Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'Flavour Already Added to this category');
        }
        $accounts = Account::all();
        return view('Admin.accounts')->with('accounts',$accounts);
    }

    public function addAccount(Request $request)
    {
        $add_account = new Account;
        $add_account->acc_no = $request->acc_no;
        $add_account->name = $request->name;
        $add_account->type = $request->type;
        $add_account->opening_balance = $request->opening_balance;
        $add_account->current_balance = $request->opening_balance;
        $add_account->save();

        $insertedId = $add_account->id;

        $state = new Statement;
        $state->account_id = $insertedId;
        $state->user_id = Auth::user()->id;
        $state->credit = $request->opening_balance;
        $state->opening_balance = $request->opening_balance;
        $state->current_balance = $request->opening_balance;
        $state->description = $request->description;
        $state->save();

        return back()->with('success','Account Added Successfully');
    }

    public function destroyAccount(Request $request, $id)
    {
        $to_destroy = Account::find($request->account_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }

    public function transfer(Request $request)
    {
        $balance1 = Account::find($request->transfer_from);
        $current_balance= $balance1->current_balance;
        $balance1->current_balance = ($current_balance - $request->amount);
        $balance1->update();

        $state1 = new Statement;
        $state1->account_id = $request->transfer_from;
        $state1->user_id = Auth::user()->id;
        $state1->debit = $request->amount;
        $state1->current_balance = ($current_balance - $request->amount );
        $state1->description = "Transfer_".$request->description;
        $state1->save();

        $balance2 = Account::find($request->transfer_to);
        $current_balance= $balance2->current_balance;
        $balance2->current_balance = ($current_balance + $request->amount);
        $balance2->update();

        $state2 = new Statement;
        $state2->account_id = $request->transfer_to;
        $state2->user_id = Auth::user()->id;
        $state2->credit = $request->amount;
        $state2->current_balance = ($current_balance + $request->amount );
        $state2->description = "Transfer_".$request->description;
        $state2->save();      

        return back()->with('success','Expense Added Successfully');
    }

    public function accountStatement($id)
    {
        $statements = Statement::where('account_id', $id)->get();
        $account = Account::find($id);
        return view('Admin.account_statement')->with('statements',$statements)->with('account', $account);
    }
    
    //find account balance dynamically
      public function findBalance(Request $request)
      {
          $data = Account::find($request->id);
          return response()->json($data);
      }

public function getMpesatransactions()
    {
        if(session('success'))
        {
            Alert::success('Success!', 'Transaction made Successfully');
        }
        elseif(session('error'))
        {
            Alert::error('Error!', 'Please select more than one Order');
        }
        $mpesas = Mpesa::all();
        $yesterday_float = Mpesadaily::whereDate('created_at', Carbon::yesterday())->first();
        if(empty($yesterday_float))
        {
            $yesterday_float = array();
        }
        $yesterday_cash = Mpesadaily::whereDate('created_at', Carbon::yesterday())->first();
         if(empty($yesterday_cash))
        {
            $yesterday_cash = array();
        }
        $checkdaily = Mpesadaily::whereDate('created_at', Carbon::today())->first();
        if(empty($checkdaily))
        {
            $mdaily = new Mpesadaily;
            $mdaily->deposits = 0;
            $mdaily->withdrawals =0;
            $mdaily->commision =0;
            $mdaily->float = $yesterday_float->float;
            $mdaily->cash = $yesterday_cash->cash;
            $mdaily->save();

            $daily = Mpesadaily::whereDate('created_at', Carbon::today())->first();
        }
        else
        {
          $daily = Mpesadaily::whereDate('created_at', Carbon::today())->first();
        }

        return view('Waiter.mpesa')->with('mpesas', $mpesas)->with('daily', $daily);
    }

    //add float
    public function addFloat(Request $request)
    {
        $float = new Mpesa;
        $float->float = $request->amount + $request->float;
        $float->cash = $request->cash;
        $float->deposit = 0;
        $float->withdraw =$request->amount;
        $float->commision =0;
        $float->ref ="N/A";
        $float->description = "Float topup";
        $float->save();

        $daily = Mpesadaily::whereDate('created_at', Carbon::today())->first();
        if(empty($daily))
        {
            $mdaily = new Mpesadaily;
            $mdaily->deposits = 0;
            $mdaily->withdrawals =0;
            $mdaily->commision =0;
            $mdaily->float = $request->amount;
            $mdaily->save();
        }
        else
        {
            Mpesadaily::where('id',$daily->id)->increment('float', $request->amount);
        }
        
        return back()->with('success','Added Successfully');
    }
    //add float
    public function addCash(Request $request)
    {
        $float = new Mpesa;
        $float->float =$request->float;
        $float->cash = $request->amount + $request->cash;
        $float->deposit = $request->amount;
        $float->withdraw =0;
        $float->commision =0;
        $float->ref ="N/A";
        $float->description = "Cash Topup";
        $float->save();

        $daily = Mpesadaily::whereDate('created_at', Carbon::today())->first();
        if(empty($daily))
        {
            $mdaily = new Mpesadaily;
            $mdaily->deposits = 0;
            $mdaily->withdrawals =0;
            $mdaily->commision =0;
            $mdaily->float = 0;
            $mdaily->cash = $request->amount;
            $mdaily->save();
        }
        else
        {
            Mpesadaily::where('id',$daily->id)->increment('cash', $request->amount);
        }
        
        return back()->with('success','Added Successfully');
    }
    
    public function depositMoney(Request $request)
    {
        $float = new Mpesa;
        $float->float = ($request->float)-($request->amount);
        $float->cash = ($request->cash)+($request->amount);
        $float->deposit = $request->amount;
        $float->withdraw =0;
        $float->commision =$request->deposit_commision;
        $float->ref =$request->identity;
        $float->description = "Customer Deposit";
        $float->save();

        $daily = Mpesadaily::whereDate('created_at', Carbon::today())->first();

        Mpesadaily::where('id',$daily->id)->decrement('float', $request->amount);
        Mpesadaily::where('id',$daily->id)->increment('cash', $request->amount);
        Mpesadaily::where('id',$daily->id)->increment('commision', $request->deposit_commision);
        Mpesadaily::where('id',$daily->id)->increment('deposits', $request->amount);
     
        
        return back()->with('success','Added Successfully');
    }

    public function withdrawMoney(Request $request)
    {
        $float = new Mpesa;
        $float->float = ($request->float)+($request->amount);
        $float->cash = ($request->cash)-($request->amount);
        $float->deposit = 0;
        $float->withdraw =$request->amount;
        $float->commision =$request->withdrawal_commision;
        $float->ref =$request->identity;
        $float->description = "Customer Withdrawal";
        $float->save();

        $daily = Mpesadaily::whereDate('created_at', Carbon::today())->first();

        Mpesadaily::where('id',$daily->id)->increment('float', $request->amount);
        Mpesadaily::where('id',$daily->id)->decrement('cash', $request->amount);
        Mpesadaily::where('id',$daily->id)->increment('commision', $request->withdrawal_commision);
        Mpesadaily::where('id',$daily->id)->increment('withdrawals', $request->amount);
     
        
        return back()->with('success','Added Successfully');
    }
    
    public function cashToFloat(Request $request)
    {
        $float = new Mpesa;
        $float->float = ($request->float)+($request->amount);
        $float->cash = ($request->cash)-($request->amount);
        $float->deposit = 0;
        $float->withdraw =$request->amount;
        $float->commision =0;
        $float->ref ="Transfer";
        $float->description = "Cash to Float transfer";
        $float->save();

        $daily = Mpesadaily::whereDate('created_at', Carbon::today())->first();

        Mpesadaily::where('id',$daily->id)->increment('float', $request->amount);
        Mpesadaily::where('id',$daily->id)->decrement('cash', $request->amount);
     
        
        return back()->with('success','Added Successfully');
    }

    //destroy size
    public function destroyEntry(Request $request, $id)
    {
        $to_destroy = Mpesa::find($request->transaction_id);
        $to_destroy->delete();
        return back()->with('deleted','Deleted Successfully');
    }


}
