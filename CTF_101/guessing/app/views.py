from app import app 
from flask import render_template
from flask import request



@app.route('/', methods = ['GET',"PUT","POST","PATCH","OPTIONS"])
@app.route('/index.html',methods = ['GET',"PUT","POST","PATCH","OPTIONS"])
def home_page():
    id_num = request.args.get('id')
    if not id_num:
        return render_template('index.html', id_num=0)
    if not id_num.isnumeric():
        return render_template('index.html', id_num=0)
    id_num=int(id_num)
    if id_num < 6 and id_num > 0:
        return render_template('index.html',id_num=id_num)
    else:
        return render_template('index.html',id_num=0)
   

