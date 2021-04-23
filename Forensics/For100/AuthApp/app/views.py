from app import app 
from flask import render_template
from flask_basicauth import BasicAuth

app.config['BASIC_AUTH_USERNAME'] = 'moff'
app.config['BASIC_AUTH_PASSWORD'] = 'G!d30n'

basic_auth = BasicAuth(app)

@app.route('/')
@app.route('/index.html')
def home_page():
    return render_template('index.html')

@app.route('/about.html')
def about():
    return render_template('about.html')

@app.route('/products.html')
def products():
    return render_template('products.html')


@app.route('/secret')
@basic_auth.required
def sercret():
    return "here is my secret"
