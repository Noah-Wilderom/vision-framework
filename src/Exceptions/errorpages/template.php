<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('app.name') ?></title>
    <style>
        body {
            background: darkblue;
            text-align: center;
        }

        span {
            font-size: 25px;
            display: flex;

        }

        p {
            font-size: 15px;
            color: white;
        }

        #root {
            margin-top: 20%;
        }
    </style>
</head>

<body>
    <div id="root">
        <span>
            <?php
            echo $error['code']
            ?>
        </span>

        <p>
            <?php
            echo $error['message']
            ?>
        </p>
    </div>

</body>

</html>