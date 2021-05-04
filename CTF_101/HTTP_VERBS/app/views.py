from app import app 
from flask import render_template
from flask import request
from flask_basicauth import BasicAuth



@app.route('/', methods = ['POST','GET',"PUT"])
@app.route('/index.html',methods = ['POST','GET',"PUT"])
def home_page():
    return render_template('index.html')

@app.route('/', methods = ['PATCH'])
@app.route('/index.html',methods = ['PATCH'])
def handle_patch():
    data = request.json
    if data['give_me_secret_plans'] == "yes":
        return render_template('sol.html')
    else:
        return "not quite"

