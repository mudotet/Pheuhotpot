var btn = document.querySelectorAll(".them")

btn.forEach(function(button,index){
    button.addEventListener("click",function(event){
        var btnItem = event.target
        var price = btnItem.parentElement
        var product = price.parentElement
        var productimg = product.parentElement

        var productImgElement = productimg.querySelector(".anh");
       
        var productImg = productImgElement ? productImgElement.src : "Image not found";

        var productNameElement = product.querySelector(".ten");
        var productPriceElement = product.querySelector(".gia");

        var productName = productNameElement ? productNameElement.innerText : "Product name not found";
        var productPrice = productPriceElement ? productPriceElement.innerText : "Price not found";

        // console.log(productImg);
        // console.log(productName);
        // console.log(productPrice);
        var food_drink = productimg.querySelector(".id_food_drink")
        var productID = food_drink ? food_drink.value: 0
        console.log(productID)
        var lau = productimg.querySelector(".id_lau")
        var lauID = lau? lau.value : 0
        console.log(lauID)
        addcart(productImg,productName,productPrice,productID,lauID)
    })
})

function addcart(productImg, productName, productPrice,productID,lauID) {
    // Create a new table row
    var addtr = document.createElement("tr");

    // Create HTML content for the new row
    var trcontent = '<td><img src="' + productImg + '" alt="" width="100px">' + productName + '<input type="hidden" class="id_food_drink1" name="id_food_drink1[]" value='+ productID + '><input type="hidden" class="id_lau" name="id_lau1" value='+ lauID + '></td><td><span class="product-price">' + productPrice + '</span></td><td><input type="number" class="quantity" name="quantity[]" min="1" value="1" style="width:30px"></td><td><span class="cart-delete" style="cursor: pointer;">Xóa</span></td>';

    // Set the inner HTML of the new row
    addtr.innerHTML = trcontent;

    // Append the new row to the cart table
    var cartTable1 = document.querySelector("tbody");
    console.log(cartTable1.append(addtr));

    // Save the updated cart table HTML to session storage
    var cartTable = cartTable1.innerHTML;
    sessionStorage.setItem("cartTable", cartTable);

    // Update cart total
    cartTotal();
}

// Function to handle delete cart item
function deleteCartItem() {
    // Delegate delete button click events to the parent element
    document.querySelector("tbody").addEventListener("click", function(event) {
        if (event.target && event.target.matches(".cart-delete")) {
            var cartItemRow = event.target.closest("tr");
            cartItemRow.remove();

            // Update session storage after removing item
            var updatedCartTable = document.querySelector("tbody").innerHTML;
            sessionStorage.setItem("cartTable", updatedCartTable);
            
            // Update cart total after removing item
            cartTotal();
        }
    });
}

// Call deleteCartItem function to set up event delegation
deleteCartItem();




function cartTotal(){
    var cartItem = document.querySelectorAll("tbody tr")
    // Initialize totalC to 0 before the loop starts
    var totalC = 0;

    for (var i = 0; i < cartItem.length; i++) {
        var inputValue = 0; // Initialize inputValue within the loop
        var productPrice = 0; // Initialize productPrice within the loop
        
        if (cartItem[i].querySelector(".quantity") !== null) {
            inputValue = parseFloat(cartItem[i].querySelector(".quantity").value);
        }
        
        if (cartItem[i].querySelector("span") !== null) {
            productPrice = parseFloat(cartItem[i].querySelector("span").innerHTML);
        }
        
        var totalA = inputValue * productPrice; // Calculate totalA for each item
        totalC = totalC + totalA; // Add totalA to totalC
        
     

        
        
    }
        var paid_priceElement = document.querySelector(".tong-tien");
        if (paid_priceElement) {
            
            // console.log(paid_price)
            paid_priceElement.value = totalC; 
        }
        // Your JavaScript code here
        var cartTotalA = document.querySelector(".tong-tien"); 
        if (cartTotalA !== null) {
            cartTotalA.innerHTML = totalC; // Assuming you want to display the totalC with two decimal places
            // var totalC = sessionStorage.setItem("totalC",totalC)
        } 
        var totalC = sessionStorage.setItem("totalC",totalC)
        const btn1 = document.querySelectorAll("button")
        const course_qr_img = document.querySelector(".course_qr_img")
        var imgtotal = sessionStorage.getItem("totalC")
        let QR = `https://img.vietqr.io/image/MB-0978251204-compact2.png?amount=${imgtotal}`
        course_qr_img.src = QR
        console.log(QR)
        sessionStorage.setItem("QR",QR)
        
        // console.log("totalC:", totalC);
        // console.log("cartTotalA:", cartTotalA);
        // console.log("paid_price", paid_priceElement);
            


        inputchange()
    };

 

 
    
    


    function inputchange() {
        var cartItems = document.querySelectorAll("tbody tr");
        
        cartItems.forEach(function(cartItem) {
            var inputValue = cartItem.querySelector(".quantity");
            if (inputValue) { // Check if input element exists
                inputValue.addEventListener("change", function() {
                    cartTotal();
                });
            }
        });
    }



const cartbtn = document.querySelector(".fa-xmark")
const cartshow = document.querySelector(".cua-toi")
cartshow.addEventListener("click", function(){
    
    document.querySelector(".gio-hang").style.right = "0"
})
    
cartbtn.addEventListener("click", function(){
    
    document.querySelector(".gio-hang").style.right = "-100%"
})
// const btnthanhtoan = document.querySelector(".button-thanh-toan")
// console.log(btnthanhtoan)
// btnthanhtoan.addEventListener("click", function(){
//     document.querySelector(".course_qr").style.display = "block"
// })

