<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CardDelivery;
use App\Models\RiderSignup;
use Illuminate\Support\Facades\Session;

class HomeControler extends Controller
{
    public function show_all_packing_card(){
        return  \DB::select('SELECT  card_delivery.*, card_registation.full_name FROM   card_delivery  LEFT JOIN  card_registation  ON card_registation.card_id = card_delivery.registation_no WHERE card_delivery.packing IS true AND card_delivery.is_picked is NULL');
    
      }
    public function handle_pick_up($id){
       $session =  Session::get("user");
        $result = CardDelivery::where(['id'=>$id])->update([
            'is_picked'=>true,
            'picked_by'=> $session->id,
           
          ]);
      
          if($result){
            return json_encode(["condition"=>true,'message'=>"Successfully Picked Up "]);
      
           }else{
            return json_encode(["condition"=>false,"message"=>"Picked Up  Failed "]);
      
           }
      
        }

        public function show_all_packing_card_by_search ($card_no){
            return  \DB::select("SELECT  card_delivery.*, card_registation.full_name FROM   card_delivery  LEFT JOIN  card_registation  ON card_registation.card_id = card_delivery.registation_no WHERE card_delivery.packing IS true AND card_delivery.is_picked is NULL AND card_delivery.card_no LIKE concat('%',$card_no,'%')");
        
          }

        public function rider_sign_up(Request $req){
          $result = RiderSignup::insert([
            'name'=>$req->input("name"),
            'phone'=>$req->input("phone"),
            'password'=>base64_encode($req->input("password")),
          ]);


          if($result){
            return json_encode(["condition"=>true,'message'=>"Successfully Registration  "]);
      
           }else{
            return json_encode(["condition"=>false,"message"=>"Registration failed"]);
      
           }

        }
    
        public function login_request(Request $req){
        $is_match =   RiderSignup::where(['phone'=>$req->input("phone"),'password'=>base64_encode($req->input("password"))])->count();
       
        if($is_match >0){
         $data =  RiderSignup::where(['phone'=>$req->input("phone")])->get();
         $req->session()->put('is_login', true);
         $req->session()->put('user', $data[0] );
       
         return json_encode(["condition"=>true,'message'=>"Successfully  Logged ", 'data'=> $req->session()->all()]);
        }else{
          return json_encode(["condition"=>false,"message"=>"Email Or Password Not Matched "]);

        }
      
      }

      public function my_picked_card(){
        $session =  Session::get("user");
          return  CardDelivery::where(['picked_by'=> $session->id])->get();
        
      }
      public function my_picked_card_by_search($card_no){
        $session =  Session::get("user");  
       return \DB::select("SELECT * FROM card_delivery WHERE picked_by ='$session->id' AND card_delivery.card_no LIKE concat('%',$card_no,'%')");

      }

      public function check_delivery($id){
      $result =  CardDelivery::where(['id'=> $id])->update([
          'delivery_complete'=>true,
        ]);

        
        if($result){
          return json_encode(["condition"=>true,'message'=>" Delivery Completed  "]);
    
         }else{
          return json_encode(["condition"=>false,"message"=>" Delivery   failed"]);
    
         }

      }
      public function check_return($id){
      $result =  CardDelivery::where(['id'=> $id])->update([
          'return_card'=>true,
        ]);

        
        if($result){
          return json_encode(["condition"=>true,'message'=>" Card Returned   "]);
    
         }else{
          return json_encode(["condition"=>false,"message"=>" Card Return Failed "]);
    
         }

      }

      public function card_register($regi_no){
        $result =  \DB::select("SELECT card_delivery.card_no, card_registation.card_id, card_registation.phone_number,card_registation.full_name,card_registation.phone_number,card_registation.phone_number,card_registation.phone_number,card_registation.phone_number,card_registation.cda_division,card_registation.cda_district,card_registation.cda_upzilla,card_registation.cda_Thana,card_registation.cda_village, card_registation.cda_road_no,card_registation.cda_house_no,card_registation.cda_apartment_no,card_registation.cda_address_details FROM card_registation  LEFT JOIN card_delivery ON card_registation.card_id = card_delivery.registation_no WHERE card_registation.card_id = '$regi_no'");
        return $result;
      }

      public function payment_input(Request $req){
        $result =  CardDelivery::where(['id'=> $req->input("id")])->update([
          'payment'=>$req->input("payment"),
        ]);

        if($result){
          return json_encode(["condition"=>true,'message'=>" Payment Completed  "]);
    
         }else{
          return json_encode(["condition"=>false,"message"=>" Payment   failed"]);
    
         }
      }



}
