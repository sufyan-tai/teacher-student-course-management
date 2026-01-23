<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Course Enrolled</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center">

    <table width="600" cellpadding="0" cellspacing="0"
           style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.1);">

        <!-- HEADER -->
        <tr>
            <td style="background:linear-gradient(135deg,#38bdf8,#2563eb);padding:20px;text-align:center;color:white;">
                <h2 style="margin:0;">🎓 Course Portal</h2>
            </td>
        </tr>

        <!-- BODY -->
        <tr>
            <td style="padding:30px;color:#1e293b;">
                <h3>Hello {{ $student->name }},</h3>

                <p style="font-size:15px;line-height:1.6;">
                    Congratulations 🎉 You have successfully enrolled in the following course:
                </p>

                <div style="background:#f8fafc;padding:15px;border-radius:10px;margin:20px 0;">
                    <h3 style="margin:0;color:#2563eb;">{{ $course->title }}</h3>
                    <p style="margin:6px 0;color:#475569;">
                        Teacher: {{ $course->teacher->name ?? 'N/A' }}
                    </p>
                </div>

                <p style="font-size:15px;">
                    You can now access the course from your dashboard.
                </p>

                <p style="margin-top:25px;">
                    Happy Learning 🚀<br>
                    <strong>Course Portal Team</strong>
                </p>
            </td>
        </tr>

        <!-- FOOTER -->
        <tr>
            <td style="background:#f1f5f9;padding:15px;text-align:center;font-size:12px;color:#64748b;">
                © {{ date('Y') }} Course Portal. All rights reserved.
            </td>
        </tr>

    </table>

</td>
</tr>
</table>

</body>
</html>
