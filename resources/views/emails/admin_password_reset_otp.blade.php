<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Password Reset Verification Code</title>
</head>
<body style="margin: 0; padding: 0; background-color: #06080d; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #e2e8f0;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #06080d; padding: 40px 15px;">
    <tr>
      <td align="center">
        <!-- Main Card Container -->
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 560px; background-color: #0f1420; border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 16px; overflow: hidden; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);">
          
          <!-- Top Accent Bar -->
          <tr>
            <td height="4" style="background: linear-gradient(90deg, #2563eb 0%, #06b6d4 50%, #10b981 100%);"></td>
          </tr>

          <!-- Header -->
          <tr>
            <td style="padding: 32px 32px 20px 32px; text-align: center; border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
              <h2 style="margin: 0 0 6px 0; font-size: 20px; font-weight: 800; color: #ffffff; letter-spacing: -0.02em;">
                Portfolio Admin CMS
              </h2>
              <p style="margin: 0; font-size: 12px; font-family: monospace; color: #38bdf8; letter-spacing: 0.08em; text-transform: uppercase;">
                SECURITY &bull; PASSWORD RESET VERIFICATION
              </p>
            </td>
          </tr>

          <!-- Content Body -->
          <tr>
            <td style="padding: 32px 32px 24px 32px;">
              <h3 style="margin: 0 0 14px 0; font-size: 18px; font-weight: 700; color: #ffffff;">
                One-Time Security Passcode (OTP)
              </h3>
              
              <p style="margin: 0 0 20px 0; font-size: 14px; line-height: 1.6; color: #94a3b8;">
                Hello <strong style="color: #f1f5f9;">{{ $name }}</strong>,<br>
                A request was received to reset your password for the Portfolio Admin Dashboard. Use the 6-digit verification code below to confirm your identity and proceed with setting a new password:
              </p>

              <!-- OTP Code Box -->
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin: 24px 0;">
                <tr>
                  <td align="center" style="background: rgba(14, 165, 233, 0.08); border: 2px dashed rgba(56, 189, 248, 0.4); border-radius: 12px; padding: 22px;">
                    <span style="font-family: 'Courier New', Courier, monospace; font-size: 38px; font-weight: 800; letter-spacing: 12px; color: #38bdf8; text-shadow: 0 0 15px rgba(56, 189, 248, 0.4);">
                      {{ $otp }}
                    </span>
                    <p style="margin: 10px 0 0 0; font-size: 12px; font-family: monospace; color: #94a3b8;">
                      Valid for 15 minutes &bull; Single-use security token
                    </p>
                  </td>
                </tr>
              </table>

              <p style="margin: 0 0 8px 0; font-size: 13px; line-height: 1.5; color: #64748b;">
                Enter this 6-digit code on the verification screen to unlock the new password form. If you did not request this password reset, no action is needed — your account remains completely secure.
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding: 24px 32px; background-color: #0a0d14; border-top: 1px solid rgba(255, 255, 255, 0.08); text-align: center;">
              <p style="margin: 0 0 6px 0; font-size: 12px; color: #64748b;">
                Automated Security System &bull; <a href="{{ url('/') }}" style="color: #38bdf8; text-decoration: none;">Kirollos Samy Portfolio</a>
              </p>
              <p style="margin: 0; font-size: 11px; font-family: monospace; color: #475569;">
                &copy; {{ date('Y') }} Kirollos Samy. All rights reserved.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
