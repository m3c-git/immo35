<?php
class locationRennesMetropole {
    private $apikey;
    public function construct(string $apikey)
    {
        $this->apikey=$apikey;
    }
    public function getForecast(string $city): ?array
    {
        $curl=curl_init('https://api.openweathermap.org/data/2.5/forecast?q={$city}&appid={$this->apikey}&units=metric');
        curlsetoptarray($curl, [
          CURLOPT_RETURNTRANSFER => true,
          CURLOPTCAINFO => _DIR.DIRECTORYSEPARATOR.'cert.cer'.DIRECTORYSEPARATOR.'cert.cer',
          CURLOPT_TIMEOUT => 1
        ]);
        $data=curl_exec($curl); 
        $results=[];
        $data=json_decode($data, true);
        foreach($data['list'] as $day) {
            $results[]=[
                'temp' => $day['main']['temp'],
                'description' => $day['weather'][0]['description'],
                'date' => new DateTime('@'.$day['dt'])
            ];
        }
        return $results;
    }
}