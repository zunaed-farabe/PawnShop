<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Aouction;
use App\Http\Controllers\AuctionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Session;
use App\User;
use Auth;
use DB;



class AouctionTest extends TestCase
{

  use DatabaseTransactions;
  
  public function testAuctionStore(){


    Session::start();
    $user = User::find(1);
    Auth::login($user);
   
   
    $Auctioncontrol = new AuctionController;
    $item_id=25;
    $request = new Request;
    $request->replace([
        'name'=>'200',
        'from'=>'1',
        'to'=>'1',
        'item'=>'25', 
        
    ]);
    
    $response = $Auctioncontrol->store($request);

    
     //dd($response);
     $this->assertDatabaseHas('aouctions', [
         'item'=>'25'
     ]);

     $this->assertDatabaseHas('aouctions', [
      'price'=>'200'
    ]);
    $this->assertDatabaseHas('aouctions', [
        'from'=>'1'
    ]);
    $this->assertDatabaseHas('aouctions', [
        'to'=>'1'
    ]);
    

}


public function testAuctionUpdate(){


  Session::start();
  $user = User::find(1);
  Auth::login($user);
 
 
  $Auctioncontrol = new AuctionController;
  $item_id=25;
  $request = new Request;
  $request->replace([
      'price'=>'325',
      'to'=>'4',
          
  ]);
  
  $response = $Auctioncontrol->update($request,$item_id);

  
   //dd($response);
   $this->assertDatabaseHas('aouctions', [
       'price'=>'325'
   ]);
   
   $this->assertDatabaseHas('aouctions', [
    'to'=>'4'
    ]);
}

public function testAuctionEnd(){


  Session::start();
  $user = User::find(1);
  Auth::login($user);
 
 
  $Auctioncontrol = new AuctionController;
 
  
  $response = $Auctioncontrol->end();

  
   //dd($response);
   $this->assertDatabaseMissing('aouctions', [
       'price'=>'325'
   ]);

}

}
