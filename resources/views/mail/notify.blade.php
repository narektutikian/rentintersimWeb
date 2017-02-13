<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SimRent</title>
</head>
<body>

<div style="background: #ffffff; max-width: 600px; margin: 0 auto; padding: 0; font-size: 100%; font: inherit; vertical-align: baseline; border-collapse: collapse; border-spacing: 0;">
    <div style="width: 76px; height: 47px; padding: 20px 20px 25px 7px;">
        <img src="{{$message->embed(public_path() .'/img/mail_logo.png')}}" alt="Logo">
    </div>
    <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; background: #ffffff;  border-top: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; color: #1b6db2; line-height: 1; padding: 40px 10px 10px 10px; min-width: 300px; text-transform: uppercase; font-size: 16px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
        Status changed for order #{{$order->id}}
    </div>

    <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; background: #1b6db2; color: #ffffff; line-height: 1; padding: 14px 10px; min-width: 300px; border: 1px solid #d4e1ea; font-size: 16px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
        New status is "{{$order->status}}"
    </div>
    <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; padding: 17px 10px; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; min-width: 300px; "></div>
    <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; background: #079fff; color: #ffffff; line-height: 1; padding: 14px 10px; min-width: 300px; font-size: 16px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
        Order details
    </div>

    <div style="text-align: center;">

        <div style="font-size: 0; box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; ">
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 18px 10px 8px; color: #079fff; line-height: 1;  border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif; ">
                Number
            </div>
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; text-align: left; padding: 13px 10px 10px 8px; color: #494949; line-height: 1;   border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                {{(($order->phone != null) ? $order->phone->phone : 'no number')}}
            </div>
        </div>
        <div style="font-size: 0; box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; ">
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 18px 10px 8px; color: #079fff; line-height: 1;  border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                SIM
            </div>
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 10px 10px 8px; color: #494949; line-height: 1;  border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                {{$order->sim->number}}
            </div>
        </div>
        <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; font-size: 0;">
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 18px 10px 8px; color: #079fff; line-height: 1;  border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                From
            </div>
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 10px 10px 8px; color: #494949; line-height: 1;  border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                {{$order->landing}}
            </div>
        </div>
        <div style="font-size: 0; box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; ">
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 18px 10px 8px; color: #079fff; line-height: 1;  border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                to
            </div>
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 10px 10px 8px; color: #494949; line-height: 1;  border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                {{$order->departure}}
            </div>
        </div>
        @if($order->reference_number != null)
        <div style="font-size: 0; box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; ">
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 18px 10px 8px; color: #079fff; line-height: 1;  border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                Reference #
            </div>
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 10px 10px 8px; color: #494949; line-height: 1;  border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                {{$order->reference_number}}
            </div>
        </div>
        @endif
        <div style="font-size: 0; box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; ">
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 18px 10px 8px; color: #079fff; line-height: 1;  border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                Created by
            </div>
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 10px 10px 8px; color: #494949; line-height: 1;  border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                {{$order->creator->name}} at {{$order->created_at}}
            </div>
        </div>
        <div style="font-size: 0; box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box;">
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 18px 10px 8px; color: #079fff; line-height: 1; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                Updated by
            </div>
            <div style="box-sizing: border-box;-moz-box-sizing: border-box; -webkit-box-sizing: border-box; display:inline-block; vertical-align: middle; width: 300px; padding: 13px 10px 10px 8px; color: #494949; line-height: 1; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; text-align: left; font-size: 15px; font-weight: normal; font-style: normal; font-family: proxima_nova_rgregular, Arial, Helvetica, sans-serif;">
                {{($order->editor != null) ? $order->editor->name : $order->creator->name}} at {{$order->updated_at}}
            </div>
        </div>

    </div>
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