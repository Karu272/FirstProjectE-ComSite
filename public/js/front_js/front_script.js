$(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $("#sort").on('change',function(){
       this.form.submit();
    });

    $("#sort").on('change',function(){
		var sort = $(this).val();

		var url = $("#url").val();
		$.ajax({
			url:url,
			method:"post",
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(data){
				$('.filter_products').html(data);
			}
		})
	});

    function get_filter(class_name){
		var filter = [];
		$('.'+class_name+':checked').each(function(){
			filter.push($(this).val());
		});
		return filter;
	}

	$("#getPrice").change(function(){
		var size = $(this).val();
		if(size==""){
			alert("Please select Size");
			return false;
		}
		var product_id = $(this).attr("product-id");
		$.ajax({
			url:'/get-product-price',
			data:{size:size,product_id:product_id},
			type:'post',
			success:function(resp){
				if(resp['discount']>0){
					$(".getAttrPrice").html("<del>Rs. "+resp['product_price']+"</del> Rs."+resp['final_price']);
				}else{
					$(".getAttrPrice").html("Rs. "+resp['product_price']);
				}

			},error:function(){
				alert("Error");
			}
		});
	});



    // Update Cart Items
$(document).on('click','.btnItemUpdate',function(){
    if($(this).hasClass('qtyMinus')){
    // if qtyMinus button gets clicked by User
    var quantity = $(this).prev().val();
    if(quantity<=1){
    alert("Item quantity must be 1 or greater!");
    return false;
    }else{
    new_qty = parseInt(quantity)-1;
    }
    }
    if($(this).hasClass('qtyPlus')){
    // if qtyPlus button gets clicked by User
    var quantity = $(this).prev().prev().val();
    new_qty = parseInt(quantity)+1;
    }
    var cartid = $(this).data('cartid');

    $.ajax({
        data:{"cartid":cartid,"qty":new_qty},
        url:'/update-cart-item-qty',
        type:'post',
        success:function(resp){
    if(resp.status==false){
    alert(resp.message);
    }
    $(".totalCartItems").html(resp.totalCartItems);
    $("#AppendCartItems").html(resp.view);
    },error:function(){
    alert("This is the Error");
    }
    });
    });

    // Delete Cart Items
$(document).on('click','.btnItemDelete',function(){
       var cartid = $(this).data('cartid');
       var result = confirm("Want to delete this Cart Item");
            if(result){
                $.ajax({
                    data:{"cartid":cartid},
                    url:'/delete-cart-item',
                    type:'post',
                    success:function(resp){
                $(".totalCartItems").html(resp.totalCartItems);
                $("#AppendCartItems").html(resp.view);
            },error:function(){
            alert("Error");
            }
        });
    }
 });


// validate signup form on keyup and submit
$("#registerForm").validate({
    rules: {
        name: "required",
        email: {
            required: true,
            email: true,
            remote: "check-email"
        },
        password: {
            required: true,
            minlength: 6
        },
        confirm_password: {
            required: true,
            minlength: 6,
            equalTo: "#password"
        },
    },
    messages: {
        firstname: "Please enter your firstname",

        username: {
            required: "Please enter a username",
            minlength: "Your username must consist of at least 2 characters"
        },
        email: {
            required: "Please enter a email address",
            email: "Please enter a valid Email",
            remote: "Email already exist!"
        },
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long"
        },
        confirm_password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long",
            equalTo: "Please enter the same password as above"
        },
    }
});


// validate login form on keyup and submit
$("#loginForm").validate({
    rules: {
        email: {
            required: true,
            email: true,

        },
        password: {
            required: true,
            minlength: 6
        },
    },
    messages: {

        email: {
            required: "Please enter a email address",
            email: "Please enter a valid Email",
        },
        password: {
            required: "Please provide a password",

        },

    }
});


// validate account form on keyup and submit
$("#accountForm").validate({
    rules: {
        name: {
            required: true,
            accept: "[a-zA-Z]+"
        },
        mobile: {
            required: true,
            minlength: 10,
            maxlength: 10,
            digits: true
        }
    },
    messages: {
        name: {
            required: "Please enter your Name",
            accept: "Please enter valid Name"
        },
        mobile: {
            minlength: "Your mobile must consist of 10 digits",
            maxlength: "Your mobile must consist of 10 digits",
            digits: "Please enter your valid Mobile"
        }
    }
});

// validate account form on keyup and submit
$("#passwordForm").validate({
    rules: {
        current_pwd: {
            required: true,
            minlength:6,
            maxlength:20
        },
        new_pwd: {
            required: true,
            minlength:6,
            maxlength:20
        },
        confirm_pwd: {
            required: true,
            minlength:6,
            maxlength:20,
            equalTo:"#new_pwd"
        }
    }
});

// Check Current User Password
$("#current_pwd").keyup(function(){
    var current_pwd = $(this).val();
    $.ajax({
        type:'post',
        url:'/check-user-pwd',
        data:{current_pwd:current_pwd},
        success:function(resp){
            /*alert(resp);*/
            if(resp=="false"){
                $("#chkPwd").html("<font color='red'>Current Password is Incorrect</font>");
            }else if(resp=="true"){
                $("#chkPwd").html("<font color='green'>Current Password is Correct</font>");
            }
        },error:function(){
            alert("Error");
        }
    });
});

// Apply Coupon
$("#ApplyCoupon").submit(function(){
    var user = $(this).attr("user");
    if(user==1){
        // do nothing
    }else{
        alert("Please login to apply Coupon!");
        return false;
    }
    var code = $("#code").val();
    $.ajax({
        type:'post',
        data:{code:code},
        url:'/apply-coupon',
        success:function(resp){
            if(resp.message!=""){
                alert(resp.message);
            }
            $(".totalCartItems").html(resp.totalCartItems);
            $("#AppendCartItems").html(resp.view);
            if(resp.couponAmount>=0){
                $(".couponAmount").text(resp.couponAmount+".Php");
            }else{
                $(".couponAmount").text("0.Php");
            }
            if(resp.grand_total>=0){
                $(".grand_total").text(resp.grand_total+".Php");
            }
        },error:function(){
            alert("Error");
        }
    })
});


// Delete Delivery Address
$(document).on('click','.addressDelete',function(){
    var result = confirm("Want to delete this Address?");
    if(!result){
        return false;
    }
});

// stupid dropdown select pieace of shit fuck
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);

// Callculate shipping charges and Update grand total
$("input[name=address_id]").bind("change",function(){
    var shipping_charges = $(this).attr("shipping_charges");
    var total_price = $(this).attr("total_price");
    var coupon_amount = $(this).attr("coupon_amount");

    if(coupon_amount ==""){
        coupon_amount =0;
    }

    $(".shipping_charges").html(shipping_charges + ".Php");
    var grand_total = parseInt(total_price) + parseInt(shipping_charges) - parseInt(coupon_amount);

    $(".grand_total").html(grand_total + ".Php");

});

});