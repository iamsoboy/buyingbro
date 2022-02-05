<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <!--[if (gte mso 9)|(IE)]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ config('app.name') }} | {{$data->name}}</title>

    <!-- Google Fonts Link -->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet" />

    <style type="text/css">

        @import url(https://fonts.googleapis.com/css?family=PT+Sans:400,700);
        *, *:before, *:after {
            box-sizing: border-box;
            position: relative;
        }

        html {
            height: 100%;
            width: 100%;
            background: #ececec;
        }

        body {
            height: 100%;
            width: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .route {
            display: none;
        }

        .giftcard {
            height: 300px;
            width: 500px;
            font-family: PT Sans, sans-serif;
            overflow: hidden;
            border-radius: 1.5rem/2rem;
            box-shadow: 8px 10px 16px rgba(0, 0, 0, 0.1);
            transform: translateZ(0);
        }

        .giftcard-content, .giftcard-cover {
            position: absolute;
            top: 0;
            left: 0;
            height: calc(100% - 5rem);
            width: 100%;
        }

        .giftcard-cover {
            background: #cc199d;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2;
        }
        .giftcard-cover > .fa-apple {
            color: white;
            font-size: 6rem;
        }

        .giftcard-content {
            padding: 1rem 2rem;
            color: #939393;
            z-index: 1;
            background: white;
        }
        .giftcard-content > * {
            transform: translateX(3rem);
            opacity: 0;
        }
        .giftcard-content h2 {
            font-size: 1.2rem;
            text-transform: uppercase;
        }
        .giftcard-content h3 {
            font-size: 1rem;
            margin: 0;
            font-weight: normal;
        }
        .giftcard-content h2, .giftcard-content h3 {
            color: #232323;
        }
        .giftcard-content div {
            font-size: 1rem;
        }
        .giftcard-content address {
            font-style: normal;
            margin-bottom: 1rem;
        }
        .giftcard-content a, .giftcard-content .subtext {
            color: #939393;
        }
        .giftcard-content a {
            display: block;
            text-decoration: none;
        }

        .giftcard-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 5rem;
            width: 100%;
            background: white;
            z-index: 3;
            transform: translateZ(0);
        }
        .giftcard-footer > * {
            float: left;
        }

        .giftcard-text, .giftcard-info {
            width: calc(100% - 150px);
            padding: 1rem;
        }

        .giftcard-text {
            height: 100%;
            padding: 1rem;
        }
        .giftcard-text > h1, .giftcard-text > h2 {
            margin: 0;
            font-weight: normal;
            line-height: 1.1;
        }
        .giftcard-text h1 {
            font-size: 1.5rem;
            color: #cc199d;
        }
        .giftcard-text h2 {
            font-size: 1.2rem;
            color: #939393;
        }

        .giftcard-info {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            text-align: right;
            transform: translateX(100%);
            display: table;
            padding-left: 0;
            background: white;
        }
        .giftcard-info > * {
            display: table-cell;
        }
        .giftcard-info > *:first-child {
            padding-right: 1rem;
        }
        .giftcard-info input[type=text] {
            height: 50px;
            width: 100%;
            padding: 0 1rem;
            -webkit-appearance: none;
            background: transparent;
            border: 1px solid #dedede;
        }

        .button, input[type=text] {
            border-radius: 3px;
        }

        .button {
            display: inline-block;
            width: auto;
            height: 50px;
            line-height: 50px;
            text-align: center;
            background: orange;
            color: white;
            font-size: 1.3rem;
            padding-left: 1rem;
            padding-right: 1rem;
            text-decoration: none;
        }
        .button.secondary {
            background: #009cee;
        }

        .giftwrap {
            width: 150px;
            height: 150px;
        }
        .giftwrap .button {
            width: 100px;
            top: calc(50% - 25px);
            left: calc(50% - 50px);
        }
        .giftwrap:before, .giftwrap:after {
            display: none;
            content: "";
            position: absolute;
            height: 150px;
            width: 150px;
            top: 0;
            left: 0;
        }
        .giftwrap:before {
            clip-path: polygon(50% 0%, 50% 0%, 50% 0%, 100% 50%, 100% 50%, 100% 50%, 50% 100%, 50% 100%, 50% 100%, 0% 50%, 0% 50%, 0% 50%, 0% 50%, 50% 100%, 50% 100%, 100% 50%, 100% 50%, 50% 0%, 50% 0%);
            background: #fc1f33;
            z-index: 2;
        }
        .giftwrap:after {
            clip-path: polygon(50% 0%, 50% 0%, 100% 50%, 100% 50%, 50% 100%, 50% 100%, 0% 50%, 0% 50%);
            background: #bc0a13;
            z-index: -1;
        }

        .bow {
            display: none;
            opacity: 0;
            position: absolute;
            top: calc(47% - 0.625rem);
            left: calc(40% - 0.625rem);
            height: 1.25rem;
            width: 1.25rem;
            /* background: $ribbon-color-foreground; */
            background: #000;
            border-radius: 50%;
            z-index: 3;
        }
        .bow:after {
            content: "";
            display: block;
            position: absolute;
            height: 100%;
            width: 100%;
            border-radius: 50%;
            background: #fedf64;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }
        .bow > .fa-bookmark {
            position: absolute;
            top: 0.625rem;
            left: 0.3125rem;
            font-size: 1rem;
            color: #fed531;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
        .bow > .fa-bookmark:first-child {
            transform: translateX(-0.625rem) scaleY(1.5) rotate(55deg);
        }
        .bow > .fa-bookmark:last-child {
            transform: translateX(0.625rem) scaleY(1.5) rotate(-55deg);
        }

        .ribbon {
            width: 150px;
            height: 150px;
            top: calc(50% - 75px);
        }
        .ribbon:before, .ribbon:after {
            display: none;
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            top: 0;
            left: 0;
        }
        .ribbon:before {
            clip-path: polygon(35% 35%, 45% 35%, 45% 42%, 75% 42%, 75% 52%, 45% 52%, 45% 65%, 35% 65%, 35% 52%, 25% 52%, 25% 42%, 35% 42%);
            background: #db8b22;
            z-index: -1;
        }
        .ribbon:after {
            clip-path: polygon(35% 0%, 35% 0%, 45% 0%, 45% 0%, 100% 42%, 100% 42%, 100% 52%, 100% 52%, 45% 100%, 45% 100%, 35% 100%, 35% 100%, 0% 52%, 0% 52%, 0% 42%, 0% 42%, 35% 0%, 0% 42%, 0% 52%, 35% 100%, 45% 100%, 100% 52%, 100% 42%, 45% 0%);
            background: #fed531;
            z-index: 2;
        }

        #buy:target ~ .giftcard .giftwrap > .button {
            animation: button 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.65) forwards;
        }
        #buy:target ~ .giftcard .giftwrap:before, #buy:target ~ .giftcard .giftwrap:after {
            display: block;
        }
        #buy:target ~ .giftcard .giftwrap:before {
            animation: wrap-before-2 0.6s cubic-bezier(0.77, 0, 0.175, 1) both;
        }
        #buy:target ~ .giftcard .giftwrap:after {
            animation: wrap-after-2 0.6s cubic-bezier(0.77, 0, 0.175, 1) both;
        }
        #buy:target ~ .giftcard .bow {
            display: block;
            animation: bow 0.3s 0.72s cubic-bezier(0.175, 0.885, 0.32, 1.65) forwards;
        }
        #buy:target ~ .giftcard .ribbon:before, #buy:target ~ .giftcard .ribbon:after {
            display: block;
        }
        #buy:target ~ .giftcard .ribbon:before {
            animation: ribbon-before 0.6s 0.2s cubic-bezier(0.77, 0, 0.175, 1) both;
        }
        #buy:target ~ .giftcard .ribbon:after {
            animation: ribbon-after 0.6s 0.2s cubic-bezier(0.77, 0, 0.175, 1) both;
        }
        #buy:target ~ .giftcard .giftcard-footer {
            animation: footer 0.6s 0.72s cubic-bezier(0.77, 0, 0.175, 1) both;
        }
        #buy:target ~ .giftcard .giftcard-cover {
            animation: cover 0.6s 0.72s cubic-bezier(0.77, 0, 0.175, 1) both;
        }
        #buy:target ~ .giftcard .giftcard-content > * {
            animation: content 0.6s 0.72s cubic-bezier(0.77, 0, 0.175, 1) both;
        }
        #buy:target ~ .giftcard .giftcard-content > *:nth-child(1) {
            animation-delay: 0.72s;
        }
        #buy:target ~ .giftcard .giftcard-content > *:nth-child(2) {
            animation-delay: 0.77s;
        }
        #buy:target ~ .giftcard .giftcard-content > *:nth-child(3) {
            animation-delay: 0.82s;
        }

        @keyframes button {
            to {
                transform: scale(0.9);
            }
        }
        @keyframes content {
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes cover {
            to {
                transform: translateY(calc(100% - 1px)) scaleX(0.95);
            }
        }
        @keyframes footer {
            to {
                transform: translateX(calc(-100% + 150px));
            }
        }
        @keyframes wrap-before-2 {
            50% {
                clip-path: polygon(50% 0%, 50% 0%, 50% 0%, 100% 50%, 100% 50%, 100% 50%, 50% 100%, 50% 100%, 50% 100%, 0% 50%, 0% 50%, 0% 50%, 0% 50%, 50% 100%, 50% 100%, 100% 50%, 100% 50%, 50% 0%, 50% 0%);
            }
            100% {
                clip-path: polygon(18% 32%, 50% 64%, 82% 32%, 82% 32%, 64% 50%, 82% 68%, 82% 68%, 50% 36%, 18% 68%, 18% 68%, 36% 50%, 18% 32%, 18% 68%, 18% 68%, 82% 68%, 82% 68%, 82% 32%, 82% 32%, 18% 32%);
            }
        }
        @keyframes wrap-after-2 {
            0% {
                clip-path: polygon(50% 40%, 60% 50%, 50% 60%, 40% 50%);
            }
            49.999% {
                clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
            }
            50% {
                clip-path: polygon(50% 0%, 50% 0%, 100% 50%, 100% 50%, 50% 100%, 50% 100%, 0% 50%, 0% 50%);
            }
            100% {
                clip-path: polygon(18% 32%, 82% 32%, 82% 32%, 82% 68%, 82% 68%, 18% 68%, 18% 68%, 18% 32%);
            }
        }
        @keyframes ribbon-before {
            0% {
                clip-path: polygon(35% 37%, 45% 37%, 45% 42%, 77% 42%, 77% 52%, 45% 52%, 45% 63%, 35% 63%, 35% 52%, 23% 52%, 23% 42%, 35% 42%);
            }
            50% {
                clip-path: polygon(35% 0%, 45% 0%, 45% 42%, 100% 42%, 100% 52%, 45% 52%, 45% 100%, 35% 100%, 35% 52%, 0% 52%, 0% 42%, 35% 42%);
            }
            100% {
                clip-path: polygon(35% 32%, 45% 32%, 45% 42%, 82% 42%, 82% 52%, 45% 52%, 45% 68%, 35% 68%, 35% 52%, 18% 52%, 18% 42%, 35% 42%);
            }
        }
        @keyframes ribbon-after {
            0%, 50% {
                clip-path: polygon(35% 0%, 35% 0%, 45% 0%, 45% 0%, 100% 42%, 100% 42%, 100% 52%, 100% 52%, 45% 100%, 45% 100%, 35% 100%, 35% 100%, 0% 52%, 0% 52%, 0% 42%, 0% 42%, 35% 0%, 0% 42%, 0% 52%, 35% 100%, 45% 100%, 100% 52%, 100% 42%, 45% 0%);
            }
            100% {
                clip-path: polygon(35% 57.1914893617%, 35% 32%, 45% 32%, 45% 57.1914893617%, 45.1% 42%, 82% 42%, 82% 52%, 45.1% 52%, 45% 50.2978723404%, 45% 68%, 35% 68%, 35% 50.2978723404%, 39.15% 52%, 18% 52%, 18% 42%, 39.15% 42%, 35% 57.1914893617%, 39.15% 42%, 39.15% 52%, 35% 50.2978723404%, 45% 50.2978723404%, 45.1% 52%, 45.1% 42%, 45% 57.1914893617%);
            }
        }
        @keyframes bow {
            from {
                transform: scale(0.8);
                opacity: 1;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

    </style>

</head>


<body>

<div class="route" id="buy"></div>
<section class="giftcard">
    <section class="giftcard-cover">
        <i class="fa fa-apple"></i>
    </section>
    <div class="giftcard-content">
        <h2>Your order delivered/shipped to:</h2>
        <address>
            <h3>{{$person->billing_name}}</h3>
            <a href="#" target="_blank">{{$person->billing_email}}</a>
            <a href="#" target="_blank">{{$person->billing_phone}}</a>
        </address>
        <div class="subtext">Available for use instantly <br>
            <small class="text-muted">Serial No.: {{$data->serial_no}}</small>
        </div>
    </div>
    <footer class="giftcard-footer">
        <div class="giftcard-text">
            <h1>{{$data->name}}</h1>
            <h2>$ {{number_format($data->value, 2, '.', ',')}}</h2>
        </div>
        <div class="ribbon">
            <div class="giftwrap">
                <a href="#buy" class="button">View</a>
            </div>
            <div class="bow">
                <i class="fa fa-bookmark"></i>
                <i class="fa fa-bookmark"></i>
            </div>
        </div>
        <div class="giftcard-info">
            <div>
                <input type="text" name="" id="" value="{{$data->pin}}"  readonly/>
            </div>
            <div>
                <button class="button secondary">Close</button>
            </div>
        </div>
    </footer>
</section>


</body>
</html>
