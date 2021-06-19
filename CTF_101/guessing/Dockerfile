FROM python:3.8-slim

COPY requirements.txt requirements.txt
RUN pip3 install -r requirements.txt 

RUN mkdir /app


ADD app /app


CMD ["gunicorn","--chdir","app","main:app","-w","2","--threads","2","-b","0.0.0.0:8080"]
