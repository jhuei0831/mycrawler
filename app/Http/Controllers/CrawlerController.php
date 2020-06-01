<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $client = new Client();
        $data = array();
        for ($i=0; $i < 12; $i++) {
            $crawler = $client->request('GET', "https://astro.click108.com.tw/daily_$i.php?iAcDay=2020-06-01&iAstro=$i");
            $crawler->filter('.TODAY_CONTENT')->each(function($contact) use (&$data){
                echo($contact->filter('h3')->html().'<br>');
                for ($i=0; $i < 8; $i+=2) {
                    $data[] = $contact->filter('p')->eq($i)->html();
                    $links = $contact->filter('p')->eq($i);
                    echo($links->html().'<br>');
                }
            });
        }
        return view('welcome',compact('data'));
        // $crawler = $client->request('GET', 'https://astro.click108.com.tw/');
        // $crawler->filter('.STAR12_BOX ul')->each(function($contact){
        //     for ($i=0; $i < 12; $i++) {
        //         $links = $contact->children()->eq($i)->filter('li a')->attr('href');
        //         echo($links);
        //     }
        // });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
