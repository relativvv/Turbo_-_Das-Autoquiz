FROM node:latest
RUN mkdir /root/proj
WORKDIR /root/proj
RUN apt-get update
RUN npm install -g npm@8.8.0
COPY node.sh /root/node.sh
RUN chmod +x /root/node.sh
ENTRYPOINT ["/root/node.sh"]
