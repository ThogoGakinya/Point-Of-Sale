

 $('.addProduct').on('click',function(){
        var product_quantity = document.getElementById("product_quantity").value;
        if(product_quantity ==0)
        {
             alert('Quantity can not be 0');
             document.getElementById("product_quantity").value = '';
        }
        if(product_quantity =='')
        {
             alert('Please add Quantity');
        }
   
    });

    var grand_totals = document.getElementById("grand_totals").value;
    var receipt_no = document.getElementById("receipt_id").value;
    document.getElementById("to_pay").value = grand_totals; 
    document.getElementById("mpesa_to_pay").value = grand_totals; 
    document.getElementById("invoice_to_pay").value = grand_totals; 
    document.getElementById("receipt_no").value = receipt_no;  

function issue()
     {
        var to_pay = document.getElementById('to_pay').value;
        var tenderd = document.getElementById('tenderd').value;
        var change = parseInt(tenderd) - parseInt(to_pay);
            if (!isNaN(change))
             {
                document.getElementById('change').value = change;
             }
      
    }
  


    