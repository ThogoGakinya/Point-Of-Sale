<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Admin\Inventory;
use App\Admin\Size;
use App\Admin\UnitOfMeasure;
use App\Admin\Category;
use App\Admin\CustomerTable;
use App\Admin\CategoryFlavour;
use App\Admin\Toppings;
use App\Admin\Flavour;
use App\Admin\ProductHistory;
use App\Admin\Receipt;
use App\Admin\Report;
use App\Admin\WaiterReport;
use App\Admin\WaiterItemizedReport;
use App\Admin\CompanyDetail;
use App\Admin\Sale;
use Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


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
        $products = Inventory::all();
        $categories = Category::all();
        $uoms = UnitOfMeasure::all();
        $sizes = Size::all();
        return view('Admin.inventory')->with('products', $products)
                                      ->with('categories', $categories)
                                      ->with('uoms', $uoms)
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
        
        $categories = Category::all();
        $uoms = UnitOfMeasure::all();
        $sizes = Size::all();
        $toppings = Toppings::all();
        $launcher = 0;
        $current_flavour_name = '';
        $current_flavour_id = '';
        $flavours = Flavour::all();
        $tables = CustomerTable::all();
        $category_flavours = array();
        $categories = Category::all();
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
                $path1 = $request->file('image_name')->storeAs('public/Images', $imageNameToStore);
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
        $category = Category::find($request->category_id);
        $category->name = $request->category_name;
        $category->short_form = $request->short;
        $category->update();
        
        return back()->with('updated','Added Successfully');
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
                $path1 = $request->file('product_image')->storeAs('public/Images', $imageNameToStore);
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
        $inventory ->price_level3 = $request->price_level_3;
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
                $path1 = $request->file('product_image')->storeAs('public/Images', $imageNameToStore);
            }
        $inventory = Inventory::find($request->product_id);
        $inventory ->name = $request->product_name;
        $inventory ->code = $request->product_code;
        $inventory ->category_id = $request->category_id;
        $inventory ->size_id = $request->size_id;
        $inventory ->uom_id = $request->unit_id;
        $inventory ->instock = $request->quantity;
        $inventory ->regular_price = $request->regular_price;
        $inventory ->price_level2 = $request->price_level_2;
        $inventory ->price_level3 = $request->price_level_3;
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
        $toaster = 1;
        $current_receipt = session()->get('receipt');
        $selected = array();
        $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$current_receipt]])->orderby('created_at','asc')->get();
        $category_id = $id;
        $sizes = Size::all();
        $flavours = CategoryFlavour::where('category_id',$id)->get();
        $uoms = UnitOfMeasure::where('category_id',$id)->get();
        return view('Waiter.categories')->with('flavours', $flavours)
                           ->with('toaster', $toaster)
                           ->with('category_id', $category_id)
                           ->with('current_receipt', $current_receipt)
                           ->with('header', $header)
                           ->with('mode', $mode)
                           ->with('popup_trigger', $popup_trigger)
                           ->with('products', $products)
                           ->with('sizes', $sizes)
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
        $toppings = $request->topping;
        $current_receipt = session()->get('receipt');
        $category_id = $request->category_id;
        $sizes = Size::all();
        $flavours = CategoryFlavour::where('category_id',$request->category_id)->get();
        $uoms = UnitOfMeasure::where('category_id',$request->category_id)->get();
        $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$current_receipt]])->orderby('created_at','asc')->get();
        return view('Waiter.categories')->with('flavours', $flavours)
                           ->with('toaster', $toaster)
                           ->with('category_id', $category_id)
                           ->with('header', $header)
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
 
    public function addToCart(Request $request)
    {
        //Adding choosen product to cart
        $today = date("Y-m-d");
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
        }
        else
        {
            $to_add = new Sale;
            $to_add->product_id = $request->product_id;
            $to_add->receipt_no = $request->product_receipt;
            $to_add->quantity = $request->product_quantity;
            $to_add->user_id = auth::user()->id;
            $to_add->toppings = $request->toppings;
            $to_add->mode = $request->mode;
            $line_total = $request->product_quantity * $request->product_price;
            $to_add->line_total = $line_total;
            $to_add->save();
            
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
            $header = $category->name;
            $toaster = 1;
            $category_id = $request->category_id;
            $current_receipt = session()->get('receipt');
            $sizes = Size::all();
            $selected = array();
            $mode = $request->mode;
            $popup_trigger = 0;
            $flavours = CategoryFlavour::where('category_id',$request->category_id)->get();
            $uoms = UnitOfMeasure::where('category_id',$request->category_id)->get();
            $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$request->product_receipt]])->orderby('created_at','asc')->get();
            return view('Waiter.categories')->with('flavours', $flavours)
                        ->with('toaster', $toaster)
                        ->with('category_id', $category_id)
                        ->with('header', $header)
                        ->with('mode', $mode)
                        ->with('selected', $selected)
                        ->with('popup_trigger', $popup_trigger)
                        ->with('current_receipt', $current_receipt)
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

    //complete transaction
    public function completeTransaction(Request $request)
    {
      
       $items = Sale::where([['user_id', auth::user()->id],['receipt_no',$request->receipt_no]])->get();
       $add_item = new Receipt;
       $add_item->receipt_no = $request->receipt_no;
       $add_item->to_pay = $request->to_pay;
       $add_item->tenderd = $request->tenderd;
       $add_item->change = $request->change;
       $add_item->tax = $request->tax;
       $add_item->serving_mode = $request->serving_mode;
       $add_item->mode = $request->serving_mode;
       $add_item->mpesa_ref = '';
       $add_item->status = $request->status;
       $add_item->mpesa_number = $request->mpesa_number;
       $add_item->user_id = auth::user()->id;
       $add_item->save();

        $header = $request->receipt_no;
        $toaster = 2;
        $mode = $header; 
        $popup_trigger = 0; 
        $receipt_trigger = 1; 
        $selected = array();
        $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$header]])->orderby('created_at','asc')->get();
        $categories = Category::all();

        session()->forget('receipt');

        return view('Waiter.categories')->with('categories', $categories)
                        ->with('toaster', $toaster)
                        ->with('selected', $selected)
                        ->with('products', $products)
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
        $toaster = 3;
        $mode = $header; 
        $popup_trigger = 0; 
        $receipt_trigger = 1; 
        $selected = array();
        $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$header]])->orderby('created_at','asc')->get();
        $categories = Category::all();

        session()->forget('receipt');

        return view('Waiter.categories')->with('categories', $categories)
                        ->with('toaster', $toaster)
                        ->with('selected', $selected)
                        ->with('products', $products)
                        ->with('items', $items)
                        ->with('request', $request)
                        ->with('popup_trigger', $popup_trigger)
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
                $path1 = $request->file('logo')->storeAs('public/Images', $imageNameToStore);
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
             return view('Waiter.customer_tables')->with('tables',$tables)->with('mode',$mode);
         }
         else
         {
            if(session()->has('receipt'))
            {
                $current_receipt = session()->get('receipt'); 
            }
            else
            {
                $new_receipt = rand(1000,9999);
                session(['receipt' => $new_receipt]); 
                $current_receipt = session()->get('receipt'); 
            }
            $header = 'Product Categories';
            $toaster = 0;
            $mode = $id;
            $popup_trigger = 0;
            $selected = array();
            $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$current_receipt]])->orderby('created_at','asc')->get();
            $categories = Category::all();
            return view('Waiter.categories')->with('categories', $categories)
                            ->with('toaster', $toaster)
                            ->with('selected', $selected)
                            ->with('selected', $selected)
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
            $new_receipt = rand(1000,9999);
            session(['receipt' => $new_receipt]); 
            $current_receipt = session()->get('receipt'); 
        }
        $header = 'Product Categories';
        $toaster = 0;
        $mode = $id; 
        $popup_trigger = 0; 
        $selected = array();
        $products = Sale::where([['user_id',auth::user()->id],['receipt_no',$current_receipt]])->orderby('created_at','asc')->get();
        $categories = Category::all();
        return view('Waiter.categories')->with('categories', $categories)
                        ->with('toaster', $toaster)
                        ->with('selected', $selected)
                        ->with('selected', $selected)
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
         $receipts = Receipt::where([['user_id',auth::user()->id],['status',1]])->get();
         $invoices = Receipt::where([['user_id',auth::user()->id],['status',0]])->get();

         return view('Waiter.receipts_invoices')->with('receipts',$receipts)->with('invoices',$invoices);
     }

     public function viewInvoice($receipt, $id)
     {
         $invoice_data = Sale::where('receipt_no', $receipt)->get();
         $invoice_details = Receipt::find($id);

         return view('Waiter.view_invoices')->with('invoice_data',$invoice_data)->with('invoice_details',$invoice_details);
     }

     public function viewReceipt($receipt, $id)
     {
         $receipt_data = Sale::where('receipt_no', $receipt)->get();
         $receipt_details = Receipt::find($id);

         return view('Waiter.view_receipts')->with('receipt_data',$receipt_data)->with('receipt_details',$receipt_details);
     }

     public function viewFlavour($id)
     {
        if(session('success'))
        {
            Alert::success('Success!', 'Updated Successfully');
        }
         $category_flavours = CategoryFlavour::where('flavour_id', $id)->get();
         $categories = Category::all();
         $current_flavour = Flavour::find($id);
         $current_flavour_name =  $current_flavour->name;
         $current_flavour_id =  $current_flavour->id;
         $launcher = 1;
         $categories = Category::all();
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
        $receipts = Receipt::where([['user_id',auth::user()->id],['status',1]])->get();
        $invoices = Receipt::where([['user_id',auth::user()->id],['status',0]])->get();
         return view('Waiter.dashboard')->with('invoices',$invoices)->with('receipts',$receipts);
     }

}
