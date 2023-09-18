@extends("Layout.layout")
@section("content")
<style>
    .card_content_text{
        margin-bottom: -1rem
    }
    .card_content_text p {
    margin-bottom: 6px;
    font-size: 12px;
    font-weight: bold;
    text-align: justify;
    color: #222121;
    opacity: 0.7;
}
.card_content_text h5 {
    font-weight: bold;
    color: #878383;
    margin-bottom: 2px;
}



.custom_sm_btn {
    height: 1.4rem;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
}
</style>
<main class="container-fluid"  style="height: 50rem">
    <div>
        <div style="margin-top:1rem">
            <b class="text-muted font-weight-bold " style="font-family: fangsong;"> Delivery Status</b>
            <hr>
           
        </div>
      <br />
       <div style="background: linear-gradient(68deg, #ff00000f 60% , #ffff0029 );padding-top: 2rem;height: 50rem">
      
       
        <div class=" " style="">
            <div class="d-flex justify-content-end" >
                <input type="text" style="width: 13rem;" onkeyup="my_picked_card_by_search(this)"  placeholder="Search by card no" class="form-control">

            </div>
            <hr>
            <ul class="row" style="padding-left: 0rem" id="all_card">
                

             
                
                
            </ul>
        </div>

    </div>


     
    </div>

   

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <small class="text-muted">Card Register Info </small>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-sm">
            <thead class="table-light">
                <tr>
                    <td>Title </td>
                    <td>Information</td>
                </tr>
            </thead>
            <tbody id="card_register_info">
               
            </tbody>
          </table>
        </div>
       
      </div>
    </div>
  </div>

</main>
<script>

var myModal = new bootstrap.Modal(document.getElementById('myModal'));


