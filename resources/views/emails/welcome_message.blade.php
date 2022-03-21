<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <!--[if (gte mso 9)|(IE)]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
    <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS -->
    <meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS -->
    <meta name="format-detection" content="address=no"> <!-- disable auto address linking in iOS -->
    <meta name="format-detection" content="email=no"> <!-- disable auto email linking in iOS -->
    <meta name="author" content="Simple-Pleb.com">
    <title>{{ __('pleb.mail.Welcome Title') }} | {{ config('app.name') }}</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <style type="text/css">
        /*Basics*/
        body {
            margin: 0px !important;
            padding: 0px !important;
            display: block !important;
            min-width: 100% !important;
            width: 100% !important;
            -webkit-text-size-adjust: none;
        }

        table {
            border-spacing: 0;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        table td {
            border-collapse: collapse;
            mso-line-height-rule: exactly;
        }

        td img {
            -ms-interpolation-mode: bicubic;
            width: auto;
            max-width: auto;
            height: auto;
            margin: auto;
            display: block !important;
            border: 0px;
        }

        td p {
            margin: 0;
            padding: 0;
        }

        td div {
            margin: 0;
            padding: 0;
        }

        td a {
            text-decoration: none;
            color: inherit;
        }

        /*Outlook*/
        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: inherit;
        }

        .ReadMsgBody {
            width: 100%;
            background-color: #ffffff;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /*Gmail blue links*/
        u+#body a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
        }

        /*Buttons fix*/
        .undoreset a,
        .undoreset a:hover {
            text-decoration: none !important;
        }

        .yshortcuts a {
            border-bottom: none !important;
        }

        .ios-footer a {
            color: #aaaaaa !important;
            text-decoration: none;
        }

        /*Responsive*/
        @media screen and (max-width: 799px) {
            table.row {
                width: 100% !important;
                max-width: 100% !important;
            }

            td.row {
                width: 100% !important;
                max-width: 100% !important;
            }

            .img-responsive img {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                margin: auto;
            }

            .center-float {
                float: none !important;
                margin: auto !important;
            }

            .center-text {
                text-align: center !important;
            }

            .container-padding {
                width: 100% !important;
                padding-left: 15px !important;
                padding-right: 15px !important;
            }

            .container-padding10 {
                width: 100% !important;
                padding-left: 10px !important;
                padding-right: 10px !important;
            }

            .hide-mobile {
                display: none !important;
            }

            .menu-container {
                text-align: center !important;
            }

            .autoheight {
                height: auto !important;
            }

            .m-padding-10 {
                margin: 10px 0 !important;
            }

            .m-padding-15 {
                margin: 15px 0 !important;
            }

            .m-padding-20 {
                margin: 20px 0 !important;
            }

            .m-padding-30 {
                margin: 30px 0 !important;
            }

            .m-padding-40 {
                margin: 40px 0 !important;
            }

            .m-padding-50 {
                margin: 50px 0 !important;
            }

            .m-padding-60 {
                margin: 60px 0 !important;
            }

            .m-padding-top10 {
                margin: 30px 0 0 0 !important;
            }

            .m-padding-top15 {
                margin: 15px 0 0 0 !important;
            }

            .m-padding-top20 {
                margin: 20px 0 0 0 !important;
            }

            .m-padding-top30 {
                margin: 30px 0 0 0 !important;
            }

            .m-padding-top40 {
                margin: 40px 0 0 0 !important;
            }

            .m-padding-top50 {
                margin: 50px 0 0 0 !important;
            }

            .m-padding-top60 {
                margin: 60px 0 0 0 !important;
            }

            .m-height10 {
                font-size: 10px !important;
                line-height: 10px !important;
                height: 10px !important;
            }

            .m-height15 {
                font-size: 15px !important;
                line-height: 15px !important;
                height: 15px !important;
            }

            .m-height20 {
                font-size: 20px !important;
                line-height: 20px !important;
                height: 20px !important;
            }

            .m-height25 {
                font-size: 25px !important;
                line-height: 25px !important;
                height: 25px !important;
            }

            .m-height30 {
                font-size: 30px !important;
                line-height: 30px !important;
                height: 30px !important;
            }

            .rwd-on-mobile {
                display: inline-block !important;
                padding: 5px;
            }

            .center-on-mobile {
                text-align: center !important;
            }
        }

    </style>

