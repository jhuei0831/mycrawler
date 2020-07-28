<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
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
        $datas = DB::table('constellation')->get();
        $client = new Client();
        $day = array();
        $crawler = $client->request('GET', "https://astro.click108.com.tw/daily_10.php?iAstro=10");
        $crawler->filter('.MONTH img')->each(function ($node) use (&$day){
            $month = $node->attr('src');
            array_push($day, (Str::substr($month, -5, 1)));
            // echo Str::substr($month, -5, 1) . '<br>';
        });
        $month = implode("", $day);
        $day = array();
        $crawler->filter('.DATE img')->each(function ($node) use (&$day){
            $date = $node->attr('src');
            array_push($day, (Str::substr($date, -5, 1)));
            // echo Str::substr($date, -5, 1) . '<br>';
        });
        $date = implode("", $day);
        echo date('Y').'/'.$month.'/'.$date;

        // print_r($day);

        // $yoo = $crawler->filter('.MONTH img')->attr('src');
        // dd($yoo);
        return view('constellation',compact('constellations','datas'));

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
