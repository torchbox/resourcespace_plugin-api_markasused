Mark a resource as in use API

Usage:
http://url/plugins/api_markasused/?key=[authkey]&[optional parameters]

Parameters:
resource=[int]           ResourceID
url=[string]             intended to be the url that you're using - note you'll want to make sure this is urlencoded!

Sample call:
http://localhost/r2000/plugins/api_markasused/?resource=142&url=google.com&key=ZX13...

This updates the resource data to include a url of where you might be using it
This is useful in conjunction with my api_resource plugin if you were extracting the resource into a separate site
I've built a drupal module that I may be able to opensource that talks to both of these apis