<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Direct Portfolio Message</title>
</head>
<body style="margin: 0; padding: 0; background-color: #06080d; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #e2e8f0;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #06080d; padding: 40px 15px;">
    <tr>
      <td align="center">
        <!-- Main Card Container -->
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 650px; background-color: #0f1420; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 16px; overflow: hidden; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);">
          
          <!-- Top Accent Bar -->
          <tr>
            <td height="4" style="background: linear-gradient(90deg, #10b981 0%, #06b6d4 50%, #6366f1 100%);"></td>
          </tr>

          <!-- Header -->
          <tr>
            <td style="padding: 28px 32px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); background-color: #121824;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <h2 style="margin: 0 0 4px 0; font-size: 20px; font-weight: 800; color: #ffffff;">
                      New Portfolio Message
                    </h2>
                    <p style="margin: 0; font-size: 12px; font-family: monospace; color: #94a3b8;">
                      Transmitted via Portfolio Contact Terminal
                    </p>
                  </td>
                  <td align="right">
                    <span style="display: inline-block; padding: 6px 14px; border-radius: 9999px; background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4); color: #10b981; font-size: 11px; font-weight: 700; font-family: monospace;">
                      &#10003; DIRECT INQUIRY
                    </span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Sender Details Grid -->
          <tr>
            <td style="padding: 24px 32px; background-color: #0b0f17; border-bottom: 1px solid rgba(255, 255, 255, 0.06);">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="6">
                <tr>
                  <td width="28%" style="font-size: 12px; font-family: monospace; color: #64748b; text-transform: uppercase;">Sender Name:</td>
                  <td style="font-size: 14px; font-weight: 700; color: #ffffff;">{{ $data['name'] }}</td>
                </tr>
                <tr>
                  <td style="font-size: 12px; font-family: monospace; color: #64748b; text-transform: uppercase;">Sender Email:</td>
                  <td style="font-size: 14px; font-weight: 600; color: #06b6d4;">
                    <a href="mailto:{{ $data['email'] }}" style="color: #06b6d4; text-decoration: none;">{{ $data['email'] }}</a>
                  </td>
                </tr>
                <tr>
                  <td style="font-size: 12px; font-family: monospace; color: #64748b; text-transform: uppercase;">Subject:</td>
                  <td style="font-size: 14px; font-weight: 600; color: #f1f5f9;">{{ $data['subject'] }}</td>
                </tr>
                @if(!empty($data['verified_at']))
                <tr>
                  <td style="font-size: 12px; font-family: monospace; color: #64748b; text-transform: uppercase;">Verified At:</td>
                  <td style="font-size: 12px; font-family: monospace; color: #94a3b8;">{{ $data['verified_at'] }} UTC</td>
                </tr>
                @endif
                @if(!empty($data['ip']))
                <tr>
                  <td style="font-size: 12px; font-family: monospace; color: #64748b; text-transform: uppercase;">Client IP:</td>
                  <td style="font-size: 12px; font-family: monospace; color: #94a3b8;">{{ $data['ip'] }}</td>
                </tr>
                @endif
              </table>
            </td>
          </tr>

          <!-- Message Body -->
          <tr>
            <td style="padding: 32px;">
              <h3 style="margin: 0 0 16px 0; font-size: 14px; font-family: monospace; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">
                Message Content:
              </h3>
              
              <div style="background-color: #121824; border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 12px; padding: 22px; line-height: 1.7; font-size: 15px; color: #e2e8f0; word-wrap: break-word;">
                @foreach (explode("\n", $data['message']) as $line)
                  @php
                    $isArabic = preg_match('/\p{Arabic}/u', $line);
                  @endphp
                  <p style="margin: 0 0 12px 0; text-align: {{ $isArabic ? 'right' : 'left' }}; direction: {{ $isArabic ? 'rtl' : 'ltr' }};">
                    {!! nl2br(e($line)) !!}
                  </p>
                @endforeach
              </div>

              <!-- Quick Reply Action -->
              <div style="margin-top: 28px; text-align: center;">
                <a href="mailto:{{ $data['email'] }}?subject={{ rawurlencode('Re: ' . $data['subject']) }}" style="display: inline-block; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); color: #ffffff; text-decoration: none; font-weight: 700; font-size: 14px; padding: 12px 28px; border-radius: 10px; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);">
                  Reply Directly to {{ $data['name'] }}
                </a>
              </div>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding: 20px 32px; background-color: #0a0d14; border-top: 1px solid rgba(255, 255, 255, 0.08); text-align: center;">
              <p style="margin: 0; font-size: 11px; font-family: monospace; color: #64748b;">
                Received by Kirollos Samy Ishaq Portfolio &bull; kerollossami@gmail.com
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
