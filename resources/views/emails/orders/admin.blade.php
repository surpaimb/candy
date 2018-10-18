<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title></title>

  <style type="text/css">
    body {
      font-size: 13px;
      color: #333333;
    }

    a {
      text-decoration: none;
      color: #1790d5;
      border-bottom: 1px dotted #036ba5;
    }

    /* Header */

    .header .logo {
      border-bottom: 0;
    }

    /* Item Rows */

    .item-rows tr td {
      padding-top: 5px;
      padding-bottom: 5px;
      border-bottom: 1px solid #d4ebf6;
    }

    /* Order Totals */

    .order-totals tr td p {
      margin-top: 5px;
      margin-bottom: 5px;
    }

    /* External Links */

    .external-links a {
      margin-left: 5px;
      margin-right: 5px;
      border-bottom: 0;
    }

    /* Disclaimer */

    .disclaimer tr td {
      color: #5f99b3;
    }

    .disclaimer tr td strong {
      color: #3e7c98;
    }

  </style>
</head>
<body style="margin:0; padding:0; background-color:#e4f6fe; font-family: Tahoma, Geneva, sans-serif;">
  <center>
    <table style="border-top: 5px solid #006ca2;" width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#1790d5">
      <tr>
        <td>
          <!--[if (gte mso 9)|(IE)]>
          <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
          <tr>
          <td align="center" valign="top" width="600">
          <![endif]-->
          <table class="header" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
            <tr>
              <td align="center" valign="top" style="font-size:13px;">
                <!-- Header -->
                <table align="center" border="0" cellpadding="15" cellspacing="0" width="100%" style="font-family: Tahoma, Geneva, sans-serif;">
                  <tr>
                    <td align="left"><a href="http://getcandy.io" class="logo"><img src="{{ url('img/-logo.png') }}" alt=" Get Candy" width="138" height="60"><a></td>
                    <td align="right" style="font-size: 16px; color: white;">Have an enquiry?<br> Call <strong>01234 567890</strong></td>
                  </tr>
                </table>
                <!-- END Header -->
              </td>
            </tr>
          </table>
          <!--[if (gte mso 9)|(IE)]>
          </td>
          </tr>
          </table>
          <![endif]-->
        </td>
      </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" height="100%" valign="top" width="100%">
          <!--[if (gte mso 9)|(IE)]>
          <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
          <tr>
          <td align="center" valign="top" width="600">
          <![endif]-->
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;" bgcolor="#e4f6fe">
              <tr>
                <td height="10" style="font-size:10px; line-height:15px;">&nbsp;</td>
              </tr>
              <tr>
                <td>
                  <!-- Order No. Details -->
                  <table align="center" border="0" cellpadding="15" cellspacing="0" width="100%" bgcolor="#FFFFFF" style="font-family: Tahoma, Geneva, sans-serif; border-left: 1px solid #d4f0fc; border-right: 1px solid #d4f0fc; border-bottom: 4px solid #d4f0fc;">
                    <tr>
                      <td align="left">
                        <p>A new order has been placed</p>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" style="padding-top: 0; font-size: 16px;">
                        <p style="margin-top: 0;">Order no.:<br><strong style="font-size: 26px; color: #1790d5;">{{ $order['reference'] }}</strong></p>
                      </td>
                    </tr>
                  </table>
                  <!-- Order No. Details -->
                </td>
              </tr>
              <tr>
                <td height="10" style="font-size:10px; line-height:15px;">&nbsp;</td>
              </tr>
              <tr>
                <td>

                  <table align="center" border="0" cellpadding="15" cellspacing="0" width="100%" bgcolor="#FFFFFF" style="font-family: Tahoma, Geneva, sans-serif; border-left: 1px solid #d4f0fc; border-right: 1px solid #d4f0fc; border-bottom: 4px solid #d4f0fc;">
                    <tr>
                      <td>
                        <table style="padding-bottom: 15px; font-family: Tahoma, Geneva, sans-serif; border-bottom: 1px solid #d4ebf6;" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr>
                            <!-- Shipping Information -->
                            <td align="left">
                              <p style="color: #026aa5;"><strong>Shipping Information</strong></p>
                              <p>{{ $order['shipping']['firstname']}}<br>
                              {{ $order['shipping']['address']}}<br>
                              @if($order['shipping']['address_two'])
                                {{ $order['shipping']['address_two']}},<br>
                              @endif
                              {{ $order['shipping']['city'] }},<br>
                              {{ $order['shipping']['country'] }}, {{ $order['shipping']['zip'] }}</p>
                            </td>
                            <!-- END Shipping Information -->
                            <!-- Billing Information -->
                            <td align="left">
                              <p style="color: #026aa5;"><strong>Billing Information</strong></p>
                              <p>{{ $order['billing']['firstname']}}<br>
                              {{ $order['billing']['address']}}<br>
                              @if($order['billing']['address_two'])
                                {{ $order['billing']['address_two']}},<br>
                              @endif
                              {{ $order['billing']['city'] }},<br>
                              {{ $order['billing']['country'] }}, {{ $order['billing']['zip'] }}</p>
                            </td>
                            <!-- END Billing Information -->
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top: 0;">
                        <table style="font-family: Tahoma, Geneva, sans-serif;" class="item-rows" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                          @foreach($order['lines']['data'] as $line)
                            <tr>
                              <td align="left">{{ $line['product'] }} x {{ $line['quantity'] }}</td>
                              <td align="right" width="100">
                                @if($order['currency'] == 'GBP')
                                  &pound;
                                @else
                                  &euro;
                                @endif
                                {{ $line['total'] }}
                              </td>
                            </tr>
                          @endforeach
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <!-- Order Totals -->
                        <table style="font-family: Tahoma, Geneva, sans-serif; font-size: 14px;" class="order-totals" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr>
                            <td align="right">
                              <p>Sub total</p>
                            </td>
                            <td align="right" width="100">
                                @if($order['currency'] == 'GBP')
                                  &pound;
                                @else
                                  &euro;
                                @endif
                                {{ number_format($order['total'], 2) }}
                            </td>
                          </tr>
                          <tr>
                            <td align="right">
                              <p>Delivery</p>
                            </td>
                            <td align="right" width="100">
                                @if($order['currency'] == 'GBP')
                                  &pound;
                                @else
                                  &euro;
                                @endif
                              {{ number_format($order['shipping_total'], 2) }}
                            </td>
                          </tr>
                          <tr>
                            <td align="right">
                              <p>VAT</p>
                            </td>
                            <td align="right" width="100">
                              @if($order['currency'] == 'GBP')
                                &pound;
                              @else
                                &euro;
                              @endif
                              {{ number_format($order['vat'], 2) }}
                            </td>
                          </tr>
                          <tr style="font-size: 16px; font-weight: 700; color: #a50294;">
                            <td align="right">
                              <p>Total (inc. VAT)</p>
                            </td>
                            <td align="right" width="100">
                                @if($order['currency'] == 'GBP')
                                  &pound;
                                @else
                                  &euro;
                                @endif
                                {{ number_format($order['total'], 2) }}
                            </td>
                          </tr>
                        </table>
                        <!-- END Order Totals -->
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="10" style="font-size:10px; line-height:15px;">&nbsp;</td>
              </tr>
              <tr>
                <td height="10" style="font-size:10px; line-height:15px;">&nbsp;</td>
              </tr>
              <tr>
                <td>
                </td>
              </tr>
              <tr>
                <td height="30" style="font-size:10px; line-height:15px;">&nbsp;</td>
              </tr>
            </table>
          <!--[if (gte mso 9)|(IE)]>
          </td>
          </tr>
          </table>
          <![endif]-->
        </td>
      </tr>
    </table>
  </center>
</body>
</html>
