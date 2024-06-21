<?php
class GeographicCoordinates  {
   
    public function getCoordinates(Property $property): ?array
    {
        $url = "https://nominatim.openstreetmap.org/search?format=json&limit=1&q=" . urlencode($property->getLocation()->getCity());

        $userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/127.0.1';
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, $userAgent);

        // Ajouter les options pour ignorer la vérification SSL en local UNIQUEMENT
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, false);

        $json = curl_exec($curl_handle);

        curl_close($curl_handle);

       //Décoder le JSON
        $obj = json_decode($json, true);

        $latitude = $obj[0]['lat'];
        $longitude = $obj[0]['lon'];
        
        $coordinates = ["latitude" => $latitude,
                        "longitude" => $longitude                    
                        ];
                        
        return $coordinates;
    }
}