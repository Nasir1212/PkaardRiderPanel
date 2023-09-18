<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/index.css') }}">
   
    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
   
    <title>Rider  Login</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
        
        
        <div class="col-12">
    
        
            <div class="signup_container">
        
            <div  class="signup_col" style="height: 50rem" >
    
    
    
            <div style="display: flex;justify-content: center;flex-direction: column;align-items: center;margin-top: 10rem;">
            <h5 class="text-center text-danger" style="font-weight:bold">Pkaard Rider Login</h5>
            <br/>
    
                <div class="  col-lg-5 col-md-6 col-sm-12">

              
                <div class="card d-flex justify-content-center">
                <div class="card-body ">
                    <form class="row" name="login_form" autoComplete="of">
                        
                
                            
                
                            <div class="form-group mb-2">
                            <label for=""  class="form-label">Phone</label>
                            <input type="text"  class="form-control"    name="phone" placeholder="Phone"/>
                            </div>
            
                            <div class="form-group mb-2">
                                <label for=""  class="form-label">Password</label>
                                <input type="text"  class="form-control"    name="password" placeholder="Password"/>
                            </div>
                
                            <button  type="button" onclick="login(document.forms.login_form)" style="width: 96%;margin:auto"  class="btn btn-danger btn-sm mb-2">Login </button>
                     <div class="d-flex justify-content-between">
                        <a href="" class="link-underline-danger">Forgot Password?</a>
                        <a href="/signup" class="link-underline-danger">Sign Up</a>
                     </div>
                       
                    </form>
                </div> 
                </div>

            </div>
    
            </div>
    
            </div>
            </div>
        </div>
    
        </div>
        
    </div>

    <script>
        async function login(form){
            let form_data = Object.fromEntries(new FormData(form))
    
            try {   
    const response = await fetch(`/login_request`,{
        method:'POST',
        body:JSON.stringify(form_data),
        headers: new Headers({
        'Content-Type': 'application/json',

        })
    })

    const result = await response.json();
    console.log(result)
    if(result.condition==true){
        swal("Success", result.message, "success")
        location.href = `${location.origin}/`;

        
    }else{
        swal("Opps !", result.message, "error")
    }
} catch (error) {
    swal("Opps !", "Something went wrong", "error")
    console.log(error)
}

    

        }
    </script>
  
   <footer>
    <div>
      <p>© Copyright by Pkaard Ltd.|Terms & Conditions</p>
    </div>
   </footer>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>