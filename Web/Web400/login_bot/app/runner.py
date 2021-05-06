from flask import Flask, request, Response
from threading import Thread
from flask import render_template
from run_headless import run_headless
import os

app = Flask(__name__)
app.secret_key = os.urandom(42)
app.debug = True

@app.route('/')
@app.route('/index.html')
def main_page():
    return render_template('index.html')

@app.route('/send_link.html',methods=['GET'])
def send_link_get():
    return render_template('link_form.html', test=False)

@app.route('/send_link.html',methods=['POST'])
def run_browsing():
    # name_var  = request.args.get('name',None)
    var_name = request.form['variable_name']
    var_value = request.form['variable_value']
    run_headless(var_name,var_value)
    gen_url = f"https://challenge.silicon-ctf.party/web300/index.php?{var_name}={var_value}"
    return render_template('gen_test_link.html', gen_url=gen_url, test=False)

@app.route('/test_link.html',methods=['GET'])
def test_link_get():
    return render_template('link_form.html', test=True)
# @app.route('/test_browsing')
# def test_browsing():

@app.route('/test_link.html',methods=['POST'])
def test_link_post():
    var_name = request.form['variable_name']
    var_value = request.form['variable_value']
    gen_url = f"https://challenge.silicon-ctf.party/web300/index.php?{var_name}={var_value}"
    return render_template('gen_test_link.html', gen_url=gen_url, test=True)



if __name__ == '__main__':
    app.run('0.0.0.0', port=8080, debug=True)