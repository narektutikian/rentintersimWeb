<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Activation Errors</title>
</head>
<body>

<div style="background: #ffffff; max-width: 600px; margin: 0 auto; padding: 0; font-size: 100%; font: inherit; vertical-align: baseline; border-collapse: collapse; border-spacing: 0;">
    <div style="width: 76px; height: 47px; padding: 20px 20px 25px 7px;">
        <img src="{{$message->embed(public_path() .'/img/mail_logo.png')}}" alt="Logo">
    </div>

    <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; background: #079fff; color: #ffffff; line-height: 1; padding: 14px 10px; min-width: 300px; font-size: 16px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
        The list of faild API calls
    </div>

    <table style="border-collapse:collapse;border-spacing:0;">
        <tr>
            <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">ID</th>
            <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">Phone</th>
            <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">SIM</th>
            <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">Call</th>
            <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">Answer</th>
            <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">Order ID</th>
            <th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">Data</th>
        </tr>
        @foreach($activations as $item)
        <tr>
            <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">{{$item->id}}</td>
            <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">{{$item->phone_number}}</td>
            <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">{{$item->sim_number}}</td>
            <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">{{$item->call}}</td>
            <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">{{$item->answer}}</td>
            <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">{{$item->order_id}}</td>
            <td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;">{{$item->updated_at->format('d/m/Y H:i')}}</td>
        </tr>
        @endforeach
    </table>
    <div style="border: 1px solid #DDDDDD;  min-width: 298px;">
        <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; color: #1b6db2; padding: 18px 10px 6px 10px; text-transform: uppercase; font-size: 17px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
            SYC GROUP
        </div>
        <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; padding: 2px 10px; color: #494949; line-height: 1; font-size: 16px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">Phone: +44 2031501573 Ext. 1</div>
        <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; padding: 2px 10px 10px 10px; color: #494949; line-height: 1; font-size: 16px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">Email: service@syc.co.il</div>
    </div>
</div>

</body>
</html>