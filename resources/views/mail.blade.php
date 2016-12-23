<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body style="background: #FAFAFA; color: #333333;">
    <center>
        <table border="0" cellpadding="20" cellspacing="0" height="100%" width="600" style="background: #ffffff; border: 1px solid #DDDDDD;">
            <tbody>
            <tr>
                <td style="background: #079fff; padding: 10px 10px;">
                    <div class="logo" height="60" width="60" style="display: inline-block; vertical-align: middle; margin-right: 25px;">
                        <a href="index.html" style="display: block;"><img src="{{$message->embed(public_path() .'/img/logo.jpg')}}" alt="Logo" style="display: block;"></a>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 10px;">
                    <img src="{{$message->embed(public_path() . '/img/print_image.jpg')}}" alt="" width="370" height="230" style="display: block; margin: 0 auto;">
                </td>
            </tr>
            <tr>
                <td style="padding: 10px 10px;">
                    <div style="height: 40px; line-height: 40px; padding: 0 15px; background: #079fff; color: #ffffff; font-size: 15px; font-weight: bold; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">{{$order->phone->phone}}</div>
                </td>
            </tr>
            <tr>
                <td style="padding: 3px 20px;">
                    <p>{{$text}}</p>
                </td>
            </tr>
            <tr>
                <td style="font-size: 0; padding: 10px 10px;">
                    <div class="email_dates" style="display: inline-block; vertical-align: middle; width: 48%;">
                        <div class="departure" height="30" style="height: 30px; line-height: 30px; background: #079fff; color: #ffffff; text-align: center; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                            From</div>

                        <div class="email_date_time" style="margin-top: 15px; color: #079fff; text-align: center; font-size: 15px; font-weight: normal; font-style: normal;">{{$order->landing}} </div>

                    </div>
                    <div class="email_dates" style="display: inline-block; vertical-align: middle; width: 48%; margin-left: 4%;">
                        <div class="departure" width="45%" height="30" style="height: 30px; line-height: 30px; background: #079fff; color: #ffffff; text-align: center; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;"> To</div>

                        <div class="email_date_time" style="margin-top: 15px; color: #079fff; text-align: center; font-size: 15px; font-weight: normal; font-style: normal;">{{$order->departure}}</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding: 3px 10px;">
                    <div style="height: 40px; line-height: 40px; padding: 0 15px; background: #079fff; color: #ffffff; font-size: 15px; font-weight: bold; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">Mail message: Order #{{$order->id}}</div>
                </td>
            </tr>
            <tr>
                <td>--
                    <br />Syc group</td>
            </tr>
            </tbody>
        </table>
    </center>
</body>
</html>