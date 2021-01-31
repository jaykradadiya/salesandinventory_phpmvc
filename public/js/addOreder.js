$(document).ready(function()
{
   var domain="http://localhost/sem5/php_new/sale_and_inventory_management/";
   var productdata=[];
   var p=[];
   var row;
   function getselected()
   {
      $('option').prop('disabled', false); //reset all the disabled options on every change event
      $('select').each(function() { //loop through all the select elements
        var val = this.value;
        $('select').not(this).find('option').filter(function() { //filter option elements having value as selected option
          return this.value === val;
        }).prop('disabled', true); //disable those option elements
      });
   }
    function additemdata()
    {
      $.ajax(
         {
            url : "/sem5/mvc/public/order/sendData",
            method : "POST",
            data : {additemfun:1},
            dataType:"JSON",
            success: function(data)
            {
               console.log(data);
               console.log(data.length);
            data.forEach((val,index)=>
            {
               if(data[index]!=null)
               {
                  for(var i in data[index])
                  {
                     if(i<6)
                     p.push(data[index][i]);
                  }
                  p.push("0");
                  productdata.push(p);
                  p= [];
               }
            }

            )
            console.log(productdata);
            additem();
            }    
         }     
         );
      
    }
    additemdata();
    function additem()
    {
               
         row="<tr>";
         row+="<td>";
         row+="<select name='product_id[]' id='product_id' class='product_id'>";
            row+= "<option value='' selected disabled>select item</option>"
            productdata.forEach((val,index)=>{
                  row+="<option value='"+productdata[index][0]+"'>"+ productdata[index][1]+"</option>";
            })
            row+="</select>";
         row+="</td>";
         row+="<td><input type='number' name='O_p_price[]' id='O_p_price' readonly></td>";
         row+="<td><input type='number' name='product_stoke[]' id='product_stoke' readonly></td>";
         row+="<td><input type='number' name='quantity[]' id='quantity' class='quantity' min='0'></td>";
         row+="<td><input type='number' name='price[]' id='price' class='price' readonly></td>";
         row+="</tr>";
         $("tbody#product_buy").append(row);
         getselected();
    }
    $("#add").click(function()
    {
       additem();
    });
    $("#delete").click(function()
    {
        $("tbody#product_buy").children("tr:last").remove();
    });
    
   $("#product_buy").delegate(".product_id","change",function()
   {

      var pid = $(this).val();
      var tr =$(this).parent().parent();
      getselected();
      $.ajax(
         {
            url : "/sem5/mvc/public/order/sendDataById/"+ pid,
            method : "POST",
            data : {getdata:1,id:pid},
            dataType:"JSON",
            success: function(data)
            { 
               tr.find("#O_p_price").val(data["product_price"]);
               tr.find("#product_stoke").val(data["product_stoke"]);
               tr.find("#quantity").attr("max",data["product_stoke"]);

            }  
         });
   });

   function gettotal()
   {
      var total = 0;
      $(".price").each(function()
      {
          total = total + parseInt($(this).val());
         console.log($(this).val());
         console.log(total);
      });
      $("#total").val(total);

   }
   $("#product_buy").delegate(".quantity","keyup",function()
   {
      
      var data=$(this).val();
      console.log(data);
      var tr =$(this).parent().parent();
      var price=tr.find("#O_p_price").val();
      var total= data*price;
      var max=$(this).attr("max");
      tr.find("#price").val(total);
      gettotal();
   });

   $("#addorder").click(function()
   {  console.log("clicked");
    $.ajax(
        {
            url :"/sem5/mvc/public/order/chackOrder",
            method : "POST",
            data :$("#order_Table").serialize(),
            success: function(data)
            {
               if(data=="suceess")
               {

                  // window.location=domain+"view_orders.php"; 
               }
               else
               {
                  // window.location = "/sem5/mvc/public/order/chackOrder";
                  console.log(data);                
                    $("#order_Table").append(data);             

               }
            }  
        }
    )
   });
});