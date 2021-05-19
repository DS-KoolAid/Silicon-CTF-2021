import MySQLdb
import configparser
from app import app 
import datetime
from pytz import timezone


config = configparser.ConfigParser()

config.read('db.ini')

# conn_string = f"host={config['DBConfig']['HOST']} db={config['DBConfig']['DB']} user={config['DBConfig']['USER']} passwd={config['DBConfig']['PASSWORD']}"


def _sanitize(s):
    s=s.strip(' ')
    s=s.strip(';')
    s=s.strip('"')
    return s

class DBActions:

    def __init__(self):
        try:
            self.conn=MySQLdb.connect(config['DBConfig']['HOST'],config['DBConfig']['USER'],config['DBConfig']['PASSWORD'],config['DBConfig']['DB'])
            self.cursor=self.conn.cursor()
        except Exception as err:
            self._handle_error(err)

    def __del__(self):
        self.cursor.close()
        self.conn.close()

    def _handle_error(self,error_message):
        app.logger.debug(f'SQL ERROR:\n{error_message}')
        self.conn.rollback()

    def get_events_db(self):
        table_name='events'
        query = f"select * from {table_name} ORDER BY event_date ASC"
        app.logger.debug(f'QUERY BEING EXECUTED: {query}')
        try:
            self.cursor.execute(query)
            events=self.cursor.fetchall()
            eve_array=[]
            for i in events:
                datetime_time = datetime.datetime.fromtimestamp(i[2])
                eve={'event_name':i[0], 'event_time':datetime_time.astimezone(timezone('US/Pacific')).strftime("%Y-%m-%d %H:%M")}
                eve_array.append(eve)
            return eve_array
        except Execption as err:
            self._handle_error(err)

    def get_event_details(self,event):
        table_name='events'
        event=_sanitize(event)
        query = f"select event_name, event_desc from {table_name} where event_name = \'{event}\'"
        app.logger.debug(f"Query: {query}")
        try:
            self.cursor.execute(query)
            details = self.cursor.fetchall()
            return details
        except Execption as err:
            self._handle_error(err)


        



