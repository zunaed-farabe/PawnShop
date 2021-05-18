<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Http\controllers\itemsController;
use App\Http\Controllers\AuctionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Session;
use App\User;
use Auth;
class itemTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testStoreItems(){

        Storage::fake('image'); 
        Session::start();
        $user = User::find(1);
        Auth::login($user);
       
        $data=['name'=>'GolAluu','description'=>'test data','image'=>UploadedFile::fake()->create('test.png', $kilobytes = 0)];
        $response=$this->json('POST', '/items',$data);

       // dd($response->getOriginalContent());

        
         $this->assertDatabaseHas('items', [
             'name'=>'GolAluu'
          ]);

        $this->assertDatabaseHas('items', [
            'description'=>'test data'
        ]);
       
      
        

     }


   
     public function testUpdateItems(){
    //     Storage::fake('image'); 
         Session::start();
         $user = User::find(1);
         Auth::login($user);
       
       //  $data=['name'=>'GolAluu','description'=>'test data updated','image'=>UploadedFile::fake()->create('test.png', $kilobytes = 0)];
     //    $response=$this->json('POST', '/items',$data);

    //    // dd($response->getOriginalContent());

    $itemcontrol = new itemsController;
   // $this->login(1);
    $request = new Request;
    $request->replace([
        'name'=>'GolAluu',
        'description'=>'test data updated',
        'image'=>UploadedFile::fake()->create('test.png', $kilobytes = 0), 
    ]);
    $item_id=28;
    $response=$itemcontrol->update($request,$item_id);
   
         $this->assertDatabaseHas('items', [
             'description'=>'test data updated'
         ]);

         $this->assertDatabaseHas('items', [
            'name'=>'GolAluu'
         ]);
        
        

    }

    public function testDeleteItem(){


        Session::start();
         $user = User::find(1);
         Auth::login($user);
       
        $itemcontrol = new itemsController;
    
        $item_id=28;
        $response = $itemcontrol->destroy($item_id);

        
        // dd($response->getContent());
        $this->assertDatabaseMissing('items', [
            'id'=>'28'
        ]);

    }

    public function testAddAuction(){


        Session::start();
        $user = User::find(1);
        Auth::login($user);
       
        $itemcontrol = new itemsController;
        
        $Auctioncontrol = new AuctionController;
        $item_id=28;
        $request = new Request;
        $request->replace([
            'name'=>'500',
            'from'=>'1',
            'to'=>'1',
            'item'=>'28', 
            
        ]);
        
        $response = $Auctioncontrol->store($request);

        
         //dd($response);
         $this->assertDatabaseHas('aouctions', [
             'item'=>'28'
         ]);
         $this->assertDatabaseHas('aouctions', [
            'price'=>'500'
        ]);
        $this->assertDatabaseHas('aouctions', [
            'from'=>'1'
        ]);
        $this->assertDatabaseHas('aouctions', [
            'to'=>'1'
        ]);

    }


}