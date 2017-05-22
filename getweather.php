<?hh

class Weather {

    /*
     * Constructor to get the current configuration
     */
    public function __construct(
        private array $config
    ) {}


    /*
     * Takes the Request Type, URL and Data for the request and returns the JSON array
     */
    public function getJSON(string $request_type, string $url, string $data): array {

        // Initialize cURL
        $curl = curl_init();

        // TODO: Test if POST request works or not
        // Handle the given request
        switch($request_type) {
        
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
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

        // Get the result and end the cURL session
        $result = curl_exec($curl);
        curl_close($curl);

        // Decode the JSON received as response
        $data = json_decode($result, true);

        return $data;
    }


    /*
     * Prints the weather of the location (in this case it's Menlo Park) 
     */
    public function getWeather(): void {

        // Get the JSON response of the GET request
        $result = $this->getJSON("GET", 'api.openweathermap.org/data/2.5/weather', 'id=' . $this->config['LOCATION_ID'] 
            . '&appid=' . $this->config['API_KEY']);

        // Print the weather conditions at the given location
        $temperature = $result['main']['temp'] - 273;
        $desc = $result['weather'][0]['description'];
        print "Location: " . $this->config['LOCATION'] . ", " . "Temperature: " . $temperature . ", Description: " . $desc;

        // Store the weather in the table
        $this->storeWeather($temperature, $desc);
    }


    /*
     * Stores the weather in the sql database
     */
    public function storeWeather(float $temperature, string $desc): void {

        // Create a connection
        $connection = new mysqli($this->config['servername'], $this->config['username'], $this->config['password'], 
            $this->config['dbname']);

        if ($connection->connect_error)
            die ("Connection failed: " . $connection->connect_error);

        // Generate SQL query to insert the given values
        $date = getdate();
        $sql_query = "INSERT INTO data VALUES ('" . $this->config['LOCATION'] . "', " . $temperature . ", '" . $desc 
            . "', DATE '" . $date['year'] . "-" . $date['mon'] . "-" . $date['mday'] . "')";

        // Query the table
        $result = $connection->query($sql_query);

        // Close the connection
        $connection->close();

    }

}

$Weather = new Weather(parse_ini_file('config.ini'));
$Weather->getWeather();
