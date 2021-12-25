<?php

namespace App\Console\Commands;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckOfferDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'offer:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check data offer is it active or not every day';

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
     * @return int
     */
    public function handle()
    {
        $offers = Offer::all();
        foreach($offers as $offer){
            $today = Carbon::now();
            $offer_begin = $offer->offer_begin;
            $offer_end = $offer->offer_end;
            if($today->greaterThanOrEqualTo($offer_begin) && $today->lessThanOrEqualTo($offer_end)){
                $status = 1 ;
            }else{
                $status = 0 ;
            }
            $offer -> update([
                'status' => $status
            ]);
        }
    }
}
