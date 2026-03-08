<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - JKB Festival</title>
    <style>
        /* CSS Reset untuk Klien Email */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; }
        img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; }
        a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; }
    </style>
</head>
<body style="background-color: #411041; margin: 0; padding: 0;">

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #411041; background-image: linear-gradient(135deg, #411041 0%, #2a082c 100%);">
    <tr>
        <td align="center" style="padding: 40px 10px 40px 10px;">
            
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                
                <tr>
                    <td align="center" style="padding: 40px 20px 20px 20px; background-color: #ffffff;">
                        <h1 style="margin: 0; color: #b71c77; font-size: 28px; font-weight: bold; letter-spacing: 1px;">
                            JKB <span style="color: #411041;">FESTIVAL</span>
                        </h1>
                    </td>
                </tr>

                <tr>
                    <td align="center" style="padding: 20px 40px 20px 40px; color: #333333; font-size: 16px; line-height: 24px; text-align: center;">
                        <h2 style="margin: 0 0 20px 0; font-size: 22px; color: #222222;">Atur Ulang Kata Sandi</h2>
                        <p style="margin: 0 0 20px 0;">
                            Halo,<br><br>
                            Kami menerima permintaan untuk mengatur ulang kata sandi akun JKB Festival Anda. Jangan khawatir, klik tombol di bawah ini untuk membuat kata sandi yang baru.
                        </p>
                    </td>
                </tr>

                <tr>
                    <td align="center" style="padding: 10px 40px 30px 40px;">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center" style="border-radius: 6px;" bgcolor="#b71c77">
                                    <a href="{{ route('password.reset' , $token)}}" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 6px; padding: 14px 30px; border: 1px solid #b71c77; display: inline-block; font-weight: bold; background: linear-gradient(90deg, #db278a 0%, #871055 100%);">
                                        Reset Kata Sandi
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td align="center" style="padding: 10px 40px 40px 40px; color: #666666; font-size: 14px; line-height: 20px;">
                        <p style="margin: 0;">
                            Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini. Kata sandi Anda akan tetap aman.
                        </p>
                    </td>
                </tr>

                <tr>
                    <td align="center" style="padding: 20px 40px; background-color: #f8f8f8; color: #888888; font-size: 12px; line-height: 18px; border-top: 1px solid #eeeeee;">
                        <p style="margin: 0 0 10px 0;">
                            <strong>JKB Festival 2026</strong><br>
                            Digital Competency and Innovation Arena
                        </p>
                        <p style="margin: 0;">
                            &copy; 2026 JKB Festival. Hak cipta dilindungi undang-undang.
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>