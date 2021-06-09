Starting Challenge Zero, we're met with a website and told we need to find a way to login. 

Checking the source code of the site, reveals a comment `<!-- TODO: Sanitize user input on search box for gallery page. See OWASP A1 -->`. OWASP A1 refers to injection vulnerabilities so checking out the gallery page, we see there is an input box to search on gallery pages.

Proving an invalid input like a single quote reveals an error that leaks the SQL query `Error with query: select * from pages where is_draft=0 and page_id='`. This shows us this page is vulnerable to SQL injection, and we notice that only pages where is_draft is equal to 0 are showing.

So let's bypass the filtering logic by passing an always true string such as `1 OR 1=1`. This reveals a [redacted.html](https://emprie.site/pages/redacted.html) page in the table.

That redacted page mentions another table in the database `TODO: Include secret_pages results in SQL query for gallery search.`, so we could try including that in our SQL injecton using a UNION clause - `1 UNION SELECT * FROM secret_pages`.

That gives us a [super_secret_plans_message.html](https://emprie.site/pages/super_secret_plans_message.html) page which contains an audio message. Listening to the message, we hear a series of boops & beeps, and towards the end of it, we hear the message repeated but this time it sounds a lot like morse code. That's because it is! 

Writing out the code gives `-.-. ...-- .--. .-.-.- -..- -.-- --..` which decodes to `c3p.xyz`. Now, according to the text on the page, this is supposed to be a website! *Note:* The header image on this page is visualization of the audio which you could also use to decode the message where longer blobs are dashes and shorter blobs are dots.

Navigating to [c3p.xyz](https://c3p.xyz/) reveals a page with a zip file and wordlist that can be downloaded. The zip file is password protected and a note at the bottom of the site `*Reminder: Use today's passowrd from the wordlist to open your file.*` seems to indicate one of the passwords in the word list is the right one. 

Instead of trying them one by one (there are over 200), we can use various tools to automate the process (zip2john, a python script, etc). Here's how to do it with john. Running through the wordlist reveals the password to be `itacolita`. 
1. `zip2john documents.zip > hash.txt`
2. `john -w wordlist.txt hash.txt`

Unzipping the files reveals 4 files. Each one has something fun in it, but the one we're looking for is `disciplinary_note.txt`. The file reveals that `tc_trooper_174812` leaked their employee ID on a social media site. If we can find it, we can use that to login as them on the employee site.

We can check various social media platforms for any accounts with the username `tc_trooper_174812`. A way to do that without needing your own account is to try doing https://<social-media-site>/<username>. So we can check
* https://facebook.com/tc_trooper_174812 - no results
* https://twitter.com/tc_trooper_174812 - no results
* https://linkedin.com/in/tc_trooper_174812 - no results
* https://instagram.com/tc_trooper_174812 - we get a profile

Looking through this Instagram profile, we see two posts. One of them is a photo of Daniel J Cobanaught's badge. Zooming in our screen or right clicking and opening the post in a new table, we are able to make out the employee ID # `32145609`

Going back to the login page on the site, we can try logging with their username and password, and we get the flag.