</head>

<body
    style="margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0; width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;"
    bgcolor="#f0f0f0">

    <span class="preheader-text"
        style="color: transparent; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; visibility: hidden; width: 0; display: none; mso-hide: all;"></span>

    <div
        style="display:none; font-size:0px; line-height:0px; max-height:0px; max-width:0px; opacity:0; overflow:hidden; visibility:hidden; mso-hide:all;">
    </div>

    <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="width:100%;max-width:100%;">
        <tr>
            <!-- Outer Table -->
            <td align="center" bgcolor="#f0f0f0" data-composer>

                <table width="673" cellpadding="0" cellspacing="0" border="0"
                    class="m_6406936670111343998wrapper m_6406936670111343998wrapper-banner">
                    <tbody>
                        <tr>
                            <td>
                                <img src="https://iili.io/GusgTb.md.png" alt="banner"
                                    style="width:673px;max-width:673px;height:94.9333px;max-height:94.9333px;display:block"
                                    class="m_6406936670111343998wrapper-img CToWUd" align="absbottom" width="673"
                                    height="94.9333">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" width="100%"
                    style="width:100%;max-width:100%;" bgcolor="#FFFFFF">
                    <tbody>
                        <tr>
                            <td height="30" style="font-size:30px;line-height:30px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">

                                <table width="580" cellpadding="0" cellspacing="0" border="0"
                                    class="m_6406936670111343998container">
                                    <tbody>
                                        <tr>
                                            <td align="left" valign="top" class="m_6406936670111343998main-content"
                                                style="font-size:normal">

                                                <p
                                                    style="font-family:Helvetica,Arial,sans-serif;font-weight:bold;font-size:18px;line-height:1.6;margin:0 0 10px;padding:0">
                                                    {{ __('pleb.mail.Welcome') }} {{ $user_name }},
                                                </p>

                                                <p
                                                    style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;line-height:1.6;margin:0 0 10px;padding:0">
                                                    {{ __('pleb.mail.Welcome Paragraph One') }}
                                                </p>
                                                <p
                                                    style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;line-height:1.6;margin:0 0 10px;padding:0">
                                                    <strong>{{ __('pleb.mail.Welcome data desc') }}</strong>
                                                </p>
                                                <div
                                                    style="color:#303030!important;background-color:transparent!important;box-sizing:border-box;min-height:.01%;overflow-x:auto">
                                                    <table
                                                        style="border-spacing:0;border-collapse:collapse!important;color:#303030!important;background-color:transparent!important;box-sizing:border-box;width:100%;max-width:100%;margin-bottom:20px"
                                                        bgcolor="transparent !important">
                                                        <tbody
                                                            style="color:#303030!important;background-color:transparent!important;box-sizing:border-box">
                                                            <tr style="color:#303030!important;background-color:transparent!important;page-break-inside:avoid;box-sizing:border-box"
                                                                bgcolor="transparent !important">
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ __('pleb.mail.KTA') }}
                                                                </td>
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:bold;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ $user_kta }}
                                                                </td>
                                                            </tr>
                                                            <tr style="color:#303030!important;background-color:transparent!important;page-break-inside:avoid;box-sizing:border-box"
                                                                bgcolor="transparent !important">
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ __('pleb.mail.Name') }}
                                                                </td>
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:bold;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ $user_name }}
                                                                </td>
                                                            </tr>
                                                            <tr style="color:#303030!important;background-color:transparent!important;page-break-inside:avoid;box-sizing:border-box"
                                                                bgcolor="transparent !important">
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ __('pleb.mail.Email') }}
                                                                </td>
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:bold;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ $email }}
                                                                </td>
                                                            </tr>
                                                            <tr style="color:#303030!important;background-color:transparent!important;page-break-inside:avoid;box-sizing:border-box"
                                                                bgcolor="transparent !important">
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ __('pleb.mail.Phone') }}
                                                                </td>
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:bold;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ $user_phone }}
                                                                </td>
                                                            </tr>
                                                            <tr style="color:#303030!important;background-color:transparent!important;page-break-inside:avoid;box-sizing:border-box"
                                                                bgcolor="transparent !important">
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ __('pleb.mail.Username') }}
                                                                </td>
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:bold;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ $username }}
                                                                </td>
                                                            </tr>
                                                            <tr style="color:#303030!important;background-color:transparent!important;page-break-inside:avoid;box-sizing:border-box"
                                                                bgcolor="transparent !important">
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ __('pleb.mail.Password') }}
                                                                </td>
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:bold;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ $password }}
                                                                </td>
                                                            </tr>
                                                            <tr style="color:#303030!important;background-color:transparent!important;page-break-inside:avoid;box-sizing:border-box"
                                                                bgcolor="transparent !important">
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ __('pleb.mail.Time') }}
                                                                </td>
                                                                <td style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;color:#303030;background-color:#fff!important;box-sizing:border-box;line-height:1.42857143;vertical-align:top;border-top-color:#ddd;border-top-width:1px;border-top-style:solid;padding:8px"
                                                                    bgcolor="#fff !important" valign="top">
                                                                    {{ $created_at }}
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <p
                                                    style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;line-height:1.6;margin:0 0 10px;padding:0">
                                                    <b>{{ __('pleb.mail.Paragraph Important') }}</b> <br>
                                                    {{ __('pleb.mail.End Paragraph One') }}
                                                    <br> <br>
                                                </p>
                                                <p
                                                    style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;line-height:1.6;margin:0 0 10px;padding:0">
                                                    {{ __('pleb.mail.Thanks') }}
                                                </p>
                                                <p
                                                    style="font-family:Helvetica,Arial,sans-serif;font-weight:normal;font-size:16px;line-height:1.6;margin:0 0 10px;padding:0">
                                                    {{ config('app.name') }}
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation"
                                    width="100%" style="width:100%;max-width:100%;">
                                    <!-- lotus-header-1 -->
                                    <tr>
                                        <td align="center" bgcolor="#FFFFFF" class="container-padding">

                                            <!-- Content -->
                                            <table border="0" align="center" cellpadding="0" cellspacing="0"
                                                role="presentation" class="row" width="580"
                                                style="width:580px;max-width:580px;">

                                                <tr>
                                                    <td height="20" style="font-size:20px;line-height:20px;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <!-- Login Button -->
                                                        <table border="0" cellspacing="0" cellpadding="0"
                                                            role="presentation" align="center" class="center-float">
                                                            <tr>
                                                                <td align="center" bgcolor="#008E89"
                                                                    style="border-radius: 6px;">
                                                                    <a href="{{ config('pleb.mail.welcome_url') }}"
                                                                        target="_blank"
                                                                        style="font-family:'Roboto Slab',Arial,Helvetica,sans-serif;font-size:16px;line-height:19px;font-weight:700;font-style:normal;color:#FFFFFF;text-decoration:none;letter-spacing:0px;padding: 20px 50px 20px 50px;display: inline-block;"><span>{{ __('pleb.mail.action_button') }}</span></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <!-- Login Button -->
                                                    </td>
                                                </tr>
                                            </table>
                                            <!-- Content -->

                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                        <tr>
                            <td height="50" style="font-size:50px;line-height:50px">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>

                <table width="640" cellpadding="0" cellspacing="0" border="0" class="m_-2653421054137265594wrapper"
                    bgcolor="#008E89">
                    <tbody>
                        <tr>
                            <td height="10" style="font-size:10px;line-height:10px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">

                                <table width="600" cellpadding="0" cellspacing="0" border="0"
                                    class="m_-2653421054137265594container">
                                    <tbody>
                                        <tr>
                                            <td align="center" valign="top">
                                                <div class="m_-2653421054137265594footer"
                                                    style="padding-top:30px;color:#ffffff">
                                                    <p><strong
                                                            style="font-size:16px;line-height:1.6">{{ __('pleb.mail.find us') }}</strong>
                                                    </p>
                                                </div>
                                                <div style="padding-bottom:20px">
                                                    <table border="0" align="center" cellpadding="0" cellspacing="0"
                                                        role="presentation">
                                                        <tr>
                                                            <td class="rwd-on-mobile" align="center" valign="middle"
                                                                height="36" style="height: 36px;">
                                                                @if( config('pleb.mail.instagram_url') != '')
                                                                <table border="0" align="center" cellpadding="0"
                                                                    cellspacing="0" role="presentation">
                                                                    <tr>
                                                                        <td width="10"></td>
                                                                        <td align="center">
                                                                            <a
                                                                                href="{{ config('pleb.mail.facebook_url') }}"><img
                                                                                    style="width:36px;border:0px;display: inline!important;"
                                                                                    src="https://iili.io/GAnezG.md.png"
                                                                                    width="36" border="0"
                                                                                    alt="icon"></a>
                                                                        </td>
                                                                        <td width="10"></td>
                                                                    </tr>
                                                                </table>
                                                                @endif
                                                            </td>
                                                            <td class="rwd-on-mobile" align="center" valign="middle"
                                                                height="36" style="height: 36px;">
                                                                @if( config('pleb.mail.instagram_url') != '')
                                                                <table border="0" align="center" cellpadding="0"
                                                                    cellspacing="0" role="presentation">
                                                                    <tr>
                                                                        <td width="10"></td>
                                                                        <td align="center">
                                                                            <a
                                                                                href="{{ config('pleb.mail.instagram_url') }}"><img
                                                                                    style="width:36px;border:0px;display: inline!important;"
                                                                                    src="https://iili.io/GAnj5X.md.png"
                                                                                    width="36" border="0"
                                                                                    alt="icon"></a>
                                                                        </td>
                                                                        <td width="10"></td>
                                                                    </tr>
                                                                </table>
                                                                @endif
                                                            </td>
                                                            <td class="rwd-on-mobile" align="center" valign="middle"
                                                                height="36" style="height: 36px;">
                                                                @if( config('pleb.mail.twitter_url') != '')
                                                                <table border="0" align="center" cellpadding="0"
                                                                    cellspacing="0" role="presentation">
                                                                    <tr>
                                                                        <td width="10"></td>
                                                                        <td align="center">
                                                                            <a
                                                                                href="{{ config('pleb.mail.twitter_url') }}"><img
                                                                                    style="width:36px;border:0px;display: inline!important;"
                                                                                    src="https://iili.io/GAnNbs.md.png"
                                                                                    width="36" border="0"
                                                                                    alt="icon"></a>
                                                                        </td>
                                                                        <td width="10"></td>
                                                                    </tr>
                                                                </table>
                                                                @endif
                                                            </td>
                                                            <td class="rwd-on-mobile" align="center" valign="middle"
                                                                height="36" style="height: 36px;">
                                                                @if( config('pleb.mail.youtube_url') != '')
                                                                <table border="0" align="center" cellpadding="0"
                                                                    cellspacing="0" role="presentation">
                                                                    <tr>
                                                                        <td width="10"></td>
                                                                        <td align="center">
                                                                            <a
                                                                                href="{{ config('pleb.mail.youtube_url') }}"><img
                                                                                    style="width:36px;border:0px;display: inline!important;"
                                                                                    src="https://iili.io/GAnwen.md.png"
                                                                                    width="36" border="0"
                                                                                    alt="icon"></a>
                                                                        </td>
                                                                        <td width="10"></td>
                                                                    </tr>
                                                                </table>
                                                                @endif
                                                            </td>
                                                            @if( config('pleb.mail.pinterest_url') != '')
                                                            <td class="rwd-on-mobile" align="center" valign="middle"
                                                                height="36" style="height: 36px;">
                                                                <table border="0" align="center" cellpadding="0"
                                                                    cellspacing="0" role="presentation">
                                                                    <tr>
                                                                        <td width="10"></td>
                                                                        <td align="center">
                                                                            <a
                                                                                href="{{ config('pleb.mail.pinterest_url') }}"><img
                                                                                    style="width:36px;border:0px;display: inline!important;"
                                                                                    src="{{ asset('assets/img/emails/Pinterest.png') }}"
                                                                                    width="36" border="0"
                                                                                    alt="icon"></a>
                                                                        </td>
                                                                        <td width="10"></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            @endif
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="m_-2653421054137265594footer" style="color:#ffffff">
                                                    <p>{{ __('pleb.mail.address') }}</p>
                                                    <p><strong>Copyright &copy;
                                                            <script>
                                                                var CurrentYear = new Date().getFullYear()
                                                                document.write(CurrentYear)

                                                            </script>
                                                            {{ config('app.name') }}</strong></p>
                                                </div>
                                                <div class="m_-2653421054137265594footer"
                                                    style="padding:40px 40px 40px;color:#ffffff">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                        </tr>
                        <tr>
                            <td height="10" style="font-size:10px;line-height:10px">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr><!-- Outer-Table -->
    </table>

</body>

</html>
