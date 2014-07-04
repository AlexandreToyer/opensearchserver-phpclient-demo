OpenSearchServer PHP Client - demo app
======================================

This app demonstrates a way to work with OpenSearchServer PHP Client.

Tools used are:

* [OpenSearchServer PHP client](https://github.com/jaeksoft/opensearchserver-php-client)
* [Silex](http://silex.sensiolabs.org)
* [Bootstrap 3](http://getbootstrap.com/)

![Index creation](phpclient_demo.png "Index creation")


# Prerequisite

* Apache with `mod_rewrite` enabled 

# Setup

* Create a folder for your project

```shell
mkdir ossphp_examples
cd ossphp_examples
```

* Clone this repo:

```shell
git clone https://github.com/jaeksoft/opensearchserver-php-client-demo.git
```

* Run these commands to install vendors:

```shell
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

* Open a browser and load `...<path to folder>/web/`

===========================

OpenSearchServer PHP Client
Copyright 2008-2014 Emmanuel Keller / Jaeksoft
http://www.opensearchserver.com

OpenSearchServer PHP Client is free software: you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.
 
OpenSearchServer PHP Client is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Lesser General Public License for more details.
 
You should have received a copy of the GNU Lesser General Public License
along with OpenSearchServer PHP Client.
If not, see <http://www.gnu.org/licenses/>.
 