<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_contact_can_be_added()
    {
        $this->withoutExceptionHandling();
        
        $this->post('/api/contacts', [
            'name'=> 'Test Name',
            'email' => 'test@email.com',
            'birthday' => '05/14/1998',
            'company' => 'ABC string'
        ]);
        $contact = Contact::first();
        
        $this->assertEquals('Test Name',$contact->name);
        $this->assertEquals('test@email.com',$contact->email);
        $this->assertEquals('05/14/1998',$contact->birthday);
        $this->assertEquals('ABC string',$contact->company);

    }
    /** @test */
    public function a_name_is_required()
    {

        $response = $this->post('/api/contacts', [
            
            'email' => 'test@email.com',
            'birthday' => '05/14/1998',
            'company' => 'ABC string'
        ]);
      
        $response->assertSessionHasErrors('name');
        $this->assertCount(0,Contact::all());
    }
     /** @test */
     public function email_is_required()
     {
 
         $response = $this->post('/api/contacts', [
             'name'=> 'Test Name',
             
             'birthday' => '05/14/1998',
             'company' => 'ABC string'
         ]);
       
         $response->assertSessionHasErrors('email');
         $this->assertCount(0,Contact::all());
     }
}