async function more_show(data){
    myModal.show();

    const response = await fetch(`${window.location.origin}/card_register/${data}`);
    const result = await response.json();

    let view = result.map((item)=>{
        return(`
        <tr>
            <td>Name</td>
            <td>${item['full_name']}</td>
         </tr>

         <tr>
            <td>Card No</td>
            <td>${item['card_no']}</td>
         </tr>

         <tr>
            <td>Registration No </td>
            <td>1509002${item['card_id']}</td>
         </tr>

         <tr>
            <td>Phone Number</td>
            <td>${item['phone_number']}</td>
         </tr>

         <tr>
            <td>Delivery Address</td>
            <td>
                <span class="${item['cda_division'] == null ? 'd-none':''}"><b> Division </b> :${item['cda_division']}</span>
                <span class="${item['cda_district'] == null ? 'd-none':''}"><b> District </b> :${item['cda_district']}</span>
                <span class="${item['cda_Thana'] == null ? 'd-none':''}"><b> Thana </b>  :${item['cda_Thana']}</span>
                <span class="${item['cda_upzilla'] == null ? 'd-none':''}"><b> Upzilla </b> :${item['cda_upzilla']}</span>
                <span class="${item['cda_village'] == null ? 'd-none':''}"> <b>Village </b> :${item['cda_village']}</span>
                <span class="${item['cda_road_no'] == null ? 'd-none':''}"><b> Road No </b> :${item['cda_road_no']}</span>
                <span class="${item['cda_house_no'] == null ? 'd-none':''}"><b> House No </b> :${item['cda_house_no']}</span>
                <span class="${item['cda_apartment_no'] == null ? 'd-none':''}"><b> Apartment No :${item['cda_apartment_no']}</span>
                
                
                
            </td>
         </tr>

         <tr>
            <td>Full Address</td>
            <td>${item['cda_address_details']}</td>
         </tr>




        `)
    }).join("")
    card_register_info.innerHTML = view
 }

 function Show_payment_input(id){
    document.getElementById(`payment_container_${id}`).classList.remove('d-none')
    document.getElementById(`payment_btn_${id}`).classList.remove('d-none')
 }

   async function my_picked_card(){
    
const response = await fetch(`${window.location.origin}/my_picked_card`)
const result = await response.json();

let view  = result.map((item)=>{
    return(`
    
    <li class="col-sm-12 col-md-6 col-lg-4 mb-2">
        <div class="card d-flex flex-row justify-content-between" style="height: 9rem !important">
            <div class="p-2 card_content_text">
                
                <p>Card : ${item.card_no}</p>
                <p>Reg : 1509002${item.registation_no}</p>
                <p>Amount : ${item.amount} <i class="fa fa-money" aria-hidden="true"></i></p>
                <p class="${item.payment == null ? 'd-none':''}" >Payment : ${item.payment} <i class="fa fa-money" aria-hidden="true"></i> <i title="Edit Payment" onclick="Show_payment_input(${item.id})" class="fa fa-solid fa-pen-nib"></i></p>
               
                    <p id="payment_container_${item.id}" class="pb-2 ${item.delivery_complete==null ?'d-none':''}  ${item.payment != null ?'d-none':''}">
                    <input type="text" placeholder="Payment " id="payment_id_${item.id}" style="height: 24px"  class="form-control w-75" >

                    </p>
            </div>
            <div class="p-2 d-flex flex-column justify-content-between">

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox"  id="picked_ ${item.id}" disabled checked>
                    <label class="form-check-label" for="picked_ ${item.id}" >
                    <small><p class="p-0 m-0">Picked</p></small>   
                    </label>
                    </div>
                    
                    <div class="form-check ${item.return_card==1?'d-none':''}">
                    <input class="form-check-input" onclick="check_delivery(this);" type="checkbox" value="${item.id}" id="delivery_${item.id}" ${item.delivery_complete != null ?'disabled checked':''} >
                    <label class="form-check-label" for="delivery_${item.id}" >
                    <small><p class="p-0 m-0">Delivery</p></small>   
                    </label>
                    </div>

                    <div class="form-check  ${item.delivery_complete != null ?'d-none':''}">
                    <input class="form-check-input" onclick="check_return(this);" type="checkbox" value="${item.id}" id="return_${item.id}" ${item.delivery_complete != null ?'disabled checked':''} ${item.return_card==1 ?'disabled checked':''} >
                    <label class="form-check-label" for="return_${item.id}"  >
                    <small><p class="p-0 m-0 ${item.return_card==1?'text-danger':''} ">Return</p></small>   
                    </label>
                    </div>
                    
                   

                    <div class="form-group btn-group-sm">
                        <button onclick="more_show(${item.registation_no})" style='margin-bottom:1.5px' class="custom_sm_btn btn btn-sm btn-block btn-warning w-100 ">More</button>
                        <button onclick="payment_input(${item.id})" id="payment_btn_${item.id}" class="custom_sm_btn btn btn-sm btn-block btn-success w-100  ${item.delivery_complete==null ?'d-none':''}  ${item.payment != null ?'d-none':''} ">Payment </button>
                    </div>
                    
            </div>
            
        </div>
    </li>

    
    `)
}).join("")
all_card.innerHTML = view
        
    }

   async function my_picked_card_by_search(e){
    if(e.value==''){
        my_picked_card()
        return false;
    }
const response = await fetch(`${window.location.origin}/my_picked_card_by_search/${e.value}`)
const result = await response.json();

let view  = result.map((item)=>{
    return(`
    
    <li class="col-sm-12 col-md-6 col-lg-4 mb-2">
        <div class="card d-flex flex-row justify-content-between" style="height: 9rem !important">
            <div class="p-2 card_content_text">
                
                <p>Card : ${item.card_no}</p>
                <p>Reg : 1509002${item.registation_no}</p>
                <p>Amount : ${item.amount} <i class="fa fa-money" aria-hidden="true"></i></p>
                <p class="${item.payment == null ? 'd-none':''}" >Payment : ${item.payment} <i class="fa fa-money" aria-hidden="true"></i> <i title="Edit Payment" onclick="Show_payment_input(${item.id})" class="fa fa-solid fa-pen-nib"></i></p>
               
                    <p id="payment_container_${item.id}" class="pb-2 ${item.delivery_complete==null ?'d-none':''}  ${item.payment != null ?'d-none':''}">
                    <input type="text" placeholder="Payment " id="payment_id_${item.id}" style="height: 24px"  class="form-control w-75" >

                    </p>
            </div>
            <div class="p-2 d-flex flex-column justify-content-between">

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox"  id="picked_ ${item.id}" disabled checked>
                    <label class="form-check-label" for="picked_ ${item.id}" >
                    <small><p class="p-0 m-0">Picked</p></small>   
                    </label>
                    </div>
                    
                    <div class="form-check ${item.return_card==1?'d-none':''}">
                    <input class="form-check-input" onclick="check_delivery(this);" type="checkbox" value="${item.id}" id="delivery_${item.id}" ${item.delivery_complete != null ?'disabled checked':''} >
                    <label class="form-check-label" for="delivery_${item.id}" >
                    <small><p class="p-0 m-0">Delivery</p></small>   
                    </label>
                    </div>

                    <div class="form-check  ${item.delivery_complete != null ?'d-none':''}">
                    <input class="form-check-input" onclick="check_return(this);" type="checkbox" value="${item.id}" id="return_${item.id}" ${item.delivery_complete != null ?'disabled checked':''} ${item.return_card==1 ?'disabled checked':''} >
                    <label class="form-check-label" for="return_${item.id}"  >
                    <small><p class="p-0 m-0 ${item.return_card==1?'text-danger':''} ">Return</p></small>   
                    </label>
                    </div>
                    
                   

                    <div class="form-group btn-group-sm">
                        <button onclick="more_show(${item.registation_no})" style='margin-bottom:1.5px' class="custom_sm_btn btn btn-sm btn-block btn-warning w-100 ">More</button>
                        <button onclick="payment_input(${item.id})" id="payment_btn_${item.id}" class="custom_sm_btn btn btn-sm btn-block btn-success w-100  ${item.delivery_complete==null ?'d-none':''}  ${item.payment != null ?'d-none':''} ">Payment </button>
                    </div>
                    
            </div>
            
        </div>
    </li>

    
    `)
}).join("")
all_card.innerHTML = view
        
    }

    my_picked_card()
    async function check_delivery(e){
        swal({
  title: "Are you sure?",
  text: "this card is being transfer to pkaard card holder",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  cancelButtonText: "No",
  closeOnConfirm: false,
  closeOnCancel: true
},
async function(isConfirm){
  if (isConfirm) {
    try {

const response = await fetch(`${window.location.origin}/check_delivery/${e.value}`)
const result = await response.json();
console.log(result)
    if(result.condition==true){
        swal("Success!", result.message, "success");
        my_picked_card()
    }else{
        swal("Opps!", result.message, "error");
    }
    } catch (error) {
        swal("Opps!", "Something Went Wrong", "error");
    }
  }
});

e.checked=false;
    }

    
    async function check_return(e){
        console.log(e);
       
        swal({
  title: "Are you sure?",
  text: "this card is being returned from the Pkaard Register",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  cancelButtonText: "No",
  closeOnConfirm: false,
  closeOnCancel: true
},
async function(isConfirm){
  if (isConfirm) {
    try {

const response = await fetch(`${window.location.origin}/check_return/${e.value}`)
const result = await response.json();
console.log(result)
    if(result.condition==true){
        swal("Success!", result.message, "success");
        my_picked_card()
    }else{
        swal("Opps!", result.message, "error");
    }
    } catch (error) {
        swal("Opps!", "Something Went Wrong", "error");
    }
  }
});

e.checked=false;
    }

  async  function payment_input(id){
        
   let ElemValue = document.getElementById(`payment_id_${id}`).value;
        let server_data = {
           payment:ElemValue ==''?null:ElemValue,
           id:id
        }
    
        try {
        const response = await fetch(`/payment_input`,{
        method:'POST',
        body:JSON.stringify(server_data),
        headers: new Headers({
        'Content-Type': 'application/json',
        })
    })

    const result = await response.json();
    
    if(result.condition==true){
        swal("Success!", result.message, "success");
        my_picked_card()
    }else{
        swal("Opps!", result.message, "error");
    }

} catch (error) {
    swal("Opps!", "Something Went Wrong", "error");
            
        }

    }

</script>
@endsection