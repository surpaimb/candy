<html>

    <body>
        <h1> Get Candy</h1>
        <h3>Trade Account Request</h3>

        <strong>Name</strong><br>
        {!! $data['contactName'] !!}<br><br>

        <strong>Business Name</strong><br>
        {!! $data['businessName'] !!}<br><br>

        <strong>Address</strong><br>
        {!! $data['businessAddress'] !!}<br>
        {!! $data['city'] !!}<br>
        {!! $data['county'] !!}<br>
        {!! $data['postCode'] !!}<br>


        <strong>Business Email</strong><br>
        {!! $data['businessEmail'] !!}<br><br>

        <strong>Website</strong><br>
        {!! $data['website'] !!}<br><br>

        <strong>Primary Contact No.</strong><br>
        {!! $data['primaryContact'] !!}<br><br>

        <strong>Mobile Contact No.</strong><br>
        {!! $data['mobileContact'] !!}<br><br>

        <strong>How many spas do you have on display?</strong><br>
        {!! $data['spasOnDisplay'] !!}<br><br>

        <strong>How long have you been trading?</strong><br>
        {!! $data['businessTradingLength'] !!}<br><br>

    </body>

</html>