<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Permanent Makeup University - Admin Forgot Password OTP</title>
    <style>

    </style>
</head>

<body>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600&display=swap" rel="stylesheet" />

    <body>
        <div class="email-template" style="background: #fbf8f3; padding: 10px;">
            <table align="center" cellpadding="0" cellspacing="0" width="600" style="background: #ffffff;font-family:Calibri, sans-serif; margin: 0 auto; background-size: 100%; padding: 10px 30px 0px 30px;">
                <tr>
                    <td style="font-family:tahoma, geneva, sans-serif;color:#29054a;font-size:12px; padding:10px;background: #ffffff;text-align: center;">
                        <a href="{{ route('signin') }}">
                            <img alt="not found" src="{{ isset(adminData()->business_logo) ? assets('uploads/logo/'.adminData()->business_logo) : assets('frontend/images/logo.png') }}" height="60">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style=" padding: 10px;" bgcolor="#ffffff">
                        <h1 style="font-size: 16px;font-weight: 600;line-height: 24px;text-align:justify;color: #767171; margin: 0; padding:0; text-transform: capitalize;">HELLO, {{ $customer_name ?? "User" }}!</h1>
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="padding:0 10px;">
                        <p style="font-size: 14px;font-weight: normal;line-height: 24px;text-align:justify;color: #767171; margin: 0; padding:0">We have received your request for changing the password please find the OTP below. If you have not initiated this request please contact <a href="mailto:universitypmo@gmail.com">universitypmo@gmail.com</a> for the same.</p>
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="padding:0 10px;">
                        <p style="font-size: 16px;font-weight: 600;line-height: 24px;text-align:justify;color: #767171; margin: 0; padding:0">{{ $otp ?? '0000' }}</p>
                    </td>
                </tr>
            </table>
            
        </div>
    </body>

</html>