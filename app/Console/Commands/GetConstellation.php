<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Goutte\Client;

class GetConstellation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:constellation';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '取得星座資料並寫入資料庫';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        $constellations = array();
        $data = array();
        $day = array();
        // DB::beginTransaction('constellation');
        for ($i = 0; $i < 12; $i++) {
            $crawler = $client->request('GET', "https://astro.click108.com.tw/daily_$i.php?iAstro=$i");
            $crawler->filter('.MONTH img')->each(function ($node) use (&$day) {
                $month = $node->attr('src');
                array_push($day, (Str::substr($month, -5, 1)));
            });
            $month = implode("", $day);
            $day = array();

            $crawler->filter('.DATE img')->each(function ($node) use (&$day) {
                $date = $node->attr('src');
                array_push($day, (Str::substr($date, -5, 1)));
            });
            $date = implode("", $day);
            $day = array();

            $crawler->filter('.TODAY_CONTENT')->each(function ($contact) use (&$data, &$constellations, &$month, &$date) {
                $constellation = $contact->filter('h3')->html();
                // echo($contact->filter('h3')->html().'<br>');
                for ($i = 0; $i < 8; $i += 2) {
                    $data[] = $contact->filter('p')->eq($i)->html();
                }             
                DB::table('constellation')->insert(['date' => date('Y').'/'.$month.'/'.$date, 'constellation' => Str::substr($constellation, 2, 3), 'fortune' => json_encode($data), 'created_at' => \Carbon\Carbon::now()]);
                $data = [];
            });           
        }
    }
}
