<html>
<head>
    <meta charset="utf-8">
    <title>Đăng nhập thành công</title>
    <script>
        window.opener.postMessage({ event_name : 'social_login', csrf_token : "{{csrf_token()}}", success_login: {{ !empty($user) ? 'true' : 'false'  }}, user: {!! !empty($user) ? json_encode($user) : 'null' !!} });
        window.close();
    </script>
</head>
<body>
</body>
</html>
