<?hh

class Weather {

    public static function getJSON(string $request_type, string $url, string $data): array {
        $curl = curl_init();

        switch($request_type) {
        
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;

            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;

            case "GET":
                curl_setopt($curl, CURLOPT_URL, $url . '?' . $data);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
                break;

            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        
        $result = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($result, true);
        return $data;
    }

    public static function getWeather() {
        $result = Weather::getJSON("GET", 'api.openweathermap.org/data/2.5/weather', 'id=5372223&appid=7371bd511b708870f4a484872cb4d527');
        $temperature = $result['main']['temp'] - 273;
        $desc = $result['weather'][0]['description'];
        print "Location: Menlo Park, " . "Temperature: " . $temperature . ", Description: " . $desc;
    }

    public static function storeWeather() {

        $servername = "localhost";
        $username = "root";
        $password = "myserver";
        $dbname = "movies";

    }

}

$Weather = new Weather();
$Weather->getWeather();
