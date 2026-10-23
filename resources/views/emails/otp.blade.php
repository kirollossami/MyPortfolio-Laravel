<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Security Verification Code</title>
</head>
<body style="margin: 0; padding: 0; background-color: #06080d; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #e2e8f0;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #06080d; padding: 40px 15px;">
    <tr>
      <td align="center">
        <!-- Main Card Container -->
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 560px; background-color: #0f1420; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 16px; overflow: hidden; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);">
          
          <!-- Top Accent Bar -->
          <tr>
            <td height="4" style="background: linear-gradient(90deg, #6366f1 0%, #06b6d4 50%, #10b981 100%);"></td>
          </tr>

          <!-- Header -->
          <tr>
            <td style="padding: 32px 32px 20px 32px; text-align: center; border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
              <h2 style="margin: 0 0 6px 0; font-size: 20px; font-weight: 800; color: #ffffff; letter-spacing: -0.02em;">
                Kirollos Samy Ishaq
              </h2>
              <p style="margin: 0; font-size: 12px; font-family: monospace; color: #06b6d4; letter-spacing: 0.08em; text-transform: uppercase;">
                .NET &amp; LARAVEL SPECIALIST &bull; PORTFOLIO INQUIRIES
              </p>
            </td>
          </tr>

          <!-- Content Body -->
          <tr>
            <td style="padding: 32px 32px 24px 32px;">
              <h3 style="margin: 0 0 14px 0; font-size: 18px; font-weight: 700; color: #ffffff;">
                Verify Your Message Transmission
              </h3>
              
              <p style="margin: 0 0 20px 0; font-size: 14px; line-height: 1.6; color: #94a3b8;">
                Hello <strong style="color: #f1f5f9;">{{ $name }}</strong>,<br>
                Thank you for reaching out through my portfolio. To protect against spam and ensure your message is delivered directly to my personal inbox, please use the 6-digit verification code below:
              </p>

              <!-- OTP Code Box -->
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin: 24px 0;">
                <tr>
                  <td align="center" style="background: rgba(6, 182, 212, 0.08); border: 2px dashed rgba(6, 182, 212, 0.4); border-radius: 12px; padding: 22px;">
                    <span style="font-family: 'Courier New', Courier, monospace; font-size: 36px; font-weight: 800; letter-spacing: 10px; color: #06b6d4; text-shadow: 0 0 15px rgba(6, 182, 212, 0.4);">
                      {{ $otp }}
                    </span>
                    <p style="margin: 10px 0 0 0; font-size: 12px; font-family: monospace; color: #94a3b8;">
                      Valid for 10 minutes &bull; One-time security pass
                    </p>
                  </td>
                </tr>
              </table>

              <p style="margin: 0 0 8px 0; font-size: 13px; line-height: 1.5; color: #64748b;">
                Enter this code in the verification modal on the portfolio site to transmit your message. If you did not initiate this request, you can safely disregard this email.
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding: 24px 32px; background-color: #0a0d14; border-top: 1px solid rgba(255, 255, 255, 0.08); text-align: center;">
              <p style="margin: 0 0 6px 0; font-size: 12px; color: #64748b;">
                Automated Security Verification &bull; <a href="https://kirollossamy.up.railway.app/" style="color: #06b6d4; text-decoration: none;">kirollossamy.up.railway.app</a>
              </p>
              <p style="margin: 0; font-size: 11px; font-family: monospace; color: #475569;">
                &copy; {{ date('Y') }} Kirollos Samy Ishaq. All rights reserved.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
