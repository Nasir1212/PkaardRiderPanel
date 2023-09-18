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
}

.card_content_text h5 {
    font-weight: bold;
    color: #878383;
    margin-bottom: 2px;
}

.custom_heading {
    padding: 4px;
    font-size: 1.1rem;
    font-weight: bold;
    opacity: 0.5;
    padding: 4px !important;
    font-family: math;
}


@media screen and (max-width: 575px) {
.custom_flex {
    flex-direction: column;
}
    
    
  }
</style>
<main class="container-fluid"  style="height: 50rem">
    <div>
        <div style="margin-top:1rem">
            <b class="text-muted font-weight-bold " style="font-family: fangsong;">Home Page </b>
            <hr>
           
        </div>
      <br />
       <div style="background: linear-gradient(68deg, #ff00000f 60% , #ffff0029 );padding-top: 2rem;height: 50rem">
       
       
        <div >

            <div class="d-flex custom_flex flex-sm-column flex-lg-row justify-content-lg-between">
                <div  >
                <h1 class="custom_heading">Pick your delivery  card from Pkaard </h1>
                </div>
                <div  >
                    <input type="text" style="width: 13rem;" onkeyup="show_all_packing_card_by_search(this)"  placeholder="Search by card no" class="form-control">
                </div>
            </div>
            <hr>
            <ul class="row" style="padding-left: 0rem" id="show_card" >        
            </ul>
        </div>

    </div>


     
    </div>
</main>

<script>
 show_all_packing_card()
    async function show_all_packing_card(){

const response = await fetch(`/show_all_packing_card`);
const result = await response.json();

let listCard = result.map((item)=>{
return (`

<li class="col-sm-12 col-md-6 col-lg-4 mb-2">
<div class="card d-flex  justify-content-between">
    <div class="p-2 card_content_text">
        <h5>${item['full_name']}</h5>
        <p>card-no : ${item['card_no']}</p>
        <p>Reg-no : 1509002${item['registation_no']}</p>
        <p>Amount : ${item['amount']} <i class="fa fa-money" aria-hidden="true"></i></p>
    
    </div>
    <div class="p-2 d-flex  justify-content-start">  
        <div class="form-check" >
  <input class="form-check-input"   onclick="handle_pick_up(${item['id']})" type="checkbox" value="" id="check_${item['id']}">
  <label class="form-check-label"  for="check_${item['id']}"><i class="fa fa-handshake"></i>PickUp</label>
</div>              
    </div>
    
</div>
</li>


`)

}).join('')

document.getElementById("show_card").innerHTML = listCard

}

async function handle_pick_up (id) {

    
    try {
    
    const response = await fetch(`/handle_pick_up/${id}`);
    const result = await response.json();

    if(result.condition==true){
        swal("Success", result.message, "success")
        show_all_packing_card()
    }else{
        swal("Opps !", result.message, "error")
    }
        
} catch (error) {
    swal("Opps !", "Something went wrong", "error")
    console.log(error)
    }


    
}

async function show_all_packing_card_by_search(e){

const response = await fetch(`/show_all_packing_card_by_search/${e.value}`);
const result = await response.json();

let listCard = result.map((item)=>{
return (`

<li class="col-sm-12 col-md-6 col-lg-4 mb-2">
<div class="card d-flex  justify-content-between">
    <div class="p-2 card_content_text">
        <h5>${item['full_name']}</h5>
        <p>card-no : ${item['card_no']}</p>
        <p>Reg-no : 1509002${item['registation_no']}</p>
        <p>Amount : ${item['amount']} <i class="fa fa-money" aria-hidden="true"></i></p>
    
    </div>
    <div class="p-2 d-flex  justify-content-start">  
        <div class="form-check" >
  <input class="form-check-input"   onclick="handle_pick_up(${item['id']})" type="checkbox" value="" id="check_${item['id']}">
  <label class="form-check-label"  for="check_${item['id']}"><i class="fa fa-handshake"></i>PickUp</label>
</div>              
    </div>
    
</div>
</li>


`)

}).join('')

document.getElementById("show_card").innerHTML = listCard

}



</script>

@endsection