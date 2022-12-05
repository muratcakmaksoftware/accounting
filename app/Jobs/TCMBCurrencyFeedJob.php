<?php

namespace App\Jobs;

use App\Interfaces\RepositoryInterfaces\TCMBCurrencyRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TCMBCurrencyFeedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     * Hata alirsa kac kere deneyeceginin belirlenmesi
     * @var int
     */
    public int $tries = 3;

    /**
     * The number of seconds to wait before retrying the job.
     * Hata alirsa kac saniye sonra tekrar deneyecek
     *
     * @var int
     */
    public int $backoff = 60;

    /**
     * The number of seconds the job can run before timing out.
     * Bu gorevin kac saniyede maksimum kac saniye bitmesi gerekir
     * @var int
     */
    public int $timeout = 300;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function handle()
    {
        $httpClient = Http::get('https://www.tcmb.gov.tr/kurlar/today.xml');

        if ($httpClient->status() == Response::HTTP_OK) {

            /**SimpleXMLElement {#863
             * +"@attributes": array:3 [
             * "Tarih" => "05.12.2022"
             * "Date" => "12/05/2022"
             * "Bulten_No" => "2022/231"
             * ]
             * }
             * if(isset($currencies->attributes()->{'Bulten_No'})){
             * $bultenNo = $currencies->attributes()->{'Bulten_No'};
             * }*/
            /**
             * +"Currency": array:23 [
             * 0 => SimpleXMLElement {#889
             * +"@attributes": array:3 [
             * "CrossOrder" => "0"
             * "Kod" => "USD"
             * "CurrencyCode" => "USD"
             * ]
             * +"Unit": "1"
             * +"Isim": "ABD DOLARI"
             * +"CurrencyName": "US DOLLAR"
             * +"ForexBuying": "18.6130"
             * +"ForexSelling": "18.6465"
             * +"BanknoteBuying": "18.6000"
             * +"BanknoteSelling": "18.6745"
             * +"CrossRateUSD": SimpleXMLElement {#893}
             * +"CrossRateOther": SimpleXMLElement {#905}
             * }
             */
            $data = simplexml_load_string($httpClient->body());
            if ($data !== false) {
                $tcmbCurrencyRepository = app()->make(TCMBCurrencyRepositoryInterface::class);
                $latestFirst = $tcmbCurrencyRepository->latestFirst(['id', 'created_at']);
                if (is_null($latestFirst) || Carbon::parse($latestFirst->created_at)->format('Y-m-d') != Carbon::now()->format('Y-m-d')) {
                    DB::transaction(function () use ($data, $tcmbCurrencyRepository) {
                        foreach ($data->{'Currency'} as $currency) {
                            $tcmbCurrencyRepository->store([
                                'name' => strval($currency->{'Isim'}) ?? 'Bulunamadı',
                                'code' => $currency->attributes()->{'CurrencyCode'} ?? 'Bulunamadı',
                                'unit' => intval($currency->{'Unit'}) ?? 0,
                                'forex_buy' => !empty($currency->{'ForexBuying'}) ? $currency->{'ForexBuying'} : 0,
                                'forex_sell' => !empty($currency->{'ForexSelling'}) ? $currency->{'ForexSelling'} : 0,
                                'banknote_buy' => !empty($currency->{'BanknoteBuying'}) ? $currency->{'BanknoteBuying'} : 0,
                                'banknote_sell' => !empty($currency->{'BanknoteSelling'}) ? $currency->{'BanknoteSelling'} : 0,
                            ]);
                        }
                    });
                }
            }
        }

    }

    /**
     * Handle a job failure.
     *
     * @param Throwable $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        // Send user notification of failure, etc...
    }
}
