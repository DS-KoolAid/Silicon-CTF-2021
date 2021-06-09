Clicking the link brings us to a website. On the site, we see a JSON string 
```
{
 "give_me_secret_plans" : "no",
}
```

The site says we need to find a way to ask it for the plans, and the challenge's name is verbs. 
There is some understanding of how HTTP requests work. Most of the time, when you request a website page, an HTTP GET request is made. But there are some other request types that exist (GET, POST, PUT, DELETE, OPTIONS, etc).

You can try the different request methods to see if the web server response changes at all. You can also do an OPTIONS request to see what methods the site supports. 

We can use the `curl` command to make requests. The `-i` flag makes the status code and header information output. The `-X` flag is how we specify the request type.
`curl -i -X OPTIONS https://challenges.silicon-ctf.party/ctf101/verbs/index.html`

Looking at the `allow` header reveals the following allowed methods: `POST, GET, OPTIONS, PUT, PATCH, HEAD`

We can try POST and we get back the response `Almost, try to PATCH my data` which tells us to try a PATCH request. *Note:* This was added to the challenge part way through to make it easier. `curl -i -X POST https://challenges.silicon-ctf.party/ctf101/verbs/index.html`

Trying a PATCH request gives us back a 500 status code. This tells us that *something* different is happening but our request is not quite correct. Thinking back to the JSON string on the website, we should try passing that to it and see what happens as PATCH/PUT/POST requests usually involve sending some data to the webserver. 

We can pass data using the `--data` flag.
`curl -i  -X PATCH https://challenges.silicon-ctf.party/ctf101/verbs/index.html --data '{"give_me_secret_plans" : "no"}'`

We still get a 500 error code. This is probably the trickiest part of the challenge, but we need a way to tell the server what kind of data we are sending - are we sending XML, JSON, raw strings, etc. You can do this including in the request the `Content-Type` header and since this is a JSON string, we set the header value to `application/json`. We can specify a header in curl using the `-H` flag.
`curl -i -X PATCH https://challenges.silicon-ctf.party/ctf101/verbs/index.html --data '{"give_me_secret_plans" : "no"}' -H "Content-Type: application/json"`

This works, but no flag. Instead we get the response `not quite... check your data`. If we try modifying our JSON string to say `yes` instead of `no`, we get back HTML and looking through it we find the flag.
`curl -i -X PATCH https://challenges.silicon-ctf.party/ctf101/verbs/index.html --data '{"give_me_secret_plans" : "yes"}' -H "Content-Type: application/json"`

