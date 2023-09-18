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

.card_content_text h5{

}
</style>
<main class="container-fluid"  style="height: 50rem">
    <div>
        <div style="margin-top:1rem">
            <b class="text-muted font-weight-bold " style="font-family: fangsong;"> Card Return </b>
            <hr>
           
        </div>
      <br />
       <div style="background: linear-gradient(68deg, #ff00000f 60% , #ffff0029 );padding-top: 2rem">
       
       
        <div class=" " style="">
            <div class="d-flex justify-content-end" >
                <input type="text" style="width: 13rem;"  placeholder="Search by card no" class="form-control">

            </div>
            <hr>
            <ul class="row" style="padding-left: 0rem">
                <li class="col-sm-12 col-md-6 col-lg-4 mb-2">
                    <div class="card d-flex  justify-content-between">
                        <div class="p-2 card_content_text">
                            <h5>Nasir Uddin </h5>
                            <p>card  : 44758395730834</p>
                            <p>Mobile : 01890492444</p>
                        
                        </div>
                        <div class="p-2 d-flex  justify-content-between">
                           <button class="btn btn-sm btn-success">Repacking </button>
                           <button class="btn btn-sm btn-warning">Unpcking</button>
                        </div>
                      
                    </div>
                </li>

             

         
                
            </ul>
        </div>

    </div>


     
    </div>
</main>

@endsection