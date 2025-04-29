<?php

   namespace App\Helpers;

   use Carbon\Carbon;
   use Illuminate\Support\Facades\Http;

   class TimeHelper
   {
       public static function getServerTime()
       {
           try {
               $response = Http::get('http://worldtimeapi.org/api/timezone/Africa/Casablanca');
               if ($response->successful()) {
                   $data = $response->json();
                   return Carbon::parse($data['datetime']);
               }
           } catch (\Exception $e) {
               \Log::error('Failed to fetch server time: ' . $e->getMessage());
           }

           return Carbon::now()->setTimezone('Africa/Casablanca');
       }
   }