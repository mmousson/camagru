FROM ubuntu

MAINTAINER Mallory Mousson

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update
RUN apt-get install -yq apache2
RUN apt-get install -yq mysql-server
RUN apt-get install -yq php
RUN apt-get install -yq phpmyadmin
RUN apt-get install -yq php-mbstring
RUN apt-get install -yq php-gettext
RUN apt-get install -yq mailutils
RUN apt-get install -yq ssmtp
RUN apt-get install -yq vim

RUN bash -c "echo 'IyEvYmluL2Jhc2gKCnNlcnZpY2UgbXlzcWwgc3RhcnQKbXlzcWxfc2VjdXJlX2luc3RhbGxhdGlvbgoKc2VydmljZSBhcGFjaGUyIHN0YXJ0CgplY2hvICJkWE5sSUcxNWMzRnNPd29LZFhCa1lYUmxJSFZ6WlhJZ2MyVjBJR0YxZEdobGJuUnBZMkYwYVc5dVgzTjBjbWx1WnoxUVFWTlRWMDlTUkNnaVlteGxkU0lwSUhkb1pYSmxJRlZ6WlhJOUozSnZiM1FuT3dwMWNHUmhkR1VnZFhObGNpQnpaWFFnY0d4MVoybHVQU0p0ZVhOeGJGOXVZWFJwZG1WZmNHRnpjM2R2Y21RaU93b0tabXgxYzJnZ2NISnBkbWxzWldkbGN6c0siIHwgYmFzZTY0IC1kID4gL3RtcC9teXNxbF9pbnB1dApteXNxbCAtdSByb290IDwgL3RtcC9teXNxbF9pbnB1dAoKc2VydmljZSBteXNxbCByZXN0YXJ0Cgpta2RpciAvdmFyL3d3dy91cGxvYWRzIC92YXIvd3d3L3Bvc3RzCmNobW9kIDc3NyAvdmFyL3d3dy91cGxvYWRzIC92YXIvd3d3L3Bvc3RzCgpvcGVuc3NsIHJlcSAteDUwOSAtZGF5cyAzNjUgLW5vZGVzIC1vdXQgL2V0Yy9zc2wvY2VydHMvY2FtYWdydS5jcnQgLWtleW91dCAvZXRjL3NzbC9jZXJ0cy9jYW1hZ3J1LmtleQpjaG1vZCA0NDAgL2V0Yy9zc2wvY2VydHMvY2FtYWdydS5rZXkKYTJlbm1vZCBzc2wKZWNobyAnUEZacGNuUjFZV3hJYjNOMElDbzZORFF6UGdvSlJHOWpkVzFsYm5SU2IyOTBJQzkyWVhJdmQzZDNMMmgwYld3S0NWTmxjblpsY2s1aGJXVWdJSGQzZHk1allXMWhaM0oxTG1OdmJRb0tDVk5sY25abGNsTnBaMjVoZEhWeVpTQlBabVlLQ1VWeWNtOXlURzluSUNSN1FWQkJRMGhGWDB4UFIxOUVTVko5TDJWeWNtOXlYM2RsWW0xaGFXd3ViRzluQ2dsTWIyZE1aWFpsYkNCcGJtWnZDZ2xEZFhOMGIyMU1iMmNnSkh0QlVFRkRTRVZmVEU5SFgwUkpVbjB2WVdOalpYTnpYM2RsWW0xaGFXd3ViRzluSUdOdmJXSnBibVZrQ2dvSlUxTk1SVzVuYVc1bElHOXVDZ2xUVTB4RFpYSjBhV1pwWTJGMFpVWnBiR1VnTDJWMFl5OXpjMnd2WTJWeWRITXZZMkZ0WVdkeWRTNWpjblFLQ1ZOVFRFTmxjblJwWm1sallYUmxTMlY1Um1sc1pTQXZaWFJqTDNOemJDOWpaWEowY3k5allXMWhaM0oxTG10bGVRbzhMMVpwY25SMVlXeEliM04wUGdvPScgfCBiYXNlNjQgLWQgPj4gL2V0Yy9hcGFjaGUyL2FwYWNoZTIuY29uZgoKc2VydmljZSBhcGFjaGUyIHJlc3RhcnQKCmhvc3RuYW1lPWBjYXQgL2V0Yy9zc210cC9zc210cC5jb25mIHwgZ3JlcCBob3N0bmFtZWAKCmVjaG8gJ3Jvb3Q9Y2FtYWdydXNtdHBsdGRAZ21haWwuY29tJyA+IC9ldGMvc3NtdHAvc3NtdHAuY29uZgplY2hvICdtYWlsaHViPXNtdHAuZ21haWwuY29tOjU4NycgPj4gL2V0Yy9zc210cC9zc210cC5jb25mCmVjaG8gJ0F1dGhVc2VyPWNhbWFncnVzbXRwbHRkQGdtYWlsLmNvbScgPj4gL2V0Yy9zc210cC9zc210cC5jb25mCmVjaG8gJ0F1dGhQYXNzPVlvbG80MnN3YWdnJyA+PiAvZXRjL3NzbXRwL3NzbXRwLmNvbmYKZWNobyAnVXNlVExTPVlFUycgPj4gL2V0Yy9zc210cC9zc210cC5jb25mCmVjaG8gJ1VzZVNUQVJUVExTPVlFUycgPj4gL2V0Yy9zc210cC9zc210cC5jb25mCmVjaG8gIiRob3N0bmFtZSIgPj4gL2V0Yy9zc210cC9zc210cC5jb25mCgovYmluL2Jhc2gK' | base64 -d > /var/entrypoint.sh"
RUN chmod +x /var/entrypoint.sh

CMD ["bash"]
