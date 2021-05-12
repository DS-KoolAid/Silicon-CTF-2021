
FROM python:3.8-slim
RUN mkdir /app
ADD app /app
RUN  apt update;apt install -y python3-pip; 
RUN  pip3 install selenium
RUN pip3 install flask
RUN  pip3 install uwsgi
RUN pip3 install uwsgidecorators
WORKDIR /app
CMD ["uwsgi","--ini","/app/uwsgi.ini"]