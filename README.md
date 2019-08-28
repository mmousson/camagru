# camagru

This web project was challenging us to create a small web application allowing an user to
make basic photo and video editing using the webcam and some predefined images.
The user must be able to save and share his creations in a publicly visible gallery and like / comment other users' creations.

We had to deal with the following topics:
- Responsive design
- DOM Manipulation
- SQL Debugging
- SQL Injection
- Cross Site Request Forgery (XSS)
- Cross Origin Resource Sharing (CORS)

## Technologies

We were only allowed to use a LAMP stack. All frameworks, all libraries were forbidden.
Authorized languages:
- Server-side : PHP 7.2
- Client-side : HTML 5 / CSS 3 / Vanilla Javascript

## Security

The application shall produce no error / warning.

All forms had to have correct validations and the whole site must be secured. This point was MANDATORY and was deeply tested
during project's defense.
For instance we had to prevent an user to perform the following:
- Offer the ability to inject HTML or “user” JavaScript in badly protected variables.
- Offer the ability to upload unwanted content on the server.
- Offer the possibility of altering an SQL query.
- Use an extern form to manipulate so-called private data

## Installation

- **Via docker**:<br>
From the root of the repository, build the docker image with: `docker build -t lamp docker/`<br>
Then run the image with: `docker run -it --rm -p 80:80 -p 21:22 -p 443:443 -v the_path_to_the_repository:/var/www/html lamp`

The virtual machine will automatically launch the setup of the web server.
When prompted, enter the following information:
- Validate Password PLUGIN: No
- New Password : `bleu`
- Confirm Password : `bleu`
- Remove anonymous users : `y`
- Disallow root login remotely : `No`
- Remove test database and access to it : `y`
- Reload privileges table now : `y`
- Country Name (2 letter code) [AU]: `empty`
- State or Province Name (full name) [Some-State]: `empty`
- Locality Name (eg, city) []: `empty`
- Organization Name (eg, company) [Internet Widgits Pty Ltd]: `empty`
- Organizational Unit Name (eg, section) []: `empty`
- Common Name (e.g. server FQDN or YOUR name) []: `empty`
- Email Address []: `empty`

You can now preconfigure the database by accessing the following URL in a browser:
`[IP address of the virtual machine]/config/setup.php`

All done !

By default, the users table will hold a root account with the following credentials:
<br>login: `root`
<br>password: `bleu`

## Disclaimer

This project was made for School 42's Cursus by Mallory Mousson (mmousson) and for learning purposes only.<br>
You should NOT copy any part of this repository in your own projects without fully understanding it.
