from app import app 
from flask import render_template
from flask import request
from db_actions import DBActions


@app.route('/')
@app.route('/index.html')
@app.route('/events')
def get_events():
    events=DBActions().get_events_db()
    return render_template('events.html',events=events)
    
@app.route('/event_details')
def get_details():
    event= request.args.get('event')
    details=DBActions().get_event_details(event)
    return render_template('event_details.html',details=details)
