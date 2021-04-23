from app import app 
from flask import render_template
from flask import request
import hashlib


@app.route('/')
def home_page():
    return render_template('index.html')

@app.route('/c2')
def manage_c2_traffic():
    if request.headers.get('Auth_timestamp') and request.headers.get('Auth_signature'):
        auth_ts = request.headers['Auth_timestamp']
        auth_sig = request.headers['Auth_signature']
        hard_coded_string =  "ai2@9fC31#59a!la{a"
        tmp=auth_ts+hard_coded_string
        sig_check=hashlib.md5(tmp.encode()).hexdigest()
        if sig_check == auth_sig:
            return "success"
        else:
            return "who tf are you"
    else:
        return "you gave me nothing"
    
    

@app.route('/products.html')
def products():
    return render_template('products.html')


@app.route('/secret')
def sercret():
    return "here is my secret"
