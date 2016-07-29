# Review System

**API Release**

	You can get access token by calling the api in following way

**Get Access Token:**

...
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://www.domain.com/api/authorize");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_USERPWD, "Api key:Api Secret");

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);
...

> **Note:** $result contains the result in json format like this
>{"access_token":"Yourtoken","expires_in":3600,"token_type":"Bearer","scope":null}

**Order API**
	You can use order API by using following example codes

**GET Order API:**

...
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "http://www.domain.com/api/order");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer Yourtoken'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch); 
...

> **Note:** $result contains the result in json format like this
>[{"id":"1","userId":"1","creationTime":"2016-07-29 04:49:24","status":"1","reviewPage":null,"reviewPageStatus":null},{"id":"2","userId":"1","creationTime":"2016-07-29 03:16:23","status":"1","reviewPage":null,"reviewPageStatus":null}]
> You can also do following
> - You can pass order id to get specific order like curl_setopt($ch, CURLOPT_URL, "http://www.domain.com/api/order?id=1");
> - You can also pass limit to get records for pagination like curl_setopt($ch, CURLOPT_URL, "http://www.domain.com/api/order?startIdx=0&endIdx=5");

**ADD Order API:**

...
    $ch = curl_init();
    $post_data = array(
            'id' => 15
        );
    curl_setopt($ch, CURLOPT_URL, "http://www.domain.com/api/order");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer Yourtoken'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_POST, 1);
    $result = curl_exec($ch);
...

> **Note:** $result contains the result in json format like this
> {"link":"http:\/\/localhost\/review\/feedback?id=aa0af67f2a430494073e224d21d22cd4"}

**DELETE Order API:**

...
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://www.domain.com/review/api/order");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer Yourtoken'));


    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_POST, 1);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);
...

> **Note:** $result contains the result in json format.
