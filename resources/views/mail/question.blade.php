<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertanyaan Peserta</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f0f3; font-family: 'Segoe UI', Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 32px 0;">
        <tr>
            <td align="center">
                <table width="560" cellpadding="0" cellspacing="0" style="background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(106,20,82,0.08);">
                    
                    {{-- Header --}}
                    <tr>
                        <td style="background: linear-gradient(135deg, #6A1452 0%, #44113E 100%); padding: 28px 32px; text-align: center;">
                            <h2 style="color: #fff; margin: 0; font-size: 20px; font-weight: 700; letter-spacing: 0.5px;">
                                📩 Pertanyaan Baru dari Peserta
                            </h2>
                            <p style="color: rgba(255,255,255,0.7); margin: 6px 0 0; font-size: 13px;">JKB Festival — Web Development</p>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding: 28px 32px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding-bottom: 18px;">
                                        <span style="display: block; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Nama Pengirim</span>
                                        <span style="font-size: 16px; color: #2d2d2d; font-weight: 600;">{{ $senderName }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom: 18px;">
                                        <span style="display: block; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Email</span>
                                        <a href="mailto:{{ $senderEmail }}" style="font-size: 16px; color: #6A1452; text-decoration: none; font-weight: 500;">{{ $senderEmail }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="display: block; font-size: 12px; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Pesan</span>
                                        <div style="background: #FFF2FB; border-radius: 10px; padding: 16px 18px; font-size: 15px; color: #333; line-height: 1.6;">
                                            {{ $senderMessage }}
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding: 18px 32px; border-top: 1px solid #f0e6ed; text-align: center;">
                            <p style="margin: 0; font-size: 12px; color: #aaa;">
                                Email ini dikirim secara otomatis oleh sistem JKB Festival.<br>
                                Balas langsung ke email ini untuk merespons pengirim.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
