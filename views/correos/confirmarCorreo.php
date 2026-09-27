<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirma tu cuenta - CAREFULNESS</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; color: #1e293b;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f1f5f9; padding: 40px 15px;">
        <tr>
            <td align="center">
                <!-- Contenedor Principal (max-width 600px) -->
                <table role="presentation" width="100%" style="max-width: 580px; background-color: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);" cellspacing="0" cellpadding="0">
                    
                    <!-- Barra de color de marca superior -->
                    <tr>
                        <td style="height: 6px; background-color: #059669;"></td>
                    </tr>

                    <!-- Cabecera con Logotipo -->
                    <tr>
                        <td style="padding: 36px 40px 24px 40px; text-align: center;">
                            <table role="presentation" align="center" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="vertical-align: middle;">
                                        <div style="width: 44px; height: 44px; background-color: #ecfdf5; border-radius: 12px; border: 1px solid #a7f3d0; text-align: center; line-height: 44px; font-size: 22px;">
                                            🩺
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle; padding-left: 12px; text-align: left;">
                                        <span style="font-size: 22px; font-weight: 800; color: #0f172a; letter-spacing: -0.5px; display: block;">CAREFULNESS</span>
                                        <span style="font-size: 11px; font-weight: 600; color: #059669; text-transform: uppercase; letter-spacing: 0.5px; display: block;">Salud & Acompañamiento Integral</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Divisor -->
                    <tr>
                        <td style="padding: 0 40px;">
                            <div style="border-top: 1px solid #f1f5f9;"></div>
                        </td>
                    </tr>

                    <!-- Cuerpo del Mensaje -->
                    <tr>
                        <td style="padding: 32px 40px 40px 40px;">
                            <h1 style="font-size: 24px; font-weight: 700; color: #0f172a; margin: 0 0 16px 0; letter-spacing: -0.5px;">
                                ¡Bienvenido/a, <?= htmlspecialchars($nombre ?? ''); ?>! 👋
                            </h1>
                            
                            <p style="font-size: 15px; line-height: 24px; color: #475569; margin: 0 0 20px 0;">
                                Gracias por registrarte en <strong>CAREFULNESS</strong>. Estamos comprometidos con acompañarte en tu cuidado diario, orientación médica, soporte emocional y defensa de tus derechos de salud en diabetes y ostomías.
                            </p>

                            <p style="font-size: 15px; line-height: 24px; color: #475569; margin: 0 0 28px 0;">
                                Para activar tu cuenta y acceder de forma segura a todos los servicios de la plataforma, por favor confirma tu correo electrónico haciendo clic en el siguiente botón:
                            </p>

                            <!-- Botón de Llamado a la Acción -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin: 28px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="<?= htmlspecialchars($url ?? ''); ?>" target="_blank"
                                            style="display: inline-block; background-color: #059669; color: #ffffff; font-size: 16px; font-weight: 700; text-decoration: none; padding: 15px 36px; border-radius: 12px; box-shadow: 0 4px 14px rgba(5, 150, 105, 0.35); text-align: center;">
                                            Confirmar mi cuenta &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Nota de expiración o seguridad -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; margin: 28px 0 20px 0;">
                                <p style="font-size: 13px; color: #64748b; margin: 0; line-height: 20px;">
                                    🔒 <strong>Seguridad:</strong> Si tú no solicitaste crear esta cuenta, puedes desestimar este mensaje; nadie podrá activarla sin acceso a tu correo.
                                </p>
                            </div>

                            <!-- Enlace alternativo si el botón falla -->
                            <p style="font-size: 12px; line-height: 18px; color: #94a3b8; margin: 24px 0 0 0; word-break: break-all;">
                                Si tienes problemas con el botón, copia y pega el siguiente enlace en tu navegador:<br>
                                <a href="<?= htmlspecialchars($url ?? ''); ?>" style="color: #059669; text-decoration: underline;"><?= htmlspecialchars($url ?? ''); ?></a>
                            </p>
                        </td>
                    </tr>

                    <!-- Pie de Página -->
                    <tr>
                        <td style="padding: 24px 40px; background-color: #f8fafc; border-top: 1px solid #e2e8f0; text-align: center;">
                            <p style="font-size: 13px; font-weight: 600; color: #475569; margin: 0 0 6px 0;">
                                Plataforma CAREFULNESS
                            </p>
                            <p style="font-size: 12px; color: #94a3b8; margin: 0 0 10px 0;">
                                Acompañamiento especializado para personas con Diabetes y Ostomías
                            </p>
                            <p style="font-size: 11px; color: #cbd5e1; margin: 0;">
                                &copy; <?= date('Y'); ?> CAREFULNESS. Todos los derechos reservados.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>