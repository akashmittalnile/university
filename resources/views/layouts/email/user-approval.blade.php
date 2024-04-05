<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{config('constant.siteTitle')}}</title>
    <style>

    </style>
</head>

<body>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet" />
    <div class="email-template" style="background: #fbf8f3; padding: 10px;">
        <table align="center" cellpadding="0" cellspacing="0" width="600" style="background: #ffffff;font-family:Calibri, sans-serif; margin: 0 auto; background-size: 100%; padding: 10px 30px 0px 30px;">
            <tr>
                <td style="font-family:tahoma, geneva, sans-serif;color:#29054a;font-size:12px; padding:10px;background: #ffffff;text-align: center;">
                    <a href="{{ URL::to('/') }}" title="{{config('constant.siteTitle')}}">
                        <img alt="{{config('constant.siteTitle')}} Logo" src="{{ isset(adminData()->business_logo) ? assets('uploads/logo/'.adminData()->business_logo) : assets('frontend/images/logo.png') }}" height="60">
                    </a>
                </td>
            </tr>
            <tr>
                <td style=" padding: 10px;" bgcolor="#ffffff">
                    <h1 style="color: #fc4a26bf;font-size: 20px;text-align: center;font-weight: normal; margin: 10px 0 0 0; padding:0;">{{config('constant.siteTitle')}} Account Approval!</h1>
                </td>
            </tr>
            <tr>
                <td valign="top" style="padding: 0 10px">
                    <p style="font-size:16px;font-weight: 600; text-align:center;line-height: 24px;color: #767171;margin: 0 0 10px 0;">Dear {{ $name ?? 'User' }}</p>
                    @if($status == 1)
                    <p style="font-size:16px;font-weight: 600; text-align:center;line-height: 24px;color: #767171;margin: 0 0 10px 0;">Your account was approved by administrator</p>
                    @else
                    <p style="font-size:16px;font-weight: 600; text-align:center;line-height: 24px;color: #767171;margin: 0 0 10px 0;">Your account is rejected. Maybe some information is incomplete or the Administrator wants you to improve.</p>
                    @endif
                </td>
            </tr>

            <tr>
                <td valign="top" style="padding: 0 10px">
                    <p style="font-size: 14px;font-weight: normal;line-height: 24px;text-align:justify;color: #767171;margin:0; padding: 0">For any questions, please email us at <a href="mailto:{{config('constant.customerServiceEmail')}}" style="color: #0000ee;">{{config('constant.customerServiceEmail')}}</a> or call us at +1 {{config('constant.customerServicePhone')}}. We’ll be glad to help you!</p>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>