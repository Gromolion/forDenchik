{ echo "GET /basic-auth HTTP/1.1";
echo "Host: postman-echo.com";
echo "Authorization: Basic cG9zdG1hbjpwYXNzd29yZA==\n\n";
echo "";
sleep 2; } | telnet postman-echo.com 80
