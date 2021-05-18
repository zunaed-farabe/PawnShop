<?php

namespace Tests\Unit;

use Tests\TestCase;
use Session;
use App\User;
use Auth;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class userTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRegister(){
        $data=['Fname'=>'Farishta','Lname'=>'Kabir','email'=>'kabir@gmail.com','password'=>'farishta321' ,'password_confirmation'=>'farishta321'];
        $response=$this->json('POST', '/register',$data);
        // dd($response->getContent());
       
        $this->assertDatabaseHas('users', [
            'Fname'=>'Farishta'
        ]);
        $this->assertDatabaseHas('users', [
            'Lname'=>'Kabir'
        ]);
        $this->assertDatabaseHas('users', [
            'email'=>'kabir@gmail.com'
        ]);
       
    }

    public function testLogin(){
        $data=['email'=>'kabir@gmail.com','password'=>'farishta321' ];
        $response=$this->json('POST', '/login',$data);
        $this->assertEquals($data['email'],Auth::user()->email);
    }





    public function testHomepage(){
        $response=$this->get("/home");
        $response->assertStatus(302);
    }


    public function testAdmin(){
        $this->assertDatabaseHas('users', [
            'id'=>'2'
        ]);

        $this->assertDatabaseHas('users', [
            'Fname'=>'admin'
        ]);
    }


}
