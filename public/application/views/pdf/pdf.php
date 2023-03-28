<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pdf</title>
    <style>
    body {
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }

    .container {
        border: 3px solid #000;
        padding:5px;
    }
    </style>
</head>

<body>
    <div class="container">
        <table style="width:100%;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:70%;">
                        <h3 style="margin-bottom: 10px;color:#ffaa49;font-size:25px"><?php echo $info->trust ?></h3>
                        <h6 style="margin-top: 0;font-size:14px;font-weight: 200;">E601, Aishwarya Lakeview Apartments, 6th Cross,<br>
                            Kaggadasapura, Bengaluru - 560 093<br>
                            Email: saimerumathitrust@gmail.com</h6>
                    </td>
                    <td style="text-align:right;width:30%;"><img src="<?php echo $base_image; ?>" style="width:55%;" /></td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%;margin-top:15px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:50%;">
                        <h6 style="margin-top: 0;font-size:18px;font-weight: normal;"><strong>Sl No:</strong> <?php echo $info->id ?></h6>
                    </td>
                    <td style="text-align:right;width:50%;"><h6 style="margin-top: 0;font-size:18px;font-weight: normal;"><strong>Date:</strong> <?php echo date('d', strtotime($info->timestamp)); ?>-<?php echo date('M', strtotime($info->timestamp)); ?>-<?php echo date('Y', strtotime($info->timestamp)); ?></h6></td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%;margin-top:15px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:100%;">
                        <h6 style="margin-top: 0;font-size:18px;font-weight: normal;line-height:2;">Received with thanks from <span style="font-weight: 600;">Mr. <?php echo $info->fname ?> <?php echo $info->lname ?></span>, a sum of Rupees <span style="font-weight: 600;"><?php echo amtWord($info->amount); ?> Only</span>, vide reference  <span style="font-weight: 600;"><?php echo $info->payment_id ?></span>, towards <span style="font-weight: 600;">Various seva activities</span></h6>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%;margin-top:15px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:100%;">
                        <h6 style="margin-top: 0;font-size:18px;font-weight: normal;line-height:2;">With support from benevolent participants like you, our Trust is able to continue with
different Seva activities. We sincerely thank you for your continued support and
encouragement.</h6>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%;margin-top:15px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:100%;">
                        <h6 style="margin-top: 0;font-size:18px;font-weight: normal;"><strong>Amount:</strong> <span style="border-bottom:1px solid #000;font-weight: 500;text-align:center;">Rs. <?php echo $info->amount ?></span></h6>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%;margin-top:15px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:50%;">
                        <h6 style="margin-top: 0;font-size:20px;font-weight: 200;margin-bottom:0;"><strong style="border-bottom:1px solid #000;">Details of the Donor:</strong></h6>
                    </td>
                    <td style="text-align:center;width:50%;"><h6 style="margin-top: 0;font-size:20px;font-weight: 200;margin-bottom:0;"><strong style="border-bottom:1px solid #000;">For Sri Sai Meru Mathi Trust</strong></h6></td>
                </tr>
            </tbody>
        </table>
        <table style="width:100%;margin-top:5px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:50%;">
                        <h6 style="margin-top: 0;font-size:18px;font-weight: normal;">E-Mail: <?php echo $info->email ?><br>Mobile: <?php echo $info->phone ?></h6>
                    </td>
                    <td style="text-align:center;width:50%;"><img src="<?php echo $sign_image; ?>"style="width:50%;" /><br><h6 style="margin-top: 0;font-size:20px;font-weight: normal;"><strong>A V S S Prasad</strong><br>(Authorised Signatory)</h6></td>
                </tr>
            </tbody>
        </table>
        <?php if($info->trust=="Sai Mayee Trust"){ ?>
        <table style="width:100%;margin-top:5px;">
            <tbody style="width:100%;">
                <tr>
                    <td style="text-align:left;width:100%;">
                        <h6 style="margin-top: 0;font-size:12px;font-weight: normal;">Donations made are exempted under section 80G of the income tax act 1961, Vide Order No.: ITBA/Exm/S/80G/2020-21/1031997080(1)</h6>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php } ?>
    </div>
</body>

</html>