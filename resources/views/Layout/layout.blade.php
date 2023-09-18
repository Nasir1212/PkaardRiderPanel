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

    <title>Rider  </title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    {{-- hide_aside --}}
    <div class="pkkard_container_layout show_aside" id="container">
     @component("Component.Header")@endcomponent
    @component("Component.Aside")@endcomponent 
    @yield('content')
    @component("Component.Footer")@endcomponent
</div>
    <script src="https://kit.fontawesome.com/fbadad80a0.js"></script>
    <script>
        function chageAside(){
           
           let container =  document.getElementById('container')
           console.log(container.className.split(" "))

           let navigation  =  document.getElementsByClassName('navigation')[0]
           let side_container  =  document.getElementsByClassName('side_container')[0]

           console.log(side_container)
           let split = container.className.split(" ");
           console.log(split.includes('show_aside'))

           if(split.includes('show_aside')==true){
            container.classList.add("hide_aside")
            container.classList.remove("show_aside")
            side_container.style.cssText='width:0rem'

           }else{
            container.classList.remove("hide_aside")
            container.classList.add("show_aside")
            side_container.style.cssText=''
           }
        }

        
        if(screen.width < 480){
            chageAside()
        }
    </script>
</body>
</html>