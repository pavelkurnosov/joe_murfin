<?php 
    function scrape($URL){
        //cURL options
        $options = Array(
                    CURLOPT_RETURNTRANSFER => TRUE, //return html data in string instead of printing it out on screen
                    CURLOPT_FOLLOWLOCATION => TRUE, //follow header('Location: location');
                    CURLOPT_CONNECTTIMEOUT => 60, //max time to try to connect to page
                    CURLOPT_HEADER => FALSE, //include header
                    CURLOPT_USERAGENT => "Mozilla/5.0 (X11; Linux x86_64; rv:21.0) Gecko/20100101 Firefox/21.0", //User Agent
                    CURLOPT_URL => $URL //SET THE URL
                    );

        $ch = curl_init($URL);//initialize a cURL session
        curl_setopt_array($ch, $options);//set the cURL options
        $data = curl_exec($ch);//execute cURL (the scraping)
        curl_close($ch);//close the cURL session

        return $data;
    }

    function parse(&$data, $query, &$dom){
        $Xpath = new DOMXpath($dom); //new Xpath object associated to the domDocument
        $result = $Xpath->query($query);//run the Xpath query through the HTML
        // var_dump($result);
        return $result;
    }

    /**
     * get information of videos as array from the site.
     */
    function scrapVideos ($siteURL) {
        $data = array();
        $siteURL = strtolower($siteURL);
        if (strpos($siteURL, 'wimp.com') >= 0) {
            $data = getInfoFromWimp($siteURL);
        } else if (strpos($siteURL, 'devour.com') >= 0) {
            $data = getInfoFromDevour($siteURL);
        } else {
            $data = array();
        }
        return $data;
    }

    function getInfoFromWimp($siteURL) {
        $dom = new DomDocument("1.0"); 
        $data = scrape($siteURL); //scrape the website
        @$dom->loadHTML($data);
        $nodes = parse($data, '//div[contains(@class, "latest-third")]', $dom);
        $info = array();
        foreach ($nodes as $key => $node) {
            $videoSite = file_get_contents('http://www.wimp.com' . $node->getElementsByTagName('a')->item(0)->getAttribute('href'));
            $ary = explode("' data-id='", $videoSite);
            if (isset($ary[1])) {
                $ary = explode("'></div>", $ary[1]);
                $videoURL = 'http://youtube.com/embed/' . $ary[0];
            } else {
                $ary = explode("<iframe class='stramable vembed embed-responsive-item' src='", $videoSite);
                if (isset($ary[1])) {
                    $ary = explode("' frameborder='0'", $ary[1]);
                    $videoURL = $ary[0];
                } else {
                    $videoURL = 'ERROR!';
                }
            }
            $info[] = array(
                'title' => $node->getElementsByTagName('a')->item(0)->getElementsByTagName('h2')->item(0)->nodeValue, 
                'description' => 'Description', 
                'video_url' => $videoURL, 
                'thumbnail' => $node->getElementsByTagName('a')->item(0)->getElementsByTagName('span')->item(0)->getElementsByTagName('img')->item(0)->getAttribute('data-src')
            );
        }
        return $info;
    }

    function getInfoFromDevour() {
        echo 'error!!!';exit;
    }
    

?>