<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,700,700i|Merriweather:300,300i,400,400i,700,700i" rel="stylesheet">
        <style>
            @keyframes animatedBackground {
                from { background-position: 0 0; }
                to { background-position: 0 -364px; }
            }
            body {
                font-family: "Cabin", sans-serif;
                color: #7bc6f1;
                background-color: #1790d5;
                background-position: 0px 0px;
                background-size: 100%;
                background-repeat: repeat-y;
                    -webkit-animation: animatedBackground 20s linear infinite;
                    animation: animatedBackground 20s linear infinite;
            }
            h1 {
                color: #fff;
                margin: 0;
            }
            p {
                margin-top: 5px;
            }
            .container {
                text-align: center;
                padding: 100px 0;
            }
            .big-text {
                font-size: 100px;
                margin-top: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="big-text">500</div>
            <h1>Something went wrong</h1>
            <p>
                We are experiancing an internal server issue<br>
                Please try again later
            </p>
        </div>
    </body>
</html>