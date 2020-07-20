<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Goutte\Client;

class CrawlerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $constellations = DB::table('constellation')->select('constellation')->get()->toArray();
        $data = DB::table('constellation')->select('fortune')->get();
        // $client = new Client();
        // $constellations = array();
        // $data = array();
        // for ($i=0; $i < 12; $i++) {
        //     $crawler = $client->request('GET', "https://astro.click108.com.tw/daily_$i.php?iAstro=$i");
        //     $crawler->filter('.TODAY_CONTENT')->each(function($contact) use (&$data,&$constellations){
        //         $constellations[] = $contact->filter('h3')->html();
        //         // echo($contact->filter('h3')->html().'<br>');
        //         for ($i=0; $i < 8; $i+=2) {
        //             $data[] = $contact->filter('p')->eq($i)->html();
        //             $links = $contact->filter('p')->eq($i);
        //             // echo($links->html().'<br>');
        //         }
        //     });
        // }
        return view('constellation',compact('constellations','data'));

        // $crawler = $client->request('GET', 'https://astro.click108.com.tw/');
        // $crawler->filter('.STAR12_BOX ul')->each(function($contact){
        //     for ($i=0; $i < 12; $i++) {
        //         $links = $contact->children()->eq($i)->filter('li a')->attr('href');
        //         echo($links);
        //     }
        // });
    }

    public function github()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://github.com/login');
        // $crawler = $client->click($crawler->selectLink('Sign in')->link());
        $form = $crawler->selectButton('Sign in')->form();
        $crawler = $client->submit($form, array('login' => 'jhuei0831@gmail.com', 'password' => ''));
        $crawler->filter('.flash-error')->each(function ($node) {
            dd($node->text());
        });
    }
}